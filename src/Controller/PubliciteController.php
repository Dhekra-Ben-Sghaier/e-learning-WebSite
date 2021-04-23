<?php

namespace App\Controller;

use App\Entity\Publicite;
use App\Form\PubliciteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Role\Role;

/**
 * @Route("/publicite")
 */
class PubliciteController extends AbstractController
{
    /**
     * @Route("/", name="publicite_index", methods={"GET"})
     */
    public function index(): Response
    {
        $publicites = $this->getDoctrine()
            ->getRepository(Publicite::class)
            ->findAll();

        return $this->render('publicite/index.html.twig', [
            'publicites' => $publicites,
        ]);
    }

    /**
     * @Route("/new", name="publicite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $publicite = new Publicite();
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($publicite);
            $entityManager->flush();

            return $this->redirectToRoute('publicite_index');
        }

        return $this->render('publicite/new.html.twig', [
            'publicite' => $publicite,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/newfront", name="publicite_newfront", methods={"GET","POST"})
     */
    public function newfront(Request $request): Response
    {
        $publicite = new Publicite();
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($publicite);
            $entityManager->flush();

            return $this->redirectToRoute('publicite_index');
        }

        return $this->render('publicite/new_front.html.twig', [
            'publicite' => $publicite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/pub_prix/{id}", name="publicite_prix")
     */
    public function pub_prix(Publicite $pub): Response
    {
        $prix = $pub->getPrix() * $pub->getAffichage();
        return $this->render('publicite/prix.html.twig', [
            'prix' => $prix,
            'publicite' => $pub
        ]);
    }

    /**
     * @Route("/pub_carousel/{id}", name="publicite_carousel")
     */
    public function pub_carousel(Publicite $pub)
    {
        $image = base64_encode(stream_get_contents($pub->getImage()));
        return $this->render('publicite/carousel.html.twig',[
            'image' => $image
        ]);
    }
    /**
     * @Route("/{id}", name="publicite_show", methods={"GET"})
     */
    public function show(Publicite $publicite): Response
    {
        return $this->render('publicite/show.html.twig', [
            'publicite' => $publicite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="publicite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Publicite $publicite): Response
    {
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publicite_index');
        }

        return $this->render('publicite/edit.html.twig', [
            'publicite' => $publicite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="publicite_delete", methods={"POST"})
     */
    public function delete(Request $request, Publicite $publicite): Response
    {
        if ($this->isCsrfTokenValid('delete' . $publicite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($publicite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('publicite_index');
    }
}
