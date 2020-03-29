<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Contest;
use App\Form\WorldOfPonies\ContestType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/worldofponies/contest")
 * @IsGranted({"ROLE_PROGRAMMER","ROLE_CONTESTADMIN","ROLE_NEWSREADER"})
 */
class ContestController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_contest_index", methods={"GET"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_CONTESTADMIN","ROLE_NEWSREADER"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $contestId = $request->query->get('contestId');
        $price = $request->query->get('price');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($contestId !="")
            $criteria += ['contestId' => $contestId];
        if($price !="")
            $criteria += ['price' => $price];

        $contests =  $this->getDoctrine()
            ->getRepository(Contest::class)
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $contests,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('world_of_ponies/contest/index.html.twig', [
            'contestId' => $contestId,
            'price' => $price,
            'order' => $order,
            'sortBy' => $sortBy,
            'contests' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="world_of_ponies_contest_new", methods={"GET","POST"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_CONTESTADMIN"})
     */
    public function new(Request $request): Response
    {
        $contest = new Contest();
        $form = $this->createForm(ContestType::class, $contest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->persist($contest);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_contest_index');
        }

        return $this->render('world_of_ponies/contest/new.html.twig', [
            'contest' => $contest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{contestId}", name="world_of_ponies_contest_show", methods={"GET"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_CONTESTADMIN","ROLE_NEWSREADER"})
     */
    public function show(Contest $contest): Response
    {
        return $this->render('world_of_ponies/contest/show.html.twig', [
            'contest' => $contest,
        ]);
    }

    /**
     * @Route("/{contestId}/edit", name="world_of_ponies_contest_edit", methods={"GET","POST"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_CONTESTADMIN"})
     */
    public function edit(Request $request, Contest $contest): Response
    {
        $form = $this->createForm(ContestType::class, $contest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

            return $this->redirectToRoute('world_of_ponies_contest_index');
        }

        return $this->render('world_of_ponies/contest/edit.html.twig', [
            'contest' => $contest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{contestId}", name="world_of_ponies_contest_delete", methods={"DELETE"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_CONTESTADMIN"})
     */
    public function delete(Request $request, Contest $contest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contest->getContestId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->remove($contest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_contest_index');
    }

    /**
     * @Route("/", name="world_of_ponies_contest_delete_selected", methods={"DELETE"})
     * @IsGranted({"ROLE_PROGRAMMER","ROLE_CONTESTADMIN"})
     */
    public function deleteSelected(Request $request): Response
    {
        //return $this->json($request->request->get('_token'));
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            //if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $player = $this->getDoctrine()->getRepository(Contest::class)->find($id);
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
