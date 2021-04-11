<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecformationController extends AbstractController
{
    /**
     * @Route("/recformation", name="recformation")
     */
    public function index(): Response
    {
        return $this->render('recformation/index.html.twig', [
            'controller_name' => 'RecformationController',
        ]);
    }
}
