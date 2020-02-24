<?php

namespace App\Controller;

use App\Entity\Newspaper;
use App\Form\NewspaperType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/newspaper")
 */
class NewspaperController extends AbstractController
{
    /**
     * @Route("/", name="newspaper_index", methods={"GET"})
     */
    public function index(): Response
    {
        $newspapers = $this->getDoctrine()
            ->getRepository(Newspaper::class)
            ->findAll();

        return $this->render('newspaper/index.html.twig', [
            'newspapers' => $newspapers,
        ]);
    }

    /**
     * @Route("/new", name="newspaper_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $newspaper = new Newspaper();
        $form = $this->createForm(NewspaperType::class, $newspaper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newspaper);
            $entityManager->flush();

            return $this->redirectToRoute('newspaper_index');
        }

        return $this->render('newspaper/new.html.twig', [
            'newspaper' => $newspaper,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{newspaperId}", name="newspaper_show", methods={"GET"})
     */
    public function show(Newspaper $newspaper): Response
    {
        return $this->render('newspaper/show.html.twig', [
            'newspaper' => $newspaper,
        ]);
    }

    /**
     * @Route("/{newspaperId}/edit", name="newspaper_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Newspaper $newspaper): Response
    {
        $form = $this->createForm(NewspaperType::class, $newspaper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('newspaper_index');
        }

        return $this->render('newspaper/edit.html.twig', [
            'newspaper' => $newspaper,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{newspaperId}", name="newspaper_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Newspaper $newspaper): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newspaper->getNewspaperId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newspaper);
            $entityManager->flush();
        }

        return $this->redirectToRoute('newspaper_index');
    }
}
