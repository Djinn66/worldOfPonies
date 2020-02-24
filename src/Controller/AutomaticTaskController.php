<?php

namespace App\Controller;

use App\Entity\AutomaticTask;
use App\Form\AutomaticTaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/automatic-task")
 */
class AutomaticTaskController extends AbstractController
{
    /**
     * @Route("/", name="automatic_task_index", methods={"GET"})
     */
    public function index(): Response
    {
        $automaticTasks = $this->getDoctrine()
            ->getRepository(AutomaticTask::class)
            ->findAll();

        return $this->render('automatic_task/index.html.twig', [
            'automatic_tasks' => $automaticTasks,
        ]);
    }

    /**
     * @Route("/new", name="automatic_task_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $automaticTask = new AutomaticTask();
        $form = $this->createForm(AutomaticTaskType::class, $automaticTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($automaticTask);
            $entityManager->flush();

            return $this->redirectToRoute('automatic_task_index');
        }

        return $this->render('automatic_task/new.html.twig', [
            'automatic_task' => $automaticTask,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{taskId}", name="automatic_task_show", methods={"GET"})
     */
    public function show(AutomaticTask $automaticTask): Response
    {
        return $this->render('automatic_task/show.html.twig', [
            'automatic_task' => $automaticTask,
        ]);
    }

    /**
     * @Route("/{taskId}/edit", name="automatic_task_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AutomaticTask $automaticTask): Response
    {
        $form = $this->createForm(AutomaticTaskType::class, $automaticTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('automatic_task_index');
        }

        return $this->render('automatic_task/edit.html.twig', [
            'automatic_task' => $automaticTask,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{taskId}", name="automatic_task_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AutomaticTask $automaticTask): Response
    {
        if ($this->isCsrfTokenValid('delete'.$automaticTask->getTaskId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($automaticTask);
            $entityManager->flush();
        }

        return $this->redirectToRoute('automatic_task_index');
    }
}
