<?php

namespace App\Controller\Mysql;

use App\Entity\Mysql\Db;
use App\Form\Mysql\DbType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mysql/db")
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

        $dbs =  $this->getDoctrine()
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
            $entityManager = $this->getDoctrine()->getManager();
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
     * @Route("/{host}", name="mysql_db_show", methods={"GET"})
     */
    public function show(Db $db): Response
    {
        return $this->render('mysql/db/show.html.twig', [
            'db' => $db,
        ]);
    }

    /**
     * @Route("/{host}/edit", name="mysql_db_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Db $db): Response
    {
        $form = $this->createForm(DbType::class, $db);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mysql_db_index');
        }

        return $this->render('mysql/db/edit.html.twig', [
            'db' => $db,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{host}", name="mysql_db_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Db $db): Response
    {
        if ($this->isCsrfTokenValid('delete'.$db->getHost(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($db);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mysql_db_index');
    }
}
