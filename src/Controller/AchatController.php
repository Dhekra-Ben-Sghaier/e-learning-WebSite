<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Entity\Formation;
use App\Entity\Personnes;
use App\Form\AchatType;
use App\Repository\AchatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/achat")
 */
class AchatController extends AbstractController
{
    /**
     * @Route("/", name="achat_index", methods={"GET"})
     */
    public function index(AchatRepository $achatRepository): Response
    {
        return $this->render('achat/index.html.twig', [
            'achats' => $achatRepository->findAll(),
        ]);
    }
    
    
      /**
     * @Route("/M", name="achat_indexM", methods={"GET"})
     */
    public function indexM(AchatRepository $achatRepository, NormalizerInterface $Normalizer): Response
    {
        $formations = $this->getDoctrine()
            ->getRepository(Achat::class)
            ->findAll();
        $jsoncontent = $Normalizer->normalize($formations,'json',['groups'=>'post:read']);
       
        return new JsonResponse($jsoncontent);
    }
    

    /**
     * @Route("/new/{id}/{iduser}", name="achat_new", methods={"GET","POST"})
     * @param Request $request
     * @param $entityManager
     * @return Response
     */
    public function new($id,$iduser, \Swift_Mailer $mailer): Response
    {


        $verif=$this->getDoctrine()->getManager()->getRepository(Achat::class)->findById($id);

        $allAchat = array();

        foreach ($verif as $p){
            array_push($allAchat,$p);
        }
        foreach ($allAchat as $ac) {

            if($ac->getId()==$id){
                //dump($iduser);
                //die();
                return  new Response(
                    '<html><body><script lang="javascript"> alert("déjà acheté")</script> </body></html>');
        }

        }

        $achat = new Achat();
        $achat->setIdUser($this->getDoctrine()->getManager()->getReference(Personnes::class, $iduser));
    //$achat->setIdUser($iduser);
        $achat->setId($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($achat);
        $this->getDoctrine()->getManager()->flush();
        $message = (new \Swift_Message('Formation'))
            ->setFrom('brainovation21@gmail.com')
            ->setTo('mariembenhassine98@gmail.com')
            ->setBody(
                $this->renderView('formation/mail_Achat.html.twig'),
                'text/html'
            );
        $mailer->send($message);
        return $this->render('formation/succes_achat.html.twig');

    }
    
   
    
       /**
     * @Route("/newM/{id}/{iduser}", name="achat_newM", methods={"GET","POST"})
     * @param Request $request
     * @param $entityManager
     * @return Response
     */
    public function newM($id,$iduser, \Swift_Mailer $mailer,NormalizerInterface $normalizer): Response
    {

        $verif=$this->getDoctrine()->getManager()->getRepository(Achat::class)->findById($id);

        $allAchat = array();

        foreach ($verif as $p){
            array_push($allAchat,$p);
        }


        $achat = new Achat();
        $achat->setIdUser($this->getDoctrine()->getManager()->getReference(Personnes::class, $iduser));
        $achat->setId($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($achat);
        $this->getDoctrine()->getManager()->flush();
        $message = (new \Swift_Message('Formation'))
            ->setFrom('pidevbrainovation@gmail.com')
            ->setTo('dhekra.bensghaier@esprit.tn')
            ->setBody(
                $this->renderView('formation/mail_Achat.html.twig'),
                'text/html'
            );
        $mailer->send($message);

        $json = $normalizer->normalize($allAchat);




        return new JsonResponse($json);

    }
    

    /**
     * @Route("/{id}/{iduser}", name="achat_show", methods={"GET"})
     */
    public function show($id,$iduser): Response
    {



        //dump($formation);
       // die;
        return $this->render('formation/achat.html.twig', [
            'id' => (int)$id,
            'iduser' => (int)$iduser

        ]);
    }

    /*
     * @Route("/mesFormations", name="mes_achats", methods={"GET"})
     *
    public function mesAchat(): Response
    {
        $em = $this->getDoctrine()->getManager();

       $achats = $this->getDoctrine()
            ->getRepository(Formation::class)
            ->findAll();

        $query = $em->createQuery("SELECT * from formation f , achat a WHERE f.id = a.id AND a.id_user = :id");
        $query->setParameter('id',1);
        $achats = $query->getResult();
        dump($achats);
        die;
        return $this->render('formation/mes_achat.html.twig', [
            'formations' => $achats,

        ]);
    }*/



    /**
     * @Route("/{id}/edit", name="achat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Achat $achat): Response
    {
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $achat->setIdUser(app.user.id);
            $query =  $this->createQuery("SELECT f FROM App\Entity\Formation f WHERE f.formationId = :id");
            $query->setParameter('id',$request->attributes->get('id'));
            $formation = $query->getSingleResult();
            $achat->setId($formation);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('achat_index');
        }

        return $this->render('formation/details.html.twig', [
            'achat' => $achat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="achat_delete", methods={"POST"})
     */
    public function delete(Request $request, Achat $achat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$achat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($achat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('achat_index');
    }
}
