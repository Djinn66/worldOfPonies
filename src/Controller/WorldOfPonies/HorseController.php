<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Horse;
use App\Form\WorldOfPonies\HorseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/worldofponies/horse")
 */
class HorseController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_horse_index", methods={"GET"})
     */
    public function index(): Response
    {
        $horses = $this->getDoctrine()
            ->getRepository(Horse::class)
            ->findAll();

        return $this->render('world_of_ponies/horse/index.html.twig', [
            'horses' => $horses,
        ]);
    }

    /**
     * @Route("/new", name="world_of_ponies_horse_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $horse = new Horse();
        $form = $this->createForm(HorseType::class, $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($horse);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_horse_index');
        }

        return $this->render('world_of_ponies/horse/new.html.twig', [
            'horse' => $horse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{horseId}", name="world_of_ponies_horse_show", methods={"GET"})
     */
    public function show(Horse $horse): Response
    {
        return $this->render('world_of_ponies/horse/show.html.twig', [
            'horse' => $horse,
        ]);
    }

    /**
     * @Route("/{horseId}/edit", name="world_of_ponies_horse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Horse $horse): Response
    {
        $form = $this->createForm(HorseType::class, $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('world_of_ponies_horse_index');
        }

        return $this->render('world_of_ponies/horse/edit.html.twig', [
            'horse' => $horse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{horseId}", name="world_of_ponies_horse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Horse $horse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horse->getHorseId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($horse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_horse_index');
    }
}
