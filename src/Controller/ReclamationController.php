<?php

namespace App\Controller;

use App\Entity\Reclamation ;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;



/**
 * @Route("/reclamation")
 */
class ReclamationController extends AbstractController
{
    /**
     * @Route("/", name="reclamation_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $reclamations = $this->getDoctrine()
            ->getRepository(Reclamation::class)
            ->findAll();
        $reclamations = $paginator->Paginate(
            $reclamations,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }
    /**
     * @Route("/recherche", name="recherche")
     */
    public function Rec(ReclamationRepository $reclamationRepository, Request $request,PaginatorInterface $paginator): Response
    {

        $data = $request->get('search');
        $reclamation = $reclamationRepository->SearchName($data);
        $reclamation = $paginator->paginate(
            $reclamation, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4);/*limit per page*/
        return $this->render('reclamation/index.html.twig', array('reclamations' => $reclamation));
    }
    /**
     * @Route("/new", name="reclamation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('reclamation_new');
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idReclamation}", name="reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/{idReclamation}/edit", name="reclamation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_index');
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idReclamation}", name="reclamation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reclamation->getIdReclamation(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reclamation_index');
    }

   /**
     * @Route ("/recherchereclamation",name="recherchereclamation")
    *
     */
    public function recherche(ReclamationRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $data = $request->get('search');
        $reclamation = $repository->SearchName($data);
        $reclamation = $paginator->paginate(
           $reclamation, /* query NOT result */
          $request->query->getInt('page', 1), /*page number*/
           4);/*limit per page*/
        return $this->render('reclamation/index.html.twig', array('reclamation' => $reclamation));
    }

}

/*    /**
     * @Route("/searchReclamationx ", name="searchReclamationx")
     */
 /*   public function searchReclamationx(Request $request, NormalizerInterface $Normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(Reclamation::class);
        $requestString = $request->get('searchValue');
        $reclamations = $repository->findByadresse($requestString);
        $jsonContent = $Normalizer->normalize($reclamations, 'json', ['groups' => ' rec:read']);
        $retour = json_encode($jsonContent);
        return new Response($retour);
   }









}
