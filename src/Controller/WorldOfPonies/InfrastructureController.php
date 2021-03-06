<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Infrastructure;
use App\Form\WorldOfPonies\InfrastructureType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/worldofponies/infrastructure")
 * @Security("is_granted('ROLE_SUPERUSER') or is_granted('ROLE_PROGRAMMER')")
 */
class InfrastructureController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_infrastructure_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $infrastructureType = $request->query->get('infrastructureType');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($infrastructureType !="")
            $criteria += ['infrastructureType' => $infrastructureType];

        $infrastructures =  $this->getDoctrine()
            ->getRepository(Infrastructure::class, $this->getUser()->getRoles()[0])
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $infrastructures,
            $request->query->getInt('page',1),
            30
        );

        return $this->render('world_of_ponies/infrastructure/index.html.twig', [
            'infrastructureType' => $infrastructureType,
            'order' => $order,
            'sortBy' => $sortBy,
            'infrastructures' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="world_of_ponies_infrastructure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $infrastructure = new Infrastructure();
        $form = $this->createForm(InfrastructureType::class, $infrastructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->persist($infrastructure);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_infrastructure_index');
        }

        return $this->render('world_of_ponies/infrastructure/new.html.twig', [
            'infrastructure' => $infrastructure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{infrastructureId}", name="world_of_ponies_infrastructure_show", methods={"GET"})
     */
    public function show(Infrastructure $infrastructure): Response
    {
        return $this->render('world_of_ponies/infrastructure/show.html.twig', [
            'infrastructure' => $infrastructure,
        ]);
    }

    /**
     * @Route("/edit/{infrastructureId}", name="world_of_ponies_infrastructure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Infrastructure $infrastructure): Response
    {
        $form = $this->createForm(InfrastructureType::class, $infrastructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('world_of_ponies_infrastructure_index');
        }

        return $this->render('world_of_ponies/infrastructure/edit.html.twig', [
            'infrastructure' => $infrastructure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{infrastructureId}", name="world_of_ponies_infrastructure_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Infrastructure $infrastructure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infrastructure->getInfrastructureId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->remove($infrastructure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_infrastructure_index');
    }

    /**
     * @Route("/", name="world_of_ponies_infrastructure_delete_selected", methods={"DELETE"})
     */
    public function deleteSelected(Request $request): Response
    {
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            $infrastructure = $this->getDoctrine()
                ->getRepository(Infrastructure::class, $this->getUser()->getRoles()[0])
                ->find($id);

            if(isset($infrastructure)){
                $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
                $entityManager->remove($infrastructure);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        return $this->json( "deleted");
    }
}
