<?php

namespace App\Controller;

use App\Entity\OffreStage;
use App\Form\OffreStageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/offre/stage/OffreStages", name="OffreStages")
     */
    public function OffreStages()
    {
        $Affichages = $this->getDoctrine()->getRepository(OffreStage::class)->findAll();

        return $this->render('offre_stage/AffichageOffres.html.twig', [
            "OffreStages" => $Affichages,
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
        $entityManager = $this->getDoctrine()->getManager();

        $product = $entityManager->getRepository(OffreStage::class)->find($id);
        $form = $this->createForm(OffreStageType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
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

        return $this->redirectToRoute("OffreStages");
    }
    public function RechercheParNomOffreAction(Request $request)
    {

        $nom =  $request->get("type");
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository(OffreStage::class)->findOffreParNom($nom);




        return $this->render("offre_stage/AffichageOffres.html.twig",
            array('OffreStages'=>$modele));

    }
}