<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Newspaper;
use App\Form\WorldOfPonies\NewspaperType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/worldofponies/newspaper")
 */
class NewspaperController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_newspaper_index", methods={"GET"})
     */
    public function index(): Response
    {
        $newspapers = $this->getDoctrine()
            ->getRepository(Newspaper::class)
            ->findAll();

        return $this->render('world_of_ponies/newspaper/index.html.twig', [
            'newspapers' => $newspapers,
        ]);
    }

    /**
     * @Route("/new", name="world_of_ponies_newspaper_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $newspaper = new Newspaper();
        $form = $this->createForm(NewspaperType::class, $newspaper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->persist($newspaper);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_newspaper_index');
        }

        return $this->render('world_of_ponies/newspaper/new.html.twig', [
            'newspaper' => $newspaper,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{newspaperId}", name="world_of_ponies_newspaper_show", methods={"GET"})
     */
    public function show(Newspaper $newspaper): Response
    {
        return $this->render('world_of_ponies/newspaper/show.html.twig', [
            'newspaper' => $newspaper,
        ]);
    }

    /**
     * @Route("/{newspaperId}/edit", name="world_of_ponies_newspaper_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Newspaper $newspaper): Response
    {
        $form = $this->createForm(NewspaperType::class, $newspaper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

            return $this->redirectToRoute('world_of_ponies_newspaper_index');
        }

        return $this->render('world_of_ponies/newspaper/edit.html.twig', [
            'newspaper' => $newspaper,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{newspaperId}", name="world_of_ponies_newspaper_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Newspaper $newspaper): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newspaper->getNewspaperId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->remove($newspaper);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_newspaper_index');
    }
}