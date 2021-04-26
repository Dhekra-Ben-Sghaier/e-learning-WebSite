<?php

namespace App\Controller;

use App\Entity\OffreStage;
use App\Entity\OffreTravail;
use App\Entity\PostulerStage;
use App\Entity\PostulerTravail;
use App\Form\OffreStageType;
use App\Form\OffreTravailType;
use App\Form\SearchOSType;
use App\Form\SearchOTType;
use App\Repository\OffreStageeRepository;
use App\Repository\OffreTravailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreTravailController extends AbstractController
{
    /**
     * @Route("/offre/travail", name="offre_travail")
     */
    public function index(): Response
    {
        return $this->render('offre_travail/index.html.twig', [
            'controller_name' => 'OffreTravailController',
        ]);
    }

    /**
     * @Route("/offre/travail/addOT", name="addOT")
     */
    public function addOffreStage(Request $request): Response
    {
        $Offre = new OffreTravail();


        $form = $this->createForm(OffreTravailType::class, $Offre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Offre = $form->getData();
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
            $x = $this->getDoctrine()->getManager();
            $x->persist($Offre);
            $x->flush();
            $this->addFlash(
                'notice',
                'Offre ajouté avec succès'
            );
            // return $this->redirectToRoute('OffreStages');

        }

        return $this->render('offre_travail/addOT.html.twig', [
            "form_title" => "Ajouter une offre",
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/offre/travail/MyOffreTravails/{id}", name="MyOffreTravails")
     */
    public function ShowMyOffre(int $id = 1): Response
    {
        $ListOffres = $this->getDoctrine()->getRepository(OffreTravail::class)->GetOTById($id);

        return $this->render("offre_travail/AffichageMesOffresT.html.twig", [
            "ListOffres" => $ListOffres,
        ]);
    }

    /**
     * @Route("/offre/travail/BakchshowT", name="BakchshowT")
     */
    public function SearchBOS(Request $request): Response
    {

        $Offres = $this->getDoctrine()->getRepository(OffreTravail::class)->findBy(array('valide' => 0));

        return $this->render('offre_travail/BackValiderOT.html.twig', [
            'Offres' => $Offres,
        ]);
    }

    /**
     * @Route("/offre/travail/BackShowOffreT/{id}", name="BackShowOffreT")
     */
    public function AfficheOffreTBack(int $id, Request $request): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $Offre = $this->getDoctrine()->getRepository(OffreTravail::class)->find($id);

        return $this->render("offre_travail/BackShowOT.html.twig", [
            "OffreTravail" => $Offre,

        ]);

    }

    /**
     * @Route("/offre/travail/validerOffretravail/{id}", name="validerOffretravail")
     */
    public function ValiderOffretravail(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(OffreTravail::class)->find($id);
        $product->setValide(1);
        $entityManager->flush();

        return $this->redirectToRoute("BakchshowT");
    }

    /**
     * @Route("/offre/travail/deleteOffreTBack/{id}", name="deleteOffreTBack")
     */
    public function DeleteOffreTBack(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(OffreTravail::class)->find($id);
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute("Bakchshow");
    }

    /**
     * @Route("/offre/travail/OTModify/{id}", name="OTModify")
     */
    public function OTModify($id): Response
    {
        $Offret = $this->getDoctrine()->getRepository(OffreTravail::class)->find($id);

        return $this->render("offre_travail/ModifyOT.html.twig", [
            "OffreTravail" => $Offret,
        ]);
    }

    /**
     * @Route("/offre/travail/modifyOffreTravail/{id}", name="modifyOffreTravail")
     */
    public function ModifyOffreTravail(Request $request, int $id): Response
    {


        $entityManager = $this->getDoctrine()->getManager();

        $product = $entityManager->getRepository(OffreTravail::class)->find($id);
        $form = $this->createForm(OffreTravailType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
            return $this->redirectToRoute("MyOffreTravails");
        }

        return $this->render("offre_travail/addOT.html.twig", [
            "form_title" => "Modifier une offre",
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/offre/travail/deleteOffreTR/{id}", name="deleteOffreTR")
     */
    public function DeleteOffreTR(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(OffreTravail::class)->find($id);
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute("MyOffreTravails");
    }

    /**
     * @Route("/offre/travail/OffreTravails", name="OffreTravails")
     */
    public function SearchOT(Request $request, OffreTravailRepository $OffreTravailRepository): Response
    {

        $Offres = [];
        $SearchOTTForm = $this->createForm(SearchOTType::class, $Offres);
        $SearchOTTForm->handleRequest($request);

        if ($SearchOTTForm->isSubmitted() && $SearchOTTForm->isValid()) {
            $criteria = $SearchOTTForm->getData();

            $Offres = $OffreTravailRepository->FindOT($criteria);

        }
        return $this->render('offre_travail/AffichageOffresT.html.twig', [
            'search_form' => $SearchOTTForm->createView(),
            'Offres' => $Offres,
        ]);
    }

    /**
     * @Route("/offre/stage/OffreTravail/{id}", name="OffreTravail")
     */
    public function AfficheOffre(int $id, Request $request, \Swift_Mailer $mailer): Response
    {
        $post = new PostulerTravail();
        $entityManager = $this->getDoctrine()->getManager();
        $result = $entityManager->getRepository(PostulerTravail::class)->findOneBy(array('idTravail' => $id, 'idSociete' => 1));
        $Affichages = $this->getDoctrine()->getRepository(OffreTravail::class)->find($id);
        if (!$result) {
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
                $post->setIdTravail($id);
                $post->setIdSociete(1);
                $x = $this->getDoctrine()->getManager();
                $x->persist($post);
                $x->flush();
                return $this->redirectToRoute("OffreTravails");
            }

            return $this->render("offre_travail/AffichageOffreT.html.twig", [
                "OffreTravail" => $Affichages,
                "form" => $form->createView(),
            ]);
        } else
            return $this->render("offre_travail/AffichageOffreTRNot.html.twig", [
                "OffreTravail" => $Affichages,

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


    }


}
