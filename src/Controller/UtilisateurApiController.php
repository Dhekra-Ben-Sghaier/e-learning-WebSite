<?php

namespace App\Controller;

use App\Entity\Personnes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UtilisateurApiController extends AbstractController
{
    /**
     * @Route("/utilisateur/api", name="utilisateur_api")
     */
    public function index(): Response
    {
        return $this->render('utilisateur_api/index.html.twig', [
            'controller_name' => 'UtilisateurApiController',
        ]);
    }

    /**
     * @Route("user/appregister", name="app_register")
     */
    public function  signupAction(Request  $request, UserPasswordEncoderInterface $passwordEncoder) {
        $cin = $request->query->get("cin");
        $nom = $request->query->get("nom");
        $prenom = $request->query->get("prenom");
        $email = $request->query->get("email");
        $username = $request->query->get("nomutilisateur");
        $password = $request->query->get("password");
        $cd = $request->query->get("centreinteret");
        $role= $request->query->get("role");


        $user = new Personnes();
        $user->setCin($cin);
        $user->setNom($nom);
        $user->setPrenom($prenom);

        $user->setNomutilisateur($username);

        $user->setCentreinteret($cd);

        $user->setRole($role);
        $user->setEmail($email);
        $pass = $passwordEncoder->encodePassword(
            $user,
            $password
        );
        $user->setPassword($pass);
        $user->setEtat(true);//par défaut user lazm ykoun enabled.
        $user->setPhoto('profil.png');

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return new JsonResponse("success",200);//200 ya3ni http result ta3 server OK
        }catch (\Exception $ex) {
            return new Response("execption ".$ex->getMessage());
        }
    }

    /**
     * @Route("user/formregister", name="form_register")
     */
    public function  signupFAction(Request  $request, UserPasswordEncoderInterface $passwordEncoder) {
        $cin = $request->query->get("cin");
        $nom = $request->query->get("nom");
        $prenom = $request->query->get("prenom");
        $email = $request->query->get("email");
        $username = $request->query->get("nomutilisateur");
        $password = $request->query->get("password");
        $domaine = $request->query->get("domaine");
        $role= $request->query->get("role");


        $user = new Personnes();
        $user->setCin($cin);
        $user->setNom($nom);
        $user->setPrenom($prenom);

        $user->setNomutilisateur($username);

        $user->setDomaine($domaine);

        $user->setRole($role);
        $user->setEmail($email);
        $pass = $passwordEncoder->encodePassword(
            $user,
            $password
        );
        $user->setPassword($pass);
        $user->setEtat(true);//par défaut user lazm ykoun enabled.
        $user->setPhoto('profil.png');

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return new JsonResponse("success",200);//200 ya3ni http result ta3 server OK
        }catch (\Exception $ex) {
            return new Response("execption ".$ex->getMessage());
        }
    }
    /**
     * @Route("user/socregister", name="soc_register")
     */
    public function  signupsAction(Request  $request, UserPasswordEncoderInterface $passwordEncoder) {

        $nomsoc = $request->query->get("nomsociete");

        $email = $request->query->get("email");
        $username = $request->query->get("nomutilisateur");
        $password = $request->query->get("password");

        $role= $request->query->get("role");


        $user = new Personnes();

        $user->setNomsociete($nomsoc);


        $user->setNomutilisateur($username);



        $user->setRole($role);
        $user->setEmail($email);
        $pass = $passwordEncoder->encodePassword(
            $user,
            $password
        );
        $user->setPassword($pass);
        $user->setEtat(true);//par défaut user lazm ykoun enabled.
        $user->setPhoto('profil.png');

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return new JsonResponse("success",200);//200 ya3ni http result ta3 server OK
        }catch (\Exception $ex) {
            return new Response("execption ".$ex->getMessage());
        }
    }
    /**
     * @Route("user/signin", name="appu_login")
     */

    public function signinAction(Request $request) {
        $email = $request->query->get("email");
        $password = $request->query->get("password");

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Personnes::class)->findOneBy(['email'=>$email]);//bch nlawj ala user b username ta3o fi base s'il existe njibo
        //ken l9ito f base
        if($user){
            //lazm n9arn password zeda madamo crypté nesta3mlo password_verify
            if(password_verify($password,$user->getPassword())) {
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize($user);
                return new JsonResponse($formatted);
            }
            else {
                return new Response("passowrd not found");
            }
        }
        else {
            return new Response("failed");//ya3ni username/pass mch s7a7

        }
    }


}
