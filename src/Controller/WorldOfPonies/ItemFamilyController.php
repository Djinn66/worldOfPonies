<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\ItemFamily;
use App\Form\WorldOfPonies\ItemFamilyType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/worldofponies/item_family")
 * @IsGranted({"ROLE_PROGRAMMER","ROLE_SUPERUSER"})
 */
class ItemFamilyController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_item_family_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $itemFamilyLabel = $request->query->get('itemFamilyLabel');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($itemFamilyLabel !="")
            $criteria += ['itemFamilyLabel' => $itemFamilyLabel];

        $item_families =  $this->getDoctrine()
            ->getRepository(ItemFamily::class)
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $item_families,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('world_of_ponies/item_family/index.html.twig', [
            'itemFamilyLabel' => $itemFamilyLabel,
            'order' => $order,
            'sortBy' => $sortBy,
            'item_families' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="world_of_ponies_item_family_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $itemFamily = new ItemFamily();
        $form = $this->createForm(ItemFamilyType::class, $itemFamily);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->persist($itemFamily);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_item_family_index');
        }

        return $this->render('world_of_ponies/item_family/new.html.twig', [
            'item_family' => $itemFamily,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{itemFamilyId}", name="world_of_ponies_item_family_show", methods={"GET"})
     */
    public function show(ItemFamily $itemFamily): Response
    {
        return $this->render('world_of_ponies/item_family/show.html.twig', [
            'item_family' => $itemFamily,
        ]);
    }

    /**
     * @Route("/{itemFamilyId}/edit", name="world_of_ponies_item_family_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ItemFamily $itemFamily): Response
    {
        $form = $this->createForm(ItemFamilyType::class, $itemFamily);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

            return $this->redirectToRoute('world_of_ponies_item_family_index');
        }

        return $this->render('world_of_ponies/item_family/edit.html.twig', [
            'item_family' => $itemFamily,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{itemFamilyId}", name="world_of_ponies_item_family_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ItemFamily $itemFamily): Response
    {
        if ($this->isCsrfTokenValid('delete'.$itemFamily->getItemFamilyId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->remove($itemFamily);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_item_family_index');
    }

    /**
     * @Route("/", name="world_of_ponies_item_family_delete_selected", methods={"DELETE"})
     */
    public function deleteSelected(Request $request): Response
    {
        //return $this->json($request->request->get('_token'));
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            //if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $player = $this->getDoctrine()->getRepository(ItemFamily::class)->find($id);
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
