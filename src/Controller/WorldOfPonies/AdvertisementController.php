<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Advertisement;
use App\Form\WorldOfPonies\AdvertisementType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/worldofponies/advertisement")
 * @Security("is_granted('ROLE_SUPERUSER') or is_granted('ROLE_PROGRAMMER')")
 */
class AdvertisementController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_advertisement_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $advertisementId = $request->query->get('advertisementId');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];


        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($advertisementId !="")
            $criteria += ['advertisementId' => $advertisementId];

        if($this->getUser()->getUsername()!= null){
            $advertisements =  $this->getDoctrine()
                ->getManager($this->getUser()->getRoles()[0])
                ->getRepository(Advertisement::class)
                ->findBy($criteria, $orderBy);

            $pagination = $paginator->paginate(
                $advertisements,
                $request->query->getInt('page',1),
                6
            );

            return $this->render('world_of_ponies/advertisement/index.html.twig', [
                'advertisementId' => $advertisementId,
                'order' => $order,
                'sortBy' => $sortBy,
                'advertisements' => $pagination,
            ]);
        }else return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/new", name="world_of_ponies_advertisement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $advertisement = new Advertisement();
        $form = $this->createForm(AdvertisementType::class, $advertisement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->persist($advertisement);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_advertisement_index');
        }

        return $this->render('world_of_ponies/advertisement/new.html.twig', [
            'advertisement' => $advertisement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show", name="world_of_ponies_advertisement_show", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Advertisement::class);
        $advertisement = $repository->find(
            array(
                'advertisementId'=>$request->query->get('advertisementId')
            ));

        return $this->render('world_of_ponies/advertisement/show.html.twig', [
            'advertisement' => $advertisement,
        ]);
    }

    /**
     * @Route("/edit", name="world_of_ponies_advertisement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Advertisement::class);
        $advertisement = $repository->find(
            array(
                'advertisementId'=>$request->query->get('advertisementId')
            ));
        $form = $this->createForm(AdvertisementType::class, $advertisement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('world_of_ponies_advertisement_index');
        }

        return $this->render('world_of_ponies/advertisement/edit.html.twig', [
            'advertisement' => $advertisement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete", name="world_of_ponies_advertisement_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Advertisement::class);
        $advertisement = $repository->find(
            array(
                'advertisementId'=>$request->query->get('advertisementId')
            ));

        if ($this->isCsrfTokenValid('delete'.$advertisement->getAdvertisementId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->remove($advertisement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_advertisement_index');
    }

    /**
     * @Route("/", name="world_of_ponies_advertisement_delete_selected", methods={"DELETE"})
     */
    public function deleteSelected(Request $request): Response
    {
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            $advertisement = $this->getDoctrine()->getRepository(Advertisement::class)->find($id);
            if(isset($advertisement)){
                $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
                $entityManager->remove($advertisement);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        return $this->json( "deleted");
    }
}
