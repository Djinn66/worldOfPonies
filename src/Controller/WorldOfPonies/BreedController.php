<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Breed;
use App\Form\WorldOfPonies\BreedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/worldofponies/breed")
 */
class BreedController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_breed_index", methods={"GET"})
     */
    public function index(): Response
    {
        $breeds = $this->getDoctrine()
            ->getRepository(Breed::class)
            ->findAll();

        return $this->render('world_of_ponies/breed/index.html.twig', [
            'breeds' => $breeds,
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
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
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
     * @Route("/{breedId}", name="world_of_ponies_breed_show", methods={"GET"})
     */
    public function show(Breed $breed): Response
    {
        return $this->render('world_of_ponies/breed/show.html.twig', [
            'breed' => $breed,
        ]);
    }

    /**
     * @Route("/{breedId}/edit", name="world_of_ponies_breed_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Breed $breed): Response
    {
        $form = $this->createForm(BreedType::class, $breed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

            return $this->redirectToRoute('world_of_ponies_breed_index');
        }

        return $this->render('world_of_ponies/breed/edit.html.twig', [
            'breed' => $breed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{breedId}", name="world_of_ponies_breed_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Breed $breed): Response
    {
        if ($this->isCsrfTokenValid('delete'.$breed->getBreedId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
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
        //return $this->json($request->request->get('_token'));
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            //if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $player = $this->getDoctrine()->getRepository(Breed::class)->find($id);
            if(isset($player)){
                $entityManager = $this->getDoctrine()->getManager('worldofponies');
                $entityManager->remove($player);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        //return $this->redirectToRoute('world_of_ponies_player_index');
        return $this->json( "deleted");
    }
}
