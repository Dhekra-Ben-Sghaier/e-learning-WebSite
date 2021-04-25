<?php

namespace App\Controller;

use App\Entity\Personnes;
use App\Form\ChangePwdType;
use App\Form\PictureFormType;
use App\Form\ProfilType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\PersonnesType;
use App\Form\ApprenantType;
use App\Form\FormateurType;


use App\Form\RoleType;
use App\Repository\PersonnesRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\DomCrawler\Image;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;


/**
 * @Route("/personnes")
 */
class PersonnesController extends AbstractController
{
    /**
     * @Route("/", name="personnes_index", methods={"GET"})
     */
    public function index(): Response
    {
        $personnes = $this->getDoctrine()
            ->getRepository(Personnes::class)
            ->findAll();

        return $this->render('personnes/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }
    /**
     * @Route("/profil", name="profil")
     */
    public function indexprofil(): Response
    {
        return $this->render('personnes/profil.html.twig');
    }
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function indexfront(): Response
    {
        $personnes = $this->getDoctrine()
            ->getRepository(Personnes::class)
            ->findAll();

        return $this->render('base.html.twig', [
            'personnes' => $personnes,
        ]);
    }
    /**
     * @Route("/indexuser", name="indexuser", methods={"GET"})
     */
    public function indexuser(): Response
    {

        return $this->render('personnes/indexuser.html.twig');
    }
    /**
     * @Route("/cmptdesactive", name="cmptdesactive", methods={"GET"})
     */
    public function indexcpt(): Response
    {

        return $this->render('personnes/CompteDesactive.html.twig');
    }
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(): Response
    {


        return $this->render('registration/register.html.twig');
    }

    /**
     * @Route("/new", name="personnes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $personne = new Personnes();
        $form = $this->createForm(PersonnesType::class, $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personne);
            $entityManager->flush();

            return $this->redirectToRoute('personnes_index');
        }

        return $this->render('personnes/new.html.twig', [
            'personne' => $personne,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{idUser}", name="personnes_show", methods={"GET"})
     */
    public function show(Personnes $personne): Response
    {
        return $this->render('personnes/show.html.twig', [
            'personne' => $personne,
        ]);
    }

    /**
     * @Route("/{idUser}/edit", name="personnes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Personnes $personne): Response
    {
        $form = $this->createForm(PersonnesType::class, $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personnes_index');
        }

        return $this->render('personnes/edit.html.twig', [
            'personne' => $personne,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{idUser}/editApp", name="apprenant_edit", methods={"GET","POST"})
     */
    public function editApp(Request $request, Personnes $personne): Response
    {
        $form = $this->createForm(ApprenantType::class, $personne);
        $form->remove('plainPassword');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apprenant');
        }

        return $this->render('personnes/editapp.html.twig', [
            'personne' => $personne,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{idUser}/editForm", name="formateur_edit", methods={"GET","POST"})
     */
    public function editForm(Request $request, Personnes $personne): Response
    {
        $form = $this->createForm(FormateurType::class, $personne);
        $form->remove('plainPassword');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formateur');
        }

        return $this->render('personnes/edit.html.twig', [
            'personne' => $personne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idUser}", name="personnes_delete", methods={"POST"})
     */
    public function delete(Request $request, Personnes $personne): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personne->getIdUser(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('apprenant');
    }
    /**
     * @Route("apprenant", name="apprenant")
     */
    public function AfficherApprenant(PersonnesRepository $repository)
    {
        $user=$this->getdoctrine()->getRepository(Personnes::class)->findByApprenant();
        return $this->render('personnes/AfficherApp.html.twig',[
            'personnes' => $user,
        ]);

    }
    /**
     * @Route("formateur", name="formateur")
     */
    public function AfficherFormateur(PersonnesRepository $repository)
    {
        $user=$this->getdoctrine()->getRepository(Personnes::class)->findByFormateur();
        return $this->render('personnes/AfficherForm.html.twig',[
            'personnes' => $user,
        ]);

    }

    /**
     * @Route("/{idUser}/profiluser", name="profiluser", methods={"GET","POST"})
     */
    public function modifierProfil(Request $request,UserPasswordEncoderInterface $passwordEncoder, Personnes $personne,Personnes $personn): Response
    {
        $form = $this->createForm(ProfilType::class, $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Informations sauvegardés !');

        }
        $formpwd = $this->createForm(ChangePwdType::class, $personn);
        $formpwd->handleRequest($request);
        if ($formpwd->isSubmitted() && $formpwd->isValid()) {
            $personne->setPassword(
                $passwordEncoder->encodePassword(
                    $personn,
                    $formpwd->get('password')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personn);
            $entityManager->flush();
            $this->addFlash('notice', 'Votre mot de passe à bien été changé !');
        }


        return $this->render('personnes/profil.html.twig', [
            'personne' => $personne,'personn'=>$personn,'formpwd'=>$formpwd->createView(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idUser}/modifphoto", name="modifphoto", methods={"GET","POST"})
     */
    public function modifierPhoto(Request $request,Personnes $personne): Response
    {


        $form = $this->createForm(PictureFormType::class, $personne);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

          $images = $form->get('photo')->getData();
            foreach ($images as $image) {

                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
            }
                // On crée l'image dans la base de données


            $personne->setPhoto($fichier);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personne);
            $entityManager->flush();

            $this->addFlash('notice', 'Votre photo a été sauvegardée avec succés !');
        }
        return $this->render('personnes/photo.html.twig', [
            'personne' => $personne,
            'form' => $form->createView(),
        ]);
    }


}
