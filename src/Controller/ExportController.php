<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Mpdf\Mpdf;

class ExportController extends AbstractController
{
    /**
     * @Route("/export/{nom}/{prenom}/{email}/{affichage}", name="export")
     */
    public function index($nom,$prenom,$email,$affichage)
    {
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetTitle('Contrat');
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        $ch="  <img src='https://www.smallbusinessact.com/wp-content/uploads/2019/01/SBA-Types-de-contrats-de-travail.png'> <br><br><br>Le contrat suivant est signé par l'annonceur <strong>".$nom." ".$prenom."</strong> , <br><br>et dont le email est le suivant <span style='color: darkred'>".$email."</span>, </br> sera sous forme de partenariat <br><br>pour affichage de publicités sous forme d'image dont le nombre d'affichage <br><br>est le suivant <span style='text-decoration: underline'>".$affichage."</span> <br><br>Le prix total sera ".(2000*$affichage)  ;

        $mpdf->WriteHTML($ch);
        $mpdf->Output();
    }
}
