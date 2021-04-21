<?php

namespace App\Controller;

use App\Entity\Personnes;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\PersonnesType;
use App\Form\ApprenantType;
use App\Form\FormateurType;
use App\Form\RoleType;
use App\Repository\PersonnesRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $form->handleRequest($request);
        $form->remove('plainPassword');
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
        $form->handleRequest($request);
        $form->remove('plainPassword');
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
}
