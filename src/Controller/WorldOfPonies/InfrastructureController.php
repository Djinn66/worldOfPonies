<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Infrastructure;
use App\Form\WorldOfPonies\InfrastructureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/worldofponies/infrastructure")
 */
class InfrastructureController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_infrastructure_index", methods={"GET"})
     */
    public function index(): Response
    {
        $infrastructures = $this->getDoctrine()
            ->getRepository(Infrastructure::class)
            ->findAll();

        return $this->render('world_of_ponies/infrastructure/index.html.twig', [
            'infrastructures' => $infrastructures,
        ]);
    }

    /**
     * @Route("/new", name="world_of_ponies_infrastructure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $infrastructure = new Infrastructure();
        $form = $this->createForm(InfrastructureType::class, $infrastructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->persist($infrastructure);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_infrastructure_index');
        }

        return $this->render('world_of_ponies/infrastructure/new.html.twig', [
            'infrastructure' => $infrastructure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{infrastructureId}", name="world_of_ponies_infrastructure_show", methods={"GET"})
     */
    public function show(Infrastructure $infrastructure): Response
    {
        return $this->render('world_of_ponies/infrastructure/show.html.twig', [
            'infrastructure' => $infrastructure,
        ]);
    }

    /**
     * @Route("/{infrastructureId}/edit", name="world_of_ponies_infrastructure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Infrastructure $infrastructure): Response
    {
        $form = $this->createForm(InfrastructureType::class, $infrastructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

            return $this->redirectToRoute('world_of_ponies_infrastructure_index');
        }

        return $this->render('world_of_ponies/infrastructure/edit.html.twig', [
            'infrastructure' => $infrastructure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{infrastructureId}", name="world_of_ponies_infrastructure_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Infrastructure $infrastructure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infrastructure->getInfrastructureId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->remove($infrastructure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_infrastructure_index');
    }
}
