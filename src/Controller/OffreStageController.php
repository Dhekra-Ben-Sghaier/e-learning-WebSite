<?php

namespace App\Controller;

use App\Entity\OffreStage;
use App\Entity\PostulerStage;
use App\Form\OffreStageType;
use App\Form\SearchOSType;
use App\Repository\OffreStageeRepository;
use App\Repository\PostulerStageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Validator\Constraints\Valid;



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
            $date1 = $Offre->getDateFin();
            $date2 = $Offre->getDateDebut();
            $interval = date_diff($date2, $date1);
            $Offre->setDuree($interval->m);
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
            return $this->redirectToRoute('OffreStages');

        }

        return $this->render('offre_stage/add.html.twig',[
            "form_title" => "Ajouter une offre",
            'form' =>$form->createView(),
            ]);

    }


    /**
     * @Route("/offre/stage/OffreStage/{id}", name="OffreStage")
     */
    public function AfficheOffre(int $id, Request $request ,\Swift_Mailer $mailer): Response
    {
        $post = new PostulerStage();
        $entityManager = $this->getDoctrine()->getManager();
        $result = $entityManager->getRepository(PostulerStage::class)->findOneBy(array('idStage'=>$id,'idSociete'=>1));
        $Affichages = $this->getDoctrine()->getRepository(OffreStage::class)->find($id);
                if(!$result){
               $defaultData = ['message' => 'Type your message here'];
               $form = $this->createFormBuilder($defaultData)
                   ->add('name', TextType::class, ['attr' => ['class' => 'form-control form-control-lg']])
                   ->add('email', EmailType::class, ['attr' => ['class' => 'form-control form-control-lg']])
                   ->add('objet', TextType::class, ['attr' => ['class' => 'form-control form-control-lg']])
                   ->add('message', TextareaType::class, ['attr' => ['class' => 'form-control form-control-lg']])
                   ->add('send', SubmitType::class, ['attr' => ['class' => 'btn btn-primary btn-lg px-5']])
                   ->getForm();
               $form->handleRequest($request);

               if ($form->isSubmitted() && $form->isValid()) {

                   $this->sendEmail($mailer, $form->get('objet')->getData(), $form->get('email')->getData(), $form->get('objet')->getData());
                   $post->setIdStage($id);
                   $post->setIdSociete(1);
                   $x = $this->getDoctrine()->getManager();
                   $x->persist($post);
                   $x->flush();
                   return $this->redirectToRoute("OffreStages");
               }

               return $this->render("offre_stage/AffichageOffre.html.twig", [
                   "OffreStage" => $Affichages,
                   "form" => $form->createView(),
               ]);} else
                    return $this->render("offre_stage/AffichageOffreNot.html.twig", [
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
            return $this->redirectToRoute("MyOffreStages");
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
   public function SearchOS(Request $request,OffreStageeRepository $OffreStageRepository):Response{

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
    public function ShowMyOffre(int $id =1, PaginatorInterface $paginator, Request $request): Response
    {
        $Offre = $this->getDoctrine()->getRepository(OffreStage::class)->GetOSById($id);
        $ListOffres = $paginator->paginate(
            $Offre,
            $request->query->getInt('page', 1),
            6
        );

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

    public function sendEmail( $mailer, $objet, $to, $msg)
    {
        $message = (new \Swift_Message($objet))
            ->setFrom('pidevbrainovation@gmail.com')
            ->setTo($to)
            ->setBody($msg)
        ;

        $mailer->send($message);

        // ...
    }

    /**
     * @Route("/offre/stage/Bakchshow", name="Bakchshow")
     */
    public function SearchBOS(Request $request):Response{

        $Offres = $this->getDoctrine()->getRepository(OffreStage::class)->findBy(array('valide' => 0));

        return $this->render('offre_stage/BackValiderOS.html.twig', [
            'Offres' => $Offres,
        ]);
    }
    /**
     * @Route("/offre/stage/BackShowOffre/{id}", name="BackShowOffre")
     */
    public function AfficheOffreBack(int $id, Request $request ): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $Offre = $this->getDoctrine()->getRepository(OffreStage::class)->find($id);

            return $this->render("offre_stage/BackShowOS.html.twig", [
                "OffreStage" =>$Offre,

            ]);

    }
    /**
     * @Route("/offre/stage/validerOffre/{id}", name="validerOffre")
     */
    public function ValiderOffre(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(OffreStage::class)->find($id);
        $product->setValide(1);
        $entityManager->flush();

        return $this->redirectToRoute("Bakchshow");
    }
    /**
     * @Route("/offre/stage/deleteOffreBack/{id}", name="deleteOffreBack")
     */
    public function DeleteOffreBack(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(OffreStage::class)->find($id);
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute("Bakchshow");
    }

}
