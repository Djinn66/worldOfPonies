<?php

namespace App\Controller;

use App\Entity\Infrastructure;
use App\Form\InfrastructureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/infrastructure")
 */
class InfrastructureController extends AbstractController
{
    /**
     * @Route("/", name="infrastructure_index", methods={"GET"})
     */
    public function index(): Response
    {
        $infrastructures = $this->getDoctrine()
            ->getRepository(Infrastructure::class)
            ->findAll();

        return $this->render('infrastructure/index.html.twig', [
            'infrastructures' => $infrastructures,
        ]);
    }

    /**
     * @Route("/new", name="infrastructure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $infrastructure = new Infrastructure();
        $form = $this->createForm(InfrastructureType::class, $infrastructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($infrastructure);
            $entityManager->flush();

            return $this->redirectToRoute('infrastructure_index');
        }

        return $this->render('infrastructure/new.html.twig', [
            'infrastructure' => $infrastructure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{infrastructureId}", name="infrastructure_show", methods={"GET"})
     */
    public function show(Infrastructure $infrastructure): Response
    {
        return $this->render('infrastructure/show.html.twig', [
            'infrastructure' => $infrastructure,
        ]);
    }

    /**
     * @Route("/{infrastructureId}/edit", name="infrastructure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Infrastructure $infrastructure): Response
    {
        $form = $this->createForm(InfrastructureType::class, $infrastructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('infrastructure_index');
        }

        return $this->render('infrastructure/edit.html.twig', [
            'infrastructure' => $infrastructure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{infrastructureId}", name="infrastructure_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Infrastructure $infrastructure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infrastructure->getInfrastructureId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infrastructure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('infrastructure_index');
    }
}
