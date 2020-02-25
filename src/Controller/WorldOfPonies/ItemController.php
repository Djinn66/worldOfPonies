<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Item;
use App\Form\WorldOfPonies\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/worldofponies/item")
 */
class ItemController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_item_index", methods={"GET"})
     */
    public function index(): Response
    {
        $items = $this->getDoctrine()
            ->getRepository(Item::class)
            ->findAll();

        return $this->render('world_of_ponies/item/index.html.twig', [
            'items' => $items,
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
            $entityManager = $this->getDoctrine()->getManager();
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
     * @Route("/{itemId}/edit", name="world_of_ponies_item_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Item $item): Response
    {
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($item);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_item_index');
    }
}
