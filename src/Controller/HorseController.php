<?php

namespace App\Controller;

use App\Entity\Horse;
use App\Form\HorseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/horse")
 */
class HorseController extends AbstractController
{
    /**
     * @Route("/", name="horse_index", methods={"GET"})
     */
    public function index(): Response
    {
        $horses = $this->getDoctrine()
            ->getRepository(Horse::class)
            ->findAll();

        return $this->render('horse/index.html.twig', [
            'horses' => $horses,
        ]);
    }

    /**
     * @Route("/new", name="horse_new", methods={"GET","POST"})
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

            return $this->redirectToRoute('horse_index');
        }

        return $this->render('horse/new.html.twig', [
            'horse' => $horse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{horseId}", name="horse_show", methods={"GET"})
     */
    public function show(Horse $horse): Response
    {
        return $this->render('horse/show.html.twig', [
            'horse' => $horse,
        ]);
    }

    /**
     * @Route("/{horseId}/edit", name="horse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Horse $horse): Response
    {
        $form = $this->createForm(HorseType::class, $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('horse_index');
        }

        return $this->render('horse/edit.html.twig', [
            'horse' => $horse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{horseId}", name="horse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Horse $horse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horse->getHorseId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($horse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('horse_index');
    }
}
