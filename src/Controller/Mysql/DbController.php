<?php

namespace App\Controller\Mysql;

use App\Entity\Mysql\Db;
use App\Form\Mysql\DbType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/mysql/db")
 * @IsGranted("ROLE_USERADMIN")
 */
class DbController extends AbstractController
{
    /**
     * @Route("/", name="mysql_db_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $host = $request->query->get('host');
        $db = $request->query->get('db');
        $user = $request->query->get('user');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($host !="")
            $criteria += ['host' => $host];
        if($db !="")
            $criteria += ['db' => $db];
        if($user !="")
            $criteria += ['user' => $user];

        if($this->getUser()->getUsername()!= null){
            $dbs =  $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
                ->getRepository(Db::class)
                ->findBy($criteria,$orderBy);
            $pagination = $paginator->paginate(
                $dbs,
                $request->query->getInt('page',1),
                6
            );

            return $this->render('mysql/db/index.html.twig', [
                'host' => $host,
                'db' => $db,
                'user' => $user,
                'order' => $order,
                'sortBy' => $sortBy,
                'dbs' => $pagination,
            ]);

        }else return $this->redirectToRoute('app_login');

    }

    /**
     * @Route("/new", name="mysql_db_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $db = new Db();
        $form = $this->createForm(DbType::class, $db);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->persist($db);
            $entityManager->flush();

            return $this->redirectToRoute('mysql_db_index');
        }

        return $this->render('mysql/db/new.html.twig', [
            'db' => $db,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show", name="mysql_db_show", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Db::class);
        $db = $repository->find(
            array(
                'host'=>$request->query->get('host'),
                'user'=>$request->query->get('user'),
                'db'=>$request->query->get('db'),
            ));
        return $this->render('mysql/db/show.html.twig', [
            'db' => $db,
        ]);
    }

    /**
     * @Route("/edit", name="mysql_db_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Db::class);
        $db = $repository->find(
            array(
                'host'=>$request->query->get('host'),
                'user'=>$request->query->get('user'),
                'db'=>$request->query->get('db'),
            ));
        $form = $this->createForm(DbType::class, $db);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('mysql_db_index');
        }

        return $this->render('mysql/db/edit.html.twig', [
            'db' => $db,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete", name="mysql_db_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Db::class);
        $db = $repository->find(
            array(
                'host'=>$request->query->get('host'),
                'user'=>$request->query->get('user'),
                'db'=>$request->query->get('db'),
            ));
        if ($this->isCsrfTokenValid('delete'.$db->getHost(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->remove($db);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mysql_db_index');
    }
}
