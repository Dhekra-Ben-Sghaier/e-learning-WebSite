<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseAdminController extends AbstractController
{
    /**
     * @Route("/base/admin", name="base_admin")
     */
    public function index(): Response
    {
        return $this->render('base_admin.html.twig', [
            'controller_name' => 'BaseAdminController',
        ]);
    }
}
