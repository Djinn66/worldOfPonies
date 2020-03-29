<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\EquestrianCenter;
use App\Form\WorldOfPonies\EquestrianCenterType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/worldofponies/equestrian_center")
 * @IsGranted({"ROLE_PROGRAMMER","ROLE_SUPERUSER"})
 */
class EquestrianCenterController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_equestrian_center_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $equestrianCenterId = $request->query->get('equestrianCenterId');
        $equestrianCenterCapacity = $request->query->get('equestrianCenterCapacity');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($equestrianCenterId !="")
            $criteria += ['equestrianCenterId' => $equestrianCenterId];
        if($equestrianCenterCapacity !="")
            $criteria += ['equestrianCenterCapacity' => $equestrianCenterCapacity];

        $equestrian_centers =  $this->getDoctrine()
            ->getRepository(EquestrianCenter::class)
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $equestrian_centers,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('world_of_ponies/equestrian_center/index.html.twig', [
            'equestrianCenterId' => $equestrianCenterId,
            'equestrianCenterCapacity' => $equestrianCenterCapacity,
            'order' => $order,
            'sortBy' => $sortBy,
            'equestrian_centers' => $pagination,
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

    /**
     * @Route("/", name="world_of_ponies_equestrian_center_delete_selected", methods={"DELETE"})
     */
    public function deleteSelected(Request $request): Response
    {
        //return $this->json($request->request->get('_token'));
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            //if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $player = $this->getDoctrine()->getRepository(EquestrianCenter::class)->find($id);
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
