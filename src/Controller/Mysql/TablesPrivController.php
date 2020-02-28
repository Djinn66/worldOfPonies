<?php

namespace App\Controller\Mysql;

use App\Entity\Mysql\TablesPriv;
use App\Form\Mysql\TablesPrivType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mysql/tables_priv")
 */
class TablesPrivController extends AbstractController
{
    /**
     * @Route("/", name="mysql_tables_priv_index", methods={"GET"})
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

        $tables_privs =  $this->getDoctrine()
            ->getRepository(TablesPriv::class)
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $tables_privs,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('mysql/tables_priv/index.html.twig', [
            'host' => $host,
            'db' => $db,
            'user' => $user,
            'order' => $order,
            'sortBy' => $sortBy,
            'tables_privs' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="mysql_tables_priv_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tablesPriv = new TablesPriv();
        $form = $this->createForm(TablesPrivType::class, $tablesPriv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tablesPriv);
            $entityManager->flush();

            return $this->redirectToRoute('mysql_tables_priv_index');
        }

        return $this->render('mysql/tables_priv/new.html.twig', [
            'tables_priv' => $tablesPriv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{host}", name="mysql_tables_priv_show", methods={"GET"})
     */
    public function show(TablesPriv $tablesPriv): Response
    {
        return $this->render('mysql/tables_priv/show.html.twig', [
            'tables_priv' => $tablesPriv,
        ]);
    }

    /**
     * @Route("/{host}/edit", name="mysql_tables_priv_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TablesPriv $tablesPriv): Response
    {
        $form = $this->createForm(TablesPrivType::class, $tablesPriv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mysql_tables_priv_index');
        }

        return $this->render('mysql/tables_priv/edit.html.twig', [
            'tables_priv' => $tablesPriv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{host}", name="mysql_tables_priv_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TablesPriv $tablesPriv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tablesPriv->getHost(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tablesPriv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mysql_tables_priv_index');
    }
}
