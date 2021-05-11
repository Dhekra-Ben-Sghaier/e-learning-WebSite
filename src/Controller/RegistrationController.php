<?php

namespace App\Controller;

use App\Entity\Personnes;
use App\Form\ApprenantType;
use App\Form\FormateurType;
use App\Form\SocType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function index(): Response
    {
        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(): Response
    {
        return $this->render('registration/register.html.twig');
    }
    /**
     * @Route("/appregister", name="appregister")
     */
    public function inscrireapp(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $personne = new Personnes();
        $form = $this->createForm(ApprenantType::class, $personne);

        $form->add('cin',TextType::class, [
            'data' => ' '
        ]);
        $form->add('nom',TextType::class, [
            'data' => ' '
        ]);
        $form->add('prenom',TextType::class, [
            'data' => ' '
        ]);
        $form->add('nomutilisateur',TextType::class, [
        'data' => ' '
    ]);
        $form ->add('centreinteret',TextType::class, [
            'data' => ' '
        ]);
        $form->remove('etat');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             $personne->setEtat(1);
             $personne->setPhoto('profil.png');
            $var=$personne->getRole();
            //dd($personne->getPassword());
            if($var=="apprenant"){

                //$apprenant = new Personnes();
                $personne->setPassword(
                    $passwordEncoder->encodePassword(
                        $personne,
                        $form->get('plainPassword')->getData()
                    )
                );

                    $entityManager = $this->getDoctrine()->getManager();


                    $entityManager->persist($personne);

                    $entityManager->flush();
                    return $this->render('registration/register.html.twig');


            }

        }
        return $this->render('registration/appregister.html.twig', [
            'personne' => $personne,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/inscriform", name="inscritform", methods={"GET","POST"})
     * @param Request $request
     * @param $passwordEncoder
     * @return Response
     */
    public function inscrireform(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {

        $personne = new Personnes();
        $form = $this->createForm(FormateurType::class, $personne);

        $form->add('cin',TextType::class, [
            'data' => ' '
        ]);
        $form->add('nom',TextType::class, [
            'data' => ' '
        ]);
        $form->add('prenom',TextType::class, [
            'data' => ' '
        ]);
        $form->add('nomutilisateur',TextType::class, [
            'data' => ' '
        ]);
        $form ->add('domaine',TextType::class, [
            'data' => ' '
        ]);
        $form->remove('etat');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $personne->setEtat(1);
            $personne->setPhoto('profil.png');
            $var=$personne->getRole();
            //dd($personne->getPassword());


            //$apprenant = new Personnes();
            $personne->setPassword(
                $passwordEncoder->encodePassword(
                    $personne,
                    $form->get('plainPassword')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();


            $entityManager->persist($personne);

            $entityManager->flush();
            return $this->render('registration/register.html.twig');


        }


        return $this->render('registration/formregister.html.twig', [
            'personne' => $personne,
            'form' => $form->createView()
        ]);

    }
    /**
     * @Route("/inscrisoc", name="societeinscri", methods={"GET","POST"})
     * @param Request $request
     * @param $passwordEncoder
     * @return Response
     */
    public function socsociete(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {

        $personne = new Personnes();
        $form = $this->createForm(SocType::class, $personne);


        $form->add('nomsociete',TextType::class, [
            'data' => ' '
        ]);

        $form->add('nomutilisateur',TextType::class, [
            'data' => ' '
        ]);

        $form->remove('etat');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $personne->setEtat(1);
            $personne->setPhoto('profil.png');
            $var=$personne->getRole();
            //dd($personne->getPassword());


            //$apprenant = new Personnes();
            $personne->setPassword(
                $passwordEncoder->encodePassword(
                    $personne,
                    $form->get('plainPassword')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();


            $entityManager->persist($personne);

            $entityManager->flush();
            return $this->render('registration/register.html.twig');


        }


        return $this->render('registration/socregister.html.twig', [
            'personne' => $personne,
            'form' => $form->createView()
        ]);

    }


}
