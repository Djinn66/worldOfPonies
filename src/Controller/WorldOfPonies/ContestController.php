<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Contest;
use App\Form\WorldOfPonies\ContestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/worldofponies/contest")
 */
class ContestController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_contest_index", methods={"GET"})
     */
    public function index(): Response
    {
        $contests = $this->getDoctrine()
            ->getRepository(Contest::class)
            ->findAll();

        return $this->render('world_of_ponies/contest/index.html.twig', [
            'contests' => $contests,
        ]);
    }

    /**
     * @Route("/new", name="world_of_ponies_contest_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contest = new Contest();
        $form = $this->createForm(ContestType::class, $contest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->persist($contest);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_contest_index');
        }

        return $this->render('world_of_ponies/contest/new.html.twig', [
            'contest' => $contest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{contestId}", name="world_of_ponies_contest_show", methods={"GET"})
     */
    public function show(Contest $contest): Response
    {
        return $this->render('world_of_ponies/contest/show.html.twig', [
            'contest' => $contest,
        ]);
    }

    /**
     * @Route("/{contestId}/edit", name="world_of_ponies_contest_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contest $contest): Response
    {
        $form = $this->createForm(ContestType::class, $contest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

            return $this->redirectToRoute('world_of_ponies_contest_index');
        }

        return $this->render('world_of_ponies/contest/edit.html.twig', [
            'contest' => $contest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{contestId}", name="world_of_ponies_contest_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contest $contest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contest->getContestId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
            $entityManager->remove($contest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_contest_index');
    }
}
