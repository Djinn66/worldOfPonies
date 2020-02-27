<?php

namespace App\Controller\Mysql;

use App\Entity\Mysql\ColumnsPriv;
use App\Form\Mysql\ColumnsPrivType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mysql/columns_priv")
 */
class ColumnsPrivController extends AbstractController
{
    /**
     * @Route("/", name="mysql_columns_priv_index", methods={"GET"})
     */
    public function index(): Response
    {
        $columnsPrivs = $this->getDoctrine()
            ->getRepository(ColumnsPriv::class)
            ->findAll();

        return $this->render('mysql/columns_priv/index.html.twig', [
            'columns_privs' => $columnsPrivs,
        ]);
    }

    /**
     * @Route("/new", name="mysql_columns_priv_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $columnsPriv = new ColumnsPriv();
        $form = $this->createForm(ColumnsPrivType::class, $columnsPriv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($columnsPriv);
            $entityManager->flush();

            return $this->redirectToRoute('mysql_columns_priv_index');
        }

        return $this->render('mysql/columns_priv/new.html.twig', [
            'columns_priv' => $columnsPriv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{host}", name="mysql_columns_priv_show", methods={"GET"})
     */
    public function show(ColumnsPriv $columnsPriv): Response
    {
        return $this->render('mysql/columns_priv/show.html.twig', [
            'columns_priv' => $columnsPriv,
        ]);
    }

    /**
     * @Route("/{host}/edit", name="mysql_columns_priv_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ColumnsPriv $columnsPriv): Response
    {
        $form = $this->createForm(ColumnsPrivType::class, $columnsPriv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mysql_columns_priv_index');
        }

        return $this->render('mysql/columns_priv/edit.html.twig', [
            'columns_priv' => $columnsPriv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{host}", name="mysql_columns_priv_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ColumnsPriv $columnsPriv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$columnsPriv->getHost(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($columnsPriv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mysql_columns_priv_index');
    }
}
