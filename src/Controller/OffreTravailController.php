<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
