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


/**
 * @Route("/worldofponies/horse")
 * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_SPECIALIST')")
 */
class HorseController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_horse_index", methods={"GET"})
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_SPECIALIST')")
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
            ->getManager($this->getUser()->getRoles()[0])
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
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER')")
     */
    public function new(Request $request): Response
    {
        $horse = new Horse();
        $form = $this->createForm(HorseType::class, $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
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
     * @Route("/show", name="world_of_ponies_horse_show", methods={"GET"})
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_SPECIALIST')")
     */
    public function show(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Horse::class);
        $horse = $repository->find(
            array(
                'horseId'=>$request->query->get('horseId')
            ));

        return $this->render('world_of_ponies/horse/show.html.twig', [
            'horse' => $horse,
        ]);
    }

    /**
     * @Route("/edit", name="world_of_ponies_horse_edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_PROGRAMMER') or is_granted('ROLE_SUPERUSER') or is_granted('ROLE_SPECIALIST')")
     */
    public function edit(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Horse::class);
        $horse = $repository->find(
            array(
                'horseId'=>$request->query->get('horseId')
            ));

        $form = $this->createForm(HorseType::class, $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('world_of_ponies_horse_index');
        }

        return $this->render('world_of_ponies/horse/edit.html.twig', [
            'horse' => $horse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete", name="world_of_ponies_horse_delete", methods={"DELETE"})
     * @Security("is_granted('ROLE_SUPERUSER') or is_granted('ROLE_PROGRAMMER')")
     */
    public function delete(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Horse::class);
        $horse = $repository->find(
            array(
                'horseId'=>$request->query->get('horseId')
            ));

        if ($this->isCsrfTokenValid('delete'.$horse->getHorseId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->remove($horse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_horse_index');
    }

    /**
     * @Route("/", name="world_of_ponies_horse_delete_selected", methods={"DELETE"})
     * @Security("is_granted('ROLE_SUPERUSER') or is_granted('ROLE_PROGRAMMER')")
     */
    public function deleteSelected(Request $request): Response
    {
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            $horse = $this->getDoctrine()
                ->getManager($this->getUser()->getRoles()[0])
                ->getRepository(Horse::class)
                ->find($id);

            if(isset($horse)){
                $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
                $entityManager->remove($horse);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        return $this->json( "deleted");
    }
}
