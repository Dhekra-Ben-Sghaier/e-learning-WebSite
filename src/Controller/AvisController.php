<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    /**
     * @Route("/avis", name="avis")
     */
    public function index(): Response
    {
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
        ]);
    }
    /**
     * @Route("/rating/{idform}/{iduser}", name="rating",methods={"GET","POST"})
     */
    public function rate(Request $request,$idform,$iduser): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $avis->setIdForm($idform);
            $avis->setIdUs($iduser);
            $entityManager = $this->getDoctrine()->getManager();


            $entityManager->persist($avis);

            $entityManager->flush();


        }


        return $this->render('avis/rating.html.twig', [

            'form' => $form->createView()
        ]);
    }
}
