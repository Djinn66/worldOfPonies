<?php

namespace App\Controller;

use App\Entity\ItemFamily;
use App\Form\ItemFamilyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/item-family")
 */
class ItemFamilyController extends AbstractController
{
    /**
     * @Route("/", name="item_family_index", methods={"GET"})
     */
    public function index(): Response
    {
        $itemFamilies = $this->getDoctrine()
            ->getRepository(ItemFamily::class)
            ->findAll();

        return $this->render('item_family/index.html.twig', [
            'item_families' => $itemFamilies,
        ]);
    }

    /**
     * @Route("/new", name="item_family_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $itemFamily = new ItemFamily();
        $form = $this->createForm(ItemFamilyType::class, $itemFamily);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($itemFamily);
            $entityManager->flush();

            return $this->redirectToRoute('item_family_index');
        }

        return $this->render('item_family/new.html.twig', [
            'item_family' => $itemFamily,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{itemFamilyId}", name="item_family_show", methods={"GET"})
     */
    public function show(ItemFamily $itemFamily): Response
    {
        return $this->render('item_family/show.html.twig', [
            'item_family' => $itemFamily,
        ]);
    }

    /**
     * @Route("/{itemFamilyId}/edit", name="item_family_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ItemFamily $itemFamily): Response
    {
        $form = $this->createForm(ItemFamilyType::class, $itemFamily);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('item_family_index');
        }

        return $this->render('item_family/edit.html.twig', [
            'item_family' => $itemFamily,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{itemFamilyId}", name="item_family_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ItemFamily $itemFamily): Response
    {
        if ($this->isCsrfTokenValid('delete'.$itemFamily->getItemFamilyId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($itemFamily);
            $entityManager->flush();
        }

        return $this->redirectToRoute('item_family_index');
    }
}
