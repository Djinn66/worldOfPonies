<?php

namespace App\Controller\Mysql;

use App\Entity\Mysql\User;
use App\Form\Mysql\UserType;
use App\Repository\Mysql\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mysql/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $host = $request->query->get('host');
        $user = $request->query->get('user');
        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');

        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
                $orderBy = [$sortBy=> $order];


        if($user !="")
                $criteria += ['user' => $user];
        if($host !="")
                $criteria += ['host' => $host];



            if($sortBy!="" || $user!= "" ||$host!= "")
            {
                return $this->render('mysql/user/index.html.twig', [
                    'user' => $user,
                    'host' => $host,
                    'order' => $order,
                    'sortBy' => $sortBy,
                    'users' => $userRepository->findBy($criteria,$orderBy),
                ]);
            }/* else if ($host != "" || $user != "")
                {
                    return $this->render('mysql/user/index.html.twig', [
                        'users' => $userRepository
                            ->findField($user,$host),

                    ]);
                } */else
                {
                return  $this->render('mysql/user/index.html.twig', [
                    'users' =>$userRepository->findAll(),
                    'user' => $user,
                    'host' => $host,
                    'order' => 'DESC',
                    'sortBy' => $sortBy,
                ]);
            }


    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }
        return $this->render('mysql/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show", name="user_show", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $user = $repository->find(array('host'=>$request->query->get('host'),'user'=>$request->query->get('user')));
        return $this->render('mysql/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $user = $repository->find(array('host'=>$request->query->get('host'),'user'=>$request->query->get('user')));
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('mysql/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $user = $repository->find(array('host'=>$request->query->get('host'),'user'=>$request->query->get('user')));
        if ($this->isCsrfTokenValid('delete'.$user->getHost(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
