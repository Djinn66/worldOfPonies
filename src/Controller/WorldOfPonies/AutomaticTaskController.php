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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/worldofponies/automatic_task")
 * @IsGranted({"ROLE_PROGRAMMER","ROLE_SUPERUSER"})
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
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
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
     * @Route("/{taskId}", name="world_of_ponies_automatic_task_show", methods={"GET"})
     */
    public function show(AutomaticTask $automaticTask): Response
    {
        return $this->render('world_of_ponies/automatic_task/show.html.twig', [
            'automatic_task' => $automaticTask,
        ]);
    }

    /**
     * @Route("/{taskId}/edit", name="world_of_ponies_automatic_task_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AutomaticTask $automaticTask): Response
    {
        $form = $this->createForm(AutomaticTaskType::class, $automaticTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

            return $this->redirectToRoute('world_of_ponies_automatic_task_index');
        }

        return $this->render('world_of_ponies/automatic_task/edit.html.twig', [
            'automatic_task' => $automaticTask,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{taskId}", name="world_of_ponies_automatic_task_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AutomaticTask $automaticTask): Response
    {
        if ($this->isCsrfTokenValid('delete'.$automaticTask->getTaskId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
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
        //return $this->json($request->request->get('_token'));
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            //if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $player = $this->getDoctrine()->getRepository(AutomaticTask::class)->find($id);
            if(isset($player)){
                $entityManager = $this->getDoctrine()->getManager('worldofponies');
                $entityManager->remove($player);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        //return $this->redirectToRoute('world_of_ponies_player_index');
        return $this->json( "deleted");
    }
}
