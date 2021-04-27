<?php

namespace App\Controller;

use App\Entity\Questionn;
use App\Entity\Quizz;
use App\Form\QuestionnType;
use App\Form\QuizType;
use Dompdf\Dompdf;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\InscriCertif;
use App\Form\InscriCertifType;
use Dompdf\Options;


class AjouterQuizController extends AbstractController
{
    /**
     * @Route("/ajouter/quiz", name="ajouter_quiz")
     */
    public function index(): Response
    {
        $ajouterQuiz = $this->getDoctrine()
            ->getRepository(InscriCertif::class)
            ->findAll();
        return $this->render('ajout_quiz/AjoutQuiz.html.twig', [
            'AjouterQuiz' => '$ajouterQuiz',
        ]);
    }
    /**
     * @Route("/quest", name="quest_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $question = new Questionn();
        $form = $this->createForm(QuestionnType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();


        }

        return $this->render('ajout_quiz/AjoutQuiz.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }
    public function new1(Request $request): Response
    {
        $quiz = new Quizz();
        $quiz = $this->createForm(QuizType::class, $quiz);
        $quiz->handleRequest($request);

        if ($quiz->isSubmitted() && $quiz->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quiz);
            $entityManager->flush();

            return $this->redirectToRoute('inscri_certif_index');
        }

        return $this->render('ajout_quiz/AjoutQuiz.html.twig', [
            'quiz' => $quiz,
            'quizbh' => $quiz->createView(),
        ]);
    }

    /**
     * @Route("/quizzz", name="affich_quiz", methods={"GET","POST"})
     */

    public function afficherQuiz()
    {
        return $this->render('ajout_quiz/AfficherQuizzUser.html.twig', [
            'question' => $this->getDoctrine()->getRepository(Questionn::class)->findAll(),
        ]);
    }

    /**
     * @Route("/passer_quiz" , name="passer_quiz")
     */

    public function liste_quiz(Request $request)
    {

        
        return $this->render("quizz/index_front.html.twig", [
            
        ]);
    }

    /**
     * @Route("/question" , name="question")
     */

    public function question(Request $request)
    {
        
        $qts = $this->getDoctrine()->getRepository(Questionn::class)->findBy(['idquiz' => $request->request->get('quiz')]);
        return $this->render("quizz/quiz.html.twig", [
            'questions' => $qts,
            'i' => 1,
            'n' => count($qts),
            'idquiz' => $request->request->get('quiz')
        ]);
    }

    /**
     * @Route("/res/{id}" , name="res")
     */
    public function res($id , Request $request){
        $res=$request->request->get('res');
        $qts = $this->getDoctrine()->getRepository(Questionn::class)->findBy(['idquiz' =>$id]);
        $this->render("quizz/res.html.twig",[
            'res' => $res
        ]);
        $qt= count($qts);
        $p=$res/count($qts)* 100;






        return $this->render("quizz/res.html.twig",[
            'res' => $res/count($qts)* 100
        ]);



    }
    /**
     * @Route("/pdf/{nom}/{prenom}", name="p_df", methods={"GET","POST"})

     */
    public function pf(Request $request,$nom,$prenom)
    {
        $res=$request->request->get('res');
        $this->render("quizz/res.html.twig",[
            'res' => $res
        ]);




        $html = "
        <body>
            <div id='1'/>        
            <h1>
                 <center> 
                     <br><br>     
                     Félicitations,$nom $prenom
                     <br><br>
                     Vous avez passez le quiz avec un pourcentage de 100%                    
                     <br><br>            
                     Votre nombre de bonnes réponses est :  <h1> 2  sur  2 </h1> 
                     <img src='https://www.pngrepo.com/png/285618/512/award-trophy.png', class='maissa'>
                 </center>
                     
            </h1>             
       <style>
            body {
            	background-color: #FFFFE0;
              
            }
            #1{
                 border-style : solid;
                 display : inline-block;
                 height : 0;
                 width : 0;
                 border-top : 80px solid brown;
                 border-right : 180px solid transparent;
                 border-left : 180px solid transparent;
            }
                .maissa{                
                max-width: 200px;
                height: 83px;
                alignment:left; 
                }
            </style>
        </body>
        
        ";
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("codexworld",array("Attachment"=>0));

    }
    /**
     * @Route("/retour", name="retour", )

     */
    public function retour(FlashyNotifier $flashy){
        $flashy->success('Event created!', 'http://your-awesome-link.com');
        return $this->render("quizz/index_front.html.twig");


    }



}
