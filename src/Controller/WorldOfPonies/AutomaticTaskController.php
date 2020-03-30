<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\AutomaticTask;
use App\Form\WorldOfPonies\AutomaticTaskType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/worldofponies/automatic_task")
 * @Security("is_granted('ROLE_SUPERUSER') or is_granted('ROLE_PROGRAMMER')")
 */
class AutomaticTaskController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_automatic_task_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $taskId = $request->query->get('taskId');
        $taskToDo = $request->query->get('taskToDo');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($taskId !="")
            $criteria += ['taskId' => $taskId];
        if($taskToDo !="")
            $criteria += ['taskToDo' => $taskToDo];

        $automaticTasks =  $this->getDoctrine()
            ->getManager($this->getUser()->getRoles()[0])
            ->getRepository(AutomaticTask::class)
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $automaticTasks,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('world_of_ponies/automatic_task/index.html.twig', [
            'taskId' => $taskId,
            'taskToDo' => $taskToDo,
            'order' => $order,
            'sortBy' => $sortBy,
            'automatic_tasks' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="world_of_ponies_automatic_task_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $automaticTask = new AutomaticTask();
        $form = $this->createForm(AutomaticTaskType::class, $automaticTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->persist($automaticTask);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_automatic_task_index');
        }

        return $this->render('world_of_ponies/automatic_task/new.html.twig', [
            'automatic_task' => $automaticTask,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show", name="world_of_ponies_automatic_task_show", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(AutomaticTask::class);
        $automaticTask = $repository->find(
            array(
                'taskId'=>$request->query->get('taskId')
            ));

        return $this->render('world_of_ponies/automatic_task/show.html.twig', [
            'automatic_task' => $automaticTask,
        ]);
    }

    /**
     * @Route("/edit", name="world_of_ponies_automatic_task_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $repository = $this->getDoctrine()
            ->getManager($this->getUser()->getRoles()[0])
            ->getRepository(AutomaticTask::class);
        $automaticTask = $repository->find(
            array(
                'taskId'=>$request->query->get('taskId')
            ));

        $form = $this->createForm(AutomaticTaskType::class, $automaticTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('world_of_ponies_automatic_task_index');
        }

        return $this->render('world_of_ponies/automatic_task/edit.html.twig', [
            'automatic_task' => $automaticTask,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete", name="world_of_ponies_automatic_task_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $repository = $this->getDoctrine()
            ->getManager($this->getUser()->getRoles()[0])
            ->getRepository(AutomaticTask::class);
        $automaticTask = $repository->find(
            array(
                'taskId'=>$request->query->get('taskId')
            ));

        if ($this->isCsrfTokenValid('delete'.$automaticTask->getTaskId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->remove($automaticTask);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_automatic_task_index');
    }

    /**
     * @Route("/", name="world_of_ponies_automatic_task_delete_selected", methods={"DELETE"})
     */
    public function deleteSelected(Request $request): Response
    {
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            $automaticTask = $this->getDoctrine()
                ->getManager($this->getUser()->getRoles()[0])
                ->getRepository(AutomaticTask::class)
                ->find($id);

            if(isset($automaticTask)){
                $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
                $entityManager->remove($automaticTask);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        return $this->json( "deleted");
    }
}
