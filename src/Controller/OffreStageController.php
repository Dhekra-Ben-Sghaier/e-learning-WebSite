<?php

namespace App\Controller;

use App\Entity\OffreStage;
use App\Form\OffreStageType;
use App\Form\SearchOSType;
use App\Repository\OffreStageeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


class OffreStageController extends AbstractController
{
    /**
     * @Route("/offre/stage", name="offre_stage")
     */
    public function index(): Response
    {
        return $this->render('offre_stage/index.html.twig', [
            'controller_name' => 'OffreStageController',
        ]);
    }
    /**
     * @Route("/offre/stage/add", name="add")
     */
    public function addOffreStage( Request $request):Response{
        $Offre = new OffreStage();


        $form = $this->createForm(OffreStageType::class,$Offre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() ){
            $Offre =$form->getData();
            $images = $form->get('logo')->getData();
            foreach ($images as $logo) {

                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $logo->guessExtension();

                // On copie le fichier dans le dossier uploads
                $logo->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
            }
            // On crée l'image dans la base de données


            $Offre->setLogo($fichier);

            $Offre->setDatePub(new \DateTime());
            $Offre->setIdSociete(1);
            $Offre->setValide(0);
            $x=$this->getDoctrine()->getManager();
            $x->persist($Offre);
            $x->flush();
            $this->addFlash(
                'notice',
                'Offre ajouté avec succès'
            );
            return $this->redirectToRoute('offre_stage');

        }

        return $this->render('offre_stage/add.html.twig',[
            "form_title" => "Ajouter une offre",
            'form' =>$form->createView(),
            ]);

    }


    /**
     * @Route("/offre/stage/OffreStage/{id}", name="OffreStage")
     */
    public function AfficheOffre(int $id): Response
    {
        $Affichages = $this->getDoctrine()->getRepository(OffreStage::class)->find($id);

        return $this->render("offre_stage/AffichageOffre.html.twig", [
            "OffreStage" => $Affichages,
        ]);
    }
    /**
     * @Route("/offre/stage/modifyOffre/{id}", name="modifyOffre")
     */
    public function ModifyOffre(Request $request, int $id): Response
    {
        $product = new OffreStage();

        $entityManager = $this->getDoctrine()->getManager();

        $product = $entityManager->getRepository(OffreStage::class)->find($id);
        $form = $this->createForm(OffreStageType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $images = $form->get('logo')->getData();

            // On boucle sur les images
            foreach ($images as $logo) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $logo->guessExtension();

                // On copie le fichier dans le dossier uploads
                $logo->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                // On crée l'image dans la base de données

                $product->setLogo($fichier);
            }
            $entityManager->flush();
        }

        return $this->render("offre_stage/add.html.twig", [
            "form_title" => "Modifier une offre",
            "form" => $form->createView(),
        ]);
    }
    /**
     * @Route("/offre/stage/deleteOffre/{id}", name="deleteOffre")
     */
    public function DeleteOffre(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(OffreStage::class)->find($id);
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute("MyOffreStages");
    }
    /**
     * @Route("/offre/stage/OffreStages", name="OffreStages")
     */
   public function SearchOS(Request $request,OffreStageeRepository $OffreStageRepository ):Response{

       $Offres =[];
       $SearchOSTForm = $this->createForm(SearchOSType::class, $Offres);
       $SearchOSTForm->handleRequest($request);

       if( $SearchOSTForm->isSubmitted() &&  $SearchOSTForm->isValid()){
           $criteria =  $SearchOSTForm->getData();

           $Offres = $OffreStageRepository->FindOS($criteria);

       }
       return $this->render('offre_stage/AffichageOffres.html.twig', [
            'search_form' =>$SearchOSTForm->createView(),
            'Offres' => $Offres,
           ]);
   }
    /**
     * @Route("/offre/stage/MyOffreStages/{id}", name="MyOffreStages")
     */
    public function ShowMyOffre(int $id =1): Response
    {
        $ListOffres = $this->getDoctrine()->getRepository(OffreStage::class)->GetOSById($id);

        return $this->render("offre_stage/AffichageMesOffres.html.twig", [
            "ListOffres" => $ListOffres,
        ]);
    }
    /**
     * @Route("/offre/stage/Modify/{id}", name="Modify")
     */
    public function Modify($id): Response
    {
        $Affichages = $this->getDoctrine()->getRepository(OffreStage::class)->find($id);

        return $this->render("offre_stage/Modify.html.twig", [
            "OffreStage" => $Affichages,
        ]);
    }
}
