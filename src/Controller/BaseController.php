<?php

namespace App\Controller;

use App\Entity\Publicite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/base", name="base")
     */
    public function index(): Response
    {

        return $this->render('base.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
}
