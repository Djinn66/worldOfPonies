<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Breed;
use App\Form\WorldOfPonies\BreedType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/worldofponies/breed")
 * @Security("is_granted('ROLE_SUPERUSER') or is_granted('ROLE_PROGRAMMER')")
 */
class BreedController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_breed_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $breedId = $request->query->get('breedId');
        $breedName = $request->query->get('breedName');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($breedId !="")
            $criteria += ['breedId' => $breedId];
        if($breedName !="")
            $criteria += ['breedName' => $breedName];

        $breeds =  $this->getDoctrine()
            ->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Breed::class)
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $breeds,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('world_of_ponies/breed/index.html.twig', [
            'breedId' => $breedId,
            'breedName' => $breedName,
            'order' => $order,
            'sortBy' => $sortBy,
            'breeds' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="world_of_ponies_breed_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $breed = new Breed();
        $form = $this->createForm(BreedType::class, $breed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->persist($breed);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_breed_index');
        }

        return $this->render('world_of_ponies/breed/new.html.twig', [
            'breed' => $breed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show", name="world_of_ponies_breed_show", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        $repository = $this->getDoctrine()
            ->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Breed::class);
        $breed = $repository->find(
            array(
                'breedId'=>$request->query->get('breedId')
            ));

        return $this->render('world_of_ponies/breed/show.html.twig', [
            'breed' => $breed,
        ]);
    }

    /**
     * @Route("/edit", name="world_of_ponies_breed_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Breed::class);
        $breed = $repository->find(
            array(
                '$breedId'=>$request->query->get('$breedId')
            ));

        $form = $this->createForm(BreedType::class, $breed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('world_of_ponies_breed_index');
        }

        return $this->render('world_of_ponies/breed/edit.html.twig', [
            'breed' => $breed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete", name="world_of_ponies_breed_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Breed::class);
        $breed = $repository->find(
            array(
                '$breedId'=>$request->query->get('$breedId')
            ));

        if ($this->isCsrfTokenValid('delete'.$breed->getBreedId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->remove($breed);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_breed_index');
    }

    /**
     * @Route("/", name="world_of_ponies_breed_delete_selected", methods={"DELETE"})
     */
    public function deleteSelected(Request $request): Response
    {
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            $breed = $this->getDoctrine()
                ->getManager($this->getUser()->getRoles()[0])
                ->getRepository(Breed::class)
                ->find($id);

            if(isset($breed)){
                $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
                $entityManager->remove($breed);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        return $this->json( "deleted");
    }
}
