<?php

namespace App\Controller;

use App\Entity\HorseClub;
use App\Form\HorseClubType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/horse-club")
 */
class HorseClubController extends AbstractController
{
    /**
     * @Route("/", name="horse_club_index", methods={"GET"})
     */
    public function index(): Response
    {
        $horseClubs = $this->getDoctrine()
            ->getRepository(HorseClub::class)
            ->findAll();

        return $this->render('horse_club/index.html.twig', [
            'horse_clubs' => $horseClubs,
        ]);
    }

    /**
     * @Route("/new", name="horse_club_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $horseClub = new HorseClub();
        $form = $this->createForm(HorseClubType::class, $horseClub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($horseClub);
            $entityManager->flush();

            return $this->redirectToRoute('horse_club_index');
        }

        return $this->render('horse_club/new.html.twig', [
            'horse_club' => $horseClub,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{horseClubId}", name="horse_club_show", methods={"GET"})
     */
    public function show(HorseClub $horseClub): Response
    {
        return $this->render('horse_club/show.html.twig', [
            'horse_club' => $horseClub,
        ]);
    }

    /**
     * @Route("/{horseClubId}/edit", name="horse_club_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HorseClub $horseClub): Response
    {
        $form = $this->createForm(HorseClubType::class, $horseClub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('horse_club_index');
        }

        return $this->render('horse_club/edit.html.twig', [
            'horse_club' => $horseClub,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{horseClubId}", name="horse_club_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HorseClub $horseClub): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horseClub->getHorseClubId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($horseClub);
            $entityManager->flush();
        }

        return $this->redirectToRoute('horse_club_index');
    }
}
