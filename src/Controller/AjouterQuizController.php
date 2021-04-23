<?php

namespace App\Controller;

use App\Entity\Questionn;
use App\Entity\Quizz;
use App\Form\QuestionnType;
use App\Form\QuizType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\InscriCertif;
use App\Form\InscriCertifType;

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

            return $this->redirectToRoute('inscri_certif_index');
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

        return $this->render("quizz/res.html.twig",[
            'res' => $res/count($qts)* 100 
        ]);
    }
}
