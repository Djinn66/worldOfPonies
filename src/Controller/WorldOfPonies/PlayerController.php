<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Player;
use App\Form\WorldOfPonies\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/worldofponies/player")
 */
class PlayerController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_player_index", methods={"GET"})
     */
    public function index(): Response
    {
        $players = $this->getDoctrine()
            ->getRepository(Player::class)
            ->findAll();

        return $this->render('world_of_ponies/player/index.html.twig', [
            'players' => $players,
        ]);
    }

    /**
     * @Route("/new", name="world_of_ponies_player_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($player);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_player_index');
        }

        return $this->render('world_of_ponies/player/new.html.twig', [
            'player' => $player,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{playerId}", name="world_of_ponies_player_show", methods={"GET"})
     */
    public function show(Player $player): Response
    {
        return $this->render('world_of_ponies/player/show.html.twig', [
            'player' => $player,
        ]);
    }

    /**
     * @Route("/{playerId}/edit", name="world_of_ponies_player_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Player $player): Response
    {
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('world_of_ponies_player_index');
        }

        return $this->render('world_of_ponies/player/edit.html.twig', [
            'player' => $player,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{playerId}", name="world_of_ponies_player_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Player $player): Response
    {
        if ($this->isCsrfTokenValid('delete'.$player->getPlayerId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($player);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_player_index');
    }
}
