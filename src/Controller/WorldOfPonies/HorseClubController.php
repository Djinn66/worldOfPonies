<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\HorseClub;
use App\Form\WorldOfPonies\HorseClubType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/worldofponies/horse_club")
 * @IsGranted("ROLE_PROGRAMMER")
 */
class HorseClubController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_horse_club_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $horseClubId = $request->query->get('horseClubId');
        $horseClubCapacity = $request->query->get('horseClubCapacity');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($horseClubId !="")
            $criteria += ['horseClubId' => $horseClubId];
        if($horseClubCapacity !="")
            $criteria += ['horseClubCapacity' => $horseClubCapacity];

        $horse_clubs =  $this->getDoctrine()
            ->getRepository(HorseClub::class)
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $horse_clubs,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('world_of_ponies/horse_club/index.html.twig', [
            'horseClubId' => $horseClubId,
            'horseClubCapacity' => $horseClubCapacity,
            'order' => $order,
            'sortBy' => $sortBy,
            'horse_clubs' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="world_of_ponies_horse_club_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $horseClub = new HorseClub();
        $form = $this->createForm(HorseClubType::class, $horseClub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->persist($horseClub);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_horse_club_index');
        }

        return $this->render('world_of_ponies/horse_club/new.html.twig', [
            'horse_club' => $horseClub,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{$horseClubId}", name="world_of_ponies_horse_club_show", methods={"GET"})
     */
    public function show(HorseClub $horseClub): Response
    {
        return $this->render('world_of_ponies/horse_club/show.html.twig', [
            'horse_club' => $horseClub,
        ]);
    }

    /**
     * @Route("/{$horseClubId}/edit", name="world_of_ponies_horse_club_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HorseClub $horseClub): Response
    {
        $form = $this->createForm(HorseClubType::class, $horseClub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

            return $this->redirectToRoute('world_of_ponies_horse_club_index');
        }

        return $this->render('world_of_ponies/horse_club/edit.html.twig', [
            'horse_club' => $horseClub,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{$horseClubId}", name="world_of_ponies_horse_club_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HorseClub $horseClub): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horseClub->getHorseClubId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->remove($horseClub);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_horse_club_index');
    }

    /**
     * @Route("/", name="world_of_ponies_horse_club_delete_selected", methods={"DELETE"})
     */
    public function deleteSelected(Request $request): Response
    {
        //return $this->json($request->request->get('_token'));
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            //if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $player = $this->getDoctrine()->getRepository(HorseClub::class)->find($id);
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
