<?php

namespace App\Controller;

use App\Entity\Recformation;
use App\Form\RecformationType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recformation")
 */
class RecformationController extends AbstractController
{

    /**
     * @Route("/choix", name="choix")
     */
    public function choix(): Response
    {
        return $this->render('reclamation/choix.html.twig');
    }

    /**
     * @Route("/", name="recformation_index", methods={"GET"})
     */
    public function index(Request $request,PaginatorInterface $paginator): Response
    {
        $recformations = $this->getDoctrine()
            ->getRepository(Recformation::class)
            ->findAll();
        $recformations=$paginator->Paginate(
            $recformations,
            $request->query->getInt('page',1),
            4
        );

        return $this->render('recformation/index.html.twig', [
            'recformations' => $recformations,
        ]);
    }

    /**
     * @Route("/new", name="recformation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recformation = new Recformation();
        $form = $this->createForm(RecformationType::class, $recformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recformation);
            $entityManager->flush();

            return $this->redirectToRoute('recformation_new');
        }

        return $this->render('recformation/new.html.twig', [
            'recformation' => $recformation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idFormation}", name="recformation_show", methods={"GET"})
     */
    public function show(Recformation $recformation): Response
    {
        return $this->render('recformation/show.html.twig', [
            'recformation' => $recformation,
        ]);
    }

    /**
     * @Route("/{idFormation}/edit", name="recformation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Recformation $recformation): Response
    {
        $form = $this->createForm(RecformationType::class, $recformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recformation_index');
        }

        return $this->render('recformation/edit.html.twig', [
            'recformation' => $recformation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idFormation}", name="recformation_delete", methods={"POST"})
     */
    public function delete(Request $request, Recformation $recformation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recformation->getIdFormation(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recformation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recformation_index');
    }
}
