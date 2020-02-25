<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Advertisement;
use App\Form\WorldOfPonies\AdvertisementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/worldofponies/advertisement")
 */
class AdvertisementController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_advertisement_index", methods={"GET"})
     */
    public function index(): Response
    {
        $advertisements = $this->getDoctrine()
            ->getRepository(Advertisement::class)
            ->findAll();

        return $this->render('world_of_ponies/advertisement/index.html.twig', [
            'advertisements' => $advertisements,
        ]);
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
            $entityManager = $this->getDoctrine()->getManager();
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
     * @Route("/{advertisementId}", name="world_of_ponies_advertisement_show", methods={"GET"})
     */
    public function show(Advertisement $advertisement): Response
    {
        return $this->render('world_of_ponies/advertisement/show.html.twig', [
            'advertisement' => $advertisement,
        ]);
    }

    /**
     * @Route("/{advertisementId}/edit", name="world_of_ponies_advertisement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Advertisement $advertisement): Response
    {
        $form = $this->createForm(AdvertisementType::class, $advertisement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('world_of_ponies_advertisement_index');
        }

        return $this->render('world_of_ponies/advertisement/edit.html.twig', [
            'advertisement' => $advertisement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{advertisementId}", name="world_of_ponies_advertisement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Advertisement $advertisement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advertisement->getAdvertisementId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($advertisement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_advertisement_index');
    }
}
