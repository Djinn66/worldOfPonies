<?php

namespace App\Controller;

use App\Entity\Breed;
use App\Form\BreedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/breed")
 */
class BreedController extends AbstractController
{
    /**
     * @Route("/", name="breed_index", methods={"GET"})
     */
    public function index(): Response
    {
        $breeds = $this->getDoctrine()
            ->getRepository(Breed::class)
            ->findAll();

        return $this->render('breed/index.html.twig', [
            'breeds' => $breeds,
        ]);
    }

    /**
     * @Route("/new", name="breed_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $breed = new Breed();
        $form = $this->createForm(BreedType::class, $breed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($breed);
            $entityManager->flush();

            return $this->redirectToRoute('breed_index');
        }

        return $this->render('breed/new.html.twig', [
            'breed' => $breed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{breedId}", name="breed_show", methods={"GET"})
     */
    public function show(Breed $breed): Response
    {
        return $this->render('breed/show.html.twig', [
            'breed' => $breed,
        ]);
    }

    /**
     * @Route("/{breedId}/edit", name="breed_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Breed $breed): Response
    {
        $form = $this->createForm(BreedType::class, $breed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('breed_index');
        }

        return $this->render('breed/edit.html.twig', [
            'breed' => $breed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{breedId}", name="breed_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Breed $breed): Response
    {
        if ($this->isCsrfTokenValid('delete'.$breed->getBreedId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($breed);
            $entityManager->flush();
        }

        return $this->redirectToRoute('breed_index');
    }
}
