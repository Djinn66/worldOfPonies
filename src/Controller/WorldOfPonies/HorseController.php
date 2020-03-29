<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Horse;
use App\Form\WorldOfPonies\HorseType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/worldofponies/horse")
 * @IsGranted({"ROLE_PROGRAMMER","ROLE_SUPERUSER","ROLE_SPECIALIST"})
 */
class HorseController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_horse_index", methods={"GET"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_SUPERUSER","ROLE_SPECIALIST"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $horseName = $request->query->get('horseName');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($horseName !="")
            $criteria += ['horseName' => $horseName];

        $horses =  $this->getDoctrine()
            ->getRepository(Horse::class)
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $horses,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('world_of_ponies/horse/index.html.twig', [
            'horseName' => $horseName,
            'order' => $order,
            'sortBy' => $sortBy,
            'horses' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="world_of_ponies_horse_new", methods={"GET","POST"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_SUPERUSER"})
     */
    public function new(Request $request): Response
    {
        $horse = new Horse();
        $form = $this->createForm(HorseType::class, $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->persist($horse);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_horse_index');
        }

        return $this->render('world_of_ponies/horse/new.html.twig', [
            'horse' => $horse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{horseId}", name="world_of_ponies_horse_show", methods={"GET"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_SUPERUSER","ROLE_SPECIALIST"})
     */
    public function show(Horse $horse): Response
    {
        return $this->render('world_of_ponies/horse/show.html.twig', [
            'horse' => $horse,
        ]);
    }

    /**
     * @Route("/{horseId}/edit", name="world_of_ponies_horse_edit", methods={"GET","POST"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_SUPERUSER","ROLE_SPECIALIST"})
     */
    public function edit(Request $request, Horse $horse): Response
    {
        $form = $this->createForm(HorseType::class, $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

            return $this->redirectToRoute('world_of_ponies_horse_index');
        }

        return $this->render('world_of_ponies/horse/edit.html.twig', [
            'horse' => $horse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{horseId}", name="world_of_ponies_horse_delete", methods={"DELETE"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_SUPERUSER"})
     */
    public function delete(Request $request, Horse $horse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horse->getHorseId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->remove($horse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_horse_index');
    }

    /**
     * @Route("/", name="world_of_ponies_horse_delete_selected", methods={"DELETE"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_SUPERUSER"})
     */
    public function deleteSelected(Request $request): Response
    {
        //return $this->json($request->request->get('_token'));
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            //if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $player = $this->getDoctrine()->getRepository(Horse::class)->find($id);
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
