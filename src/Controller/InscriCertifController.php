<?php

namespace App\Controller;

use App\Entity\InscriCertif;
use App\Form\InscriCertifType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inscri/certif")
 */
class InscriCertifController extends AbstractController
{
    /**
     * @Route("/", name="inscri_certif_index", methods={"GET"})
     */
    public function index(): Response
    {
        $inscriCertifs = $this->getDoctrine()
            ->getRepository(InscriCertif::class)
            ->findAll();

        return $this->render('inscri_certif/index.html.twig', [
            'inscri_certifs' => $inscriCertifs,
        ]);
    }

    /**
     * @Route("/new", name="inscri_certif_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $inscriCertif = new InscriCertif();
        $form = $this->createForm(InscriCertifType::class, $inscriCertif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inscriCertif);
            $entityManager->flush();

            return $this->redirectToRoute('inscri_certif_index');
        }

        return $this->render('inscri_certif/new.html.twig', [
            'inscri_certif' => $inscriCertif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idInscri}", name="inscri_certif_show", methods={"GET"})
     */
    public function show(InscriCertif $inscriCertif): Response
    {
        return $this->render('inscri_certif/show.html.twig', [
            'inscri_certif' => $inscriCertif,
        ]);
    }

    /**
     * @Route("/{idInscri}/edit", name="inscri_certif_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InscriCertif $inscriCertif): Response
    {
        $form = $this->createForm(InscriCertifType::class, $inscriCertif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inscri_certif_index');
        }

        return $this->render('inscri_certif/edit.html.twig', [
            'inscri_certif' => $inscriCertif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idInscri}", name="inscri_certif_delete", methods={"POST"})
     */
    public function delete(Request $request, InscriCertif $inscriCertif): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscriCertif->getIdInscri(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inscriCertif);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inscri_certif_index');
    }
}
