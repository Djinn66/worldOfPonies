<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Item;
use App\Form\WorldOfPonies\ItemType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/worldofponies/item")
 * @Security("is_granted('ROLE_SUPERUSER') or is_granted('ROLE_PROGRAMMER')")
 */
class ItemController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_item_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $itemDescription = $request->query->get('itemDescription');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($itemDescription !="")
            $criteria += ['itemDescription' => $itemDescription];

        $items =  $this->getDoctrine()
            ->getRepository(Item::class, $this->getUser()->getRoles()[0])
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $items,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('world_of_ponies/item/index.html.twig', [
            'itemDescription' => $itemDescription,
            'order' => $order,
            'sortBy' => $sortBy,
            'items' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="world_of_ponies_item_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->persist($item);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_item_index');
        }

        return $this->render('world_of_ponies/item/new.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{itemId}", name="world_of_ponies_item_show", methods={"GET"})
     */
    public function show(Item $item): Response
    {
        return $this->render('world_of_ponies/item/show.html.twig', [
            'item' => $item,
        ]);
    }

    /**
     * @Route("/edit/{itemId}", name="world_of_ponies_item_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Item $item): Response
    {
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('world_of_ponies_item_index');
        }

        return $this->render('world_of_ponies/item/edit.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{itemId}", name="world_of_ponies_item_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Item $item): Response
    {
        if ($this->isCsrfTokenValid('delete'.$item->getItemId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->remove($item);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_item_index');
    }

    /**
     * @Route("/", name="world_of_ponies_item_delete_selected", methods={"DELETE"})
     */
    public function deleteSelected(Request $request): Response
    {
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            $item = $this->getDoctrine()
                ->getRepository(Item::class, $this->getUser()->getRoles()[0])
                ->find($id);

            if(isset($item)){
                $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
                $entityManager->remove($item);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        return $this->json( "deleted");
    }
}
