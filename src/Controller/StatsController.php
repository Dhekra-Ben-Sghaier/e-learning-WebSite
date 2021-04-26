<?php

namespace App\Controller;

use App\Entity\Publicite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatsController extends AbstractController
{
    /**
     * @Route("/stats", name="stats")
     */
    public function index(): Response
    {
        $Pers = $this->getDoctrine()->getManager()->getRepository(Publicite::class)->findAll();
        $NB = 0;
        $NB1 = 0;
        for ($i=0;$i<sizeof($Pers);$i++)
        {
            if($Pers[$i]->getAffichage()>200)
            {
                $NB++;
            }
            if($Pers[$i]->getPrix()<10000)
            {
                $NB1++;
            }
        }
        $session = $this->get('session');
        $session->set('Number',$NB);
        $session->set('Total',round($NB*100/(sizeof($Pers))));
        $session->set('Number1',$NB1);
        $session->set('Total1',round($NB1*100/(sizeof($Pers))));
        return $this->render('stats/index.html.twig', [
            'controller_name' => 'StatsController',
        ]);
    }
}
