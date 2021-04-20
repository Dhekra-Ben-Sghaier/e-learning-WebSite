<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Form\AchatType;
use App\Repository\AchatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/achat")
 */
class AchatController extends AbstractController
{
    /**
     * @Route("/", name="achat_index", methods={"GET"})
     */
    public function index(AchatRepository $achatRepository): Response
    {
        return $this->render('achat/index.html.twig', [
            'achats' => $achatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="achat_new", methods={"GET","POST"})
     * @param Request $request
     * @param $entityManager
     * @return Response
     */
    public function new(Request $request, $entityManager): Response
    {
        $achat = new Achat();
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $achat->setIdUser(1);
            $query = $entityManager->createQuery("SELECT f FROM App\Entity\Formation f WHERE f.formationId = :id");
            $query->setParameter('id',$request->attributes->get('id'));
            $formation = $query->getSingleResult();
            $achat->setId($formation);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($achat);
            $entityManager->flush();

            return $this->redirectToRoute('achat_index');
        }

        return $this->render('achat/new.html.twig', [
            'achat' => $achat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="achat_show", methods={"GET"})
     */
    public function show(Achat $achat): Response
    {
        return $this->render('achat/show.html.twig', [
            'achat' => $achat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="achat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Achat $achat): Response
    {
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $achat->setIdUser(1);
            $achat->setIdUser(1);
            $query =  $this->createQuery("SELECT f FROM App\Entity\Formation f WHERE f.formationId = :id");
            $query->setParameter('id',$request->attributes->get('id'));
            $formation = $query->getSingleResult();
            $achat->setId($formation);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('achat_index');
        }

        return $this->render('formation/details.html.twig', [
            'achat' => $achat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="achat_delete", methods={"POST"})
     */
    public function delete(Request $request, Achat $achat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$achat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($achat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('achat_index');
    }
}
