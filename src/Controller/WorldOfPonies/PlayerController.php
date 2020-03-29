<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Player;
use App\Form\WorldOfPonies\PlayerType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/worldofponies/player")
 * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_ADMIN')")
 */
class PlayerController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_player_index", methods={"GET"})
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_ADMIN')")
     */
    public function index(PaginatorInterface $paginator,Request $request): Response
    {
        $playerUsername = $request->query->get('playerUsername');
        $playerFirstname = $request->query->get('playerFirstname');
        $playerLastname = $request->query->get('playerLastname');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($playerUsername !="")
            $criteria += ['playerUsername' => $playerUsername];
        if($playerFirstname !="")
            $criteria += ['playerFirstname' => $playerFirstname];
        if($playerLastname !="")
            $criteria += ['playerLastname' => $playerLastname];

        $players =  $this->getDoctrine()
            ->getRepository(Player::class)
            ->findBy($criteria,$orderBy);

        $pagination = $paginator->paginate(
            $players,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('world_of_ponies/player/index.html.twig', [
            'playerUsername' => $playerUsername,
            'playerFirstname' => $playerFirstname,
            'playerLastname' => $playerLastname,
            'order' => $order,
            'sortBy' => $sortBy,
            'players' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="world_of_ponies_player_new", methods={"GET","POST"})
     * @Security("is_granted('ROLE_SUPERUSER') or is_granted('ROLE_PROGRAMMER')")
     */
    public function new(Request $request): Response
    {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
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
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_ADMIN')")
     */
    public function show(Player $player): Response
    {
        return $this->render('world_of_ponies/player/show.html.twig', [
            'player' => $player,
        ]);
    }

    /**
     * @Route("/{playerId}/edit", name="world_of_ponies_player_edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_ADMIN')")
     */
    public function edit(Request $request, Player $player): Response
    {
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

            return $this->redirectToRoute('world_of_ponies_player_index');
        }

        return $this->render('world_of_ponies/player/edit.html.twig', [
            'player' => $player,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{playerId}", name="world_of_ponies_player_delete", methods={"DELETE"})
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_ADMIN')")
     */
    public function delete(Request $request, Player $player): Response
    {
        if ($this->isCsrfTokenValid('delete'.$player->getPlayerId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->remove($player);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_player_index');
    }

    /**
     * @Route("/", name="world_of_ponies_player_delete_selected", methods={"DELETE"})
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_ADMIN')")
     */
    public function deleteSelected(Request $request): Response
    {

        //return $this->json($request->request->get('_token'));
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            //if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $player = $this->getDoctrine()->getRepository(Player::class)->find($id);
            if(isset($player)){
                $entityManager = $this->getDoctrine()->getManager('worldofponies');
                $entityManager->remove($player);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        //return $this->redirectToRoute('world_of_ponies_player_index');
        return $this->json( "deleted");
    }
}
