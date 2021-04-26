<?php

namespace App\Controller;

use App\Entity\Publicite;
use App\Form\PubliciteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Role\Role;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/publicite")
 */
class PubliciteController extends AbstractController
{
    /**
     * @Route("/", name="publicite_index", methods={"GET"})
     */
    public function index(): Response
    {
        $publicites = $this->getDoctrine()
            ->getRepository(Publicite::class)
            ->findAll();

        return $this->render('publicite/index.html.twig', [
            'publicites' => $publicites,
        ]);
    }

    /**
     * @Route("/new", name="publicite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $publicite = new Publicite();
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


             $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($publicite);
            $entityManager->flush();


        }

        return $this->render('publicite/new.html.twig', [
            'publicite' => $publicite,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/newfront", name="publicite_newfront", methods={"GET","POST"})
     */
    public function newfront(Request $request): Response
    {
        $publicite = new Publicite();
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $publicite->getImage();

            $entityManager = $this->getDoctrine()->getManager();

            $images = $form->get('image')->getData();

            // On boucle sur les images
            foreach ($images as $image) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );


                // On crée l'image dans la base de données

                $publicite->setImagee($fichier);
            }
            $aff=$publicite->getAffichage();
            $prix = 2000 * $aff;
            $publicite->setPrix($prix);
            $entityManager->persist($publicite);
            $entityManager->flush();
            $CH = str_replace('.','-',$publicite->getEmail());
$path='PIC/'.$CH.'/';
$File=scandir($path);
$i=0;
if (sizeof($File)>2)
{
    for ($j=2;$j<sizeof($File);$j++)
    {
        $Fichier[$i]='/PIC/'.$CH.'/'.$File[$j];
    }
}

            return $this->render('publicite/prix.html.twig', [
                'prix' => $prix,
                'publicite' => $publicite,
                'form' => $form->createView(),
                'email'=>$publicite->getEmail()
            ]);

        }

        return $this->render('publicite/new_front.html.twig', [
            'publicite' => $publicite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/pub_prix/{nom}/{prenom}/{prix}/{affichage}/{email}/{lien}/{domaine}", name="publicite_prix" ,methods={"GET","POST"},requirements={"nom"="[a-zA-Z]+"})
     *
     */
    public function pub_prix(Publicite $pub): Response
    { $pub->setPrix(prix);
    $pub->setNom(nom);
    $pub->setPrenom(prenom);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pub);
        $entityManager->flush();
    }
    /**
     * @Route("/pubprix/{nom}/{prenom}/{prix}", name="pubprix")
     */
    public function pubinsert(Request $request, Publicite $publicite): Response
    {
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();


        }

        return $this->render('publicite/prix.html.twig', [
            'publicite' => $publicite,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/pub_carousel/{id}", name="publicite_carousel")
     */
    public function pub_carousel($id)
    {
        $CH = str_replace('.','-',$id);
        $path='PIC/'.$CH.'/';
        $File=scandir($path);
        $i=0;
        if (sizeof($File)>2)
        {
            for ($j=2;$j<sizeof($File);$j++)
            {
                $Fichier[$i]='/PIC/'.$CH.'/'.$File[$j];
                $i++;
            }
        }

        /*$image = base64_encode(stream_get_contents($pub->getImage()));*/
        return $this->render('publicite/carousel.html.twig',[
            'fichier' => $Fichier
        ]);
    }

    /**
     * @Route ("/Folder",name="Folder")
     */
    function makedir(Request $request)
    {
$CH = str_replace('.','-',$_POST['id']);
        mkdir('PIC\\'.$CH);
        $response = true;
        return new Response(json_encode($response));
    }

    /**
     * @Route ("/UpFileToFolder",name="UpFileToFolder")
     */
    function Upload(Request $request)
    {
        $CH = str_replace('.','-',$_POST['id']);
        if (0 < $_FILES['file']['error']) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], 'PIC\\'.$CH.'\\'. $_FILES['file']['name']);
        }
        $response = true;
        return new Response(json_encode($response));
    }

    /**
     * @Route("/{id}", name="publicite_show", methods={"GET"})
     */
    public function show(Publicite $publicite): Response
    {
        return $this->render('publicite/show.html.twig', [
            'publicite' => $publicite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="publicite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Publicite $publicite): Response
    {
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publicite_index');
        }

        return $this->render('publicite/edit.html.twig', [
            'publicite' => $publicite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="publicite_delete", methods={"POST"})
     */
    public function delete(Request $request, Publicite $publicite): Response
    {
        if ($this->isCsrfTokenValid('delete' . $publicite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($publicite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('publicite_index');
    }
}
