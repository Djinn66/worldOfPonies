<?php

namespace App\Controller\Mysql;

use App\Entity\Mysql\TablesPriv;
use App\Form\Mysql\TablesPrivType;
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
    public function index(): Response
    {
        $tablesPrivs = $this->getDoctrine()
            ->getRepository(TablesPriv::class)
            ->findAll();

        return $this->render('mysql/tables_priv/index.html.twig', [
            'tables_privs' => $tablesPrivs,
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
