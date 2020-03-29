<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Newspaper;
use App\Form\WorldOfPonies\NewspaperType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/worldofponies/newspaper")
 * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_NEWSREADER')")
 */
class NewspaperController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_newspaper_index", methods={"GET"})
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_EDITOR') or is_granted('ROLE_NEWSREADER')")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $newspaperId = $request->query->get('newspaperId');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($newspaperId !="")
            $criteria += ['newspaperId' => $newspaperId];

        $newspapers =  $this->getDoctrine()
            ->getRepository(Newspaper::class)
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $newspapers,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('world_of_ponies/newspaper/index.html.twig', [
            'newspaperId' => $newspaperId,
            'order' => $order,
            'sortBy' => $sortBy,
            'newspapers' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="world_of_ponies_newspaper_new", methods={"GET","POST"})
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_EDITOR')")
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
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_EDITOR') or is_granted('ROLE_NEWSREADER')")
     */
    public function show(Newspaper $newspaper): Response
    {
        return $this->render('world_of_ponies/newspaper/show.html.twig', [
            'newspaper' => $newspaper,
        ]);
    }

    /**
     * @Route("/{newspaperId}/edit", name="world_of_ponies_newspaper_edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_EDITOR')")
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
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_EDITOR')")
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

    /**
     * @Route("/", name="world_of_ponies_newspaper_delete_selected", methods={"DELETE"})
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_EDITOR')")
     */
    public function deleteSelected(Request $request): Response
    {
        //return $this->json($request->request->get('_token'));
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            //if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $player = $this->getDoctrine()->getRepository(Newspaper::class)->find($id);
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
