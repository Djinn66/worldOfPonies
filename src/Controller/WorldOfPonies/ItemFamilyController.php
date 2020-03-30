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


/**
 * @Route("/worldofponies/item_family")
 * @Security("is_granted('ROLE_SUPERUSER') or is_granted('ROLE_PROGRAMMER')")
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
            ->getManager($this->getUser()->getRoles()[0])
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
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
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
     * @Route("/show", name="world_of_ponies_item_family_show", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(ItemFamily::class);
        $itemFamily = $repository->find(
            array(
                'itemFamilyId'=>$request->query->get('itemFamilyId')
            ));

        return $this->render('world_of_ponies/item_family/show.html.twig', [
            'item_family' => $itemFamily,
        ]);
    }

    /**
     * @Route("/edit", name="world_of_ponies_item_family_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(ItemFamily::class);
        $itemFamily = $repository->find(
            array(
                'itemFamilyId'=>$request->query->get('itemFamilyId')
            ));

        $form = $this->createForm(ItemFamilyType::class, $itemFamily);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('world_of_ponies_item_family_index');
        }

        return $this->render('world_of_ponies/item_family/edit.html.twig', [
            'item_family' => $itemFamily,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete", name="world_of_ponies_item_family_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(ItemFamily::class);
        $itemFamily = $repository->find(
            array(
                'itemFamilyId'=>$request->query->get('itemFamilyId')
            ));

        if ($this->isCsrfTokenValid('delete'.$itemFamily->getItemFamilyId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
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
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            $itemFamily = $this->getDoctrine()
                ->getManager($this->getUser()->getRoles()[0])
                ->getRepository(ItemFamily::class)
                ->find($id);

            if(isset($itemFamily)){
                $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
                $entityManager->remove($itemFamily);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        return $this->json( "deleted");
    }
}
