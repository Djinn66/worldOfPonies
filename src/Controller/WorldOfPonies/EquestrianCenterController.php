<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\EquestrianCenter;
use App\Form\WorldOfPonies\EquestrianCenterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/worldofponies/equestrian_center")
 */
class EquestrianCenterController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_equestrian_center_index", methods={"GET"})
     */
    public function index(): Response
    {
        $equestrianCenters = $this->getDoctrine()
            ->getRepository(EquestrianCenter::class)
            ->findAll();

        return $this->render('world_of_ponies/equestrian_center/index.html.twig', [
            'equestrian_centers' => $equestrianCenters,
        ]);
    }

    /**
     * @Route("/new", name="world_of_ponies_equestrian_center_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $equestrianCenter = new EquestrianCenter();
        $form = $this->createForm(EquestrianCenterType::class, $equestrianCenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->persist($equestrianCenter);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_equestrian_center_index');
        }

        return $this->render('world_of_ponies/equestrian_center/new.html.twig', [
            'equestrian_center' => $equestrianCenter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{equestrianCenterId}", name="world_of_ponies_equestrian_center_show", methods={"GET"})
     */
    public function show(EquestrianCenter $equestrianCenter): Response
    {
        return $this->render('world_of_ponies/equestrian_center/show.html.twig', [
            'equestrian_center' => $equestrianCenter,
        ]);
    }

    /**
     * @Route("/{equestrianCenterId}/edit", name="world_of_ponies_equestrian_center_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EquestrianCenter $equestrianCenter): Response
    {
        $form = $this->createForm(EquestrianCenterType::class, $equestrianCenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

            return $this->redirectToRoute('world_of_ponies_equestrian_center_index');
        }

        return $this->render('world_of_ponies/equestrian_center/edit.html.twig', [
            'equestrian_center' => $equestrianCenter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{equestrianCenterId}", name="world_of_ponies_equestrian_center_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EquestrianCenter $equestrianCenter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equestrianCenter->getEquestrianCenterId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->remove($equestrianCenter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_equestrian_center_index');
    }
}
