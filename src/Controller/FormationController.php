<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\DomCrawler\Image;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Service\UploaderHelper;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Stream;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @Route("/formation")
 */
class FormationController extends AbstractController
{
    /**
     * @Route("/", name="formation_index", methods={"GET"})
     */
    public function index(): Response
    {
        $formations = $this->getDoctrine()
            ->getRepository(Formation::class)
            ->findAll();

        return $this->render('formation/index.html.twig', [
            'formations' => $formations,
        ]);
    }
    /**
     * @Route("/indexApprenant", name="apprenant_index", methods={"GET"})
     */
    public function indexApprenant(): Response
    {
        $formations = $this->getDoctrine()
            ->getRepository(Formation::class)
            ->findAll();

        return $this->render('formation/index_Apprenant.html.twig', [
            'formations' => $formations,
        ]);
    }

    /**
     * @Route("/mesFormationsAchats", name="mes_achats_formations", methods={"GET"})
     */
    public function showAchatFormation(){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT a from App\Entity\Achat a WHERE a.idUser = :id");

        $query->setParameter('id',1);
        $achats = $query->getResult();
        $formations = array();

        foreach($achats as $a)
        {
            $queryformation = $em->createQuery("SELECT f from App\Entity\Formation f WHERE f.id = :id");
            $queryformation->setParameter('id',$a->getId());

            $formation = $queryformation->getResult();
            array_push($formations,$formation);



        }
        //dump($formations);
        //die();

        return $this->render('formation/mes_formations_achats.html.twig', [
            'formations' => $formations

        ]);

    }





    /**
     * @Route("/new", name="formation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coursFile = $form->get('cours')->getData();
            if ($coursFile) {
                $originalFilename = pathinfo($coursFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$coursFile->guessExtension();
                try {
                    $coursFile->move(
                        $this->getParameter('cours_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $formation->setCours($newFilename);
            }
            // On récupère les images transmises
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

                $formation->setImage($fichier);
            }



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formation);
            $entityManager->flush();
        }



        return $this->render('formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}", name="formation_show", methods={"GET"})
     */
    public function show(Formation $formation): Response
    {
        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }
    /**
     * @Route("/details/{id}", name="formation_details", methods={"GET"})
     */
    public function showDetails(Formation $formation): Response
    {
        return $this->render('formation/details.html.twig', [
            'formation' => $formation,
        ]);
    }

    /**
     * @Route("/detailsMaFormation/{id}", name="ma_formation_details", methods={"GET"})
     */
    public function showDetailsMaFormation(Formation $formation): Response
    {
        return $this->render('formation/mes_achat.html.twig', [
            'formation' => $formation
        ]);
    }

    /**
     * @Route("/showPDF/{id}", name="showPDF")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(Formation::class)->find($id);

        if (!$item) {
            throw $this->createNotFoundException("File with ID $id does not exist!");
        }
        $pdfFile = stream_get_contents($item->getCours());
        //$pdfFile = $item->getCours(); //returns pdf file stored as mysql blob
        $stream = new Stream("C:\\Users\\Asus\\Desktop\\P\webPidevv\\PidevWeb\\public\\uploads\\Cours\\".$pdfFile);

        //$response = new Response( readfile($pdfFile), 200, array('Content-Type' => 'application/pdf'));

        return new BinaryFileResponse($stream);

    }


    /**
     * @Route("/achat/{id}", name="formation_achat", methods={"GET"})
     */
    public function acheter(Formation $formation): Response
    {
        return $this->render('formation/achat.html.twig', [
            'formation' => $formation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formation $formation): Response
    {
        $form = $this->createForm(FormationType::class, $formation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les images transmises
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

                $formation->setImage($fichier);

            }


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formation_index');

        }
        return $this->render('formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}", name="formation_delete", methods={"POST"})
     */
    public function delete(Request $request, Formation $formation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formation_index');
    }
    /**
     * @Route("/supprime/image/{id}", name="formation_delete_image", methods={"DELETE"})
     */
    public function deleteImage(Image $image, Request $request){
        $data = json_decode($request->getContent(), true);

        // On vérifie si le token est valide
        if($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])){
            // On récupère le nom de l'image
            $nom = $image->getName();
            // On supprime le fichier
            unlink($this->getParameter('images_directory').'/'.$nom);

            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }

    /**
     * @Route("formation/searchStudentx ", name="searchFormationtx")
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function searchFormation(Request $request,NormalizerInterface $Normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(Formation::class);
        $requestString=$request->get('searchValue');
        //dd($requestString);
        $formations = $repository->findByTitre($requestString);
        //dd($formations);
        $jsonContent = $Normalizer->normalize($formations, 'json',['groups'=>'post:read']);
        //dd($jsonContent);
        $retour = json_encode($jsonContent);
        return new Response($retour);
    }
    /*  /**
       * @Route("/search/{searchString}", name="search")
       */
    /*public function search($searchString)
    {
        $serializer = new Serializer([new ObjectNormalizer()]);
        $repository = $this->getDoctrine()->getRepository(FormationRepository::class);
        $produits = $repository->findByTitre($searchString);

        $data=$serializer->normalize($produits);
        return new JsonResponse($data);
    }*/
}
