<?php

namespace App\Controller\Mysql;

use App\Entity\Mysql\TablesPriv;
use App\Form\Mysql\TablesPrivType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/mysql/tables_priv")
 * @IsGranted("ROLE_USERADMIN")
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

        if($this->getUser()->getUsername()!= null){
            $tables_privs =  $this->getDoctrine()
                ->getRepository(TablesPriv::class, $this->getUser()->getRoles()[0])
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
        }else return $this->redirectToRoute('app_login');

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
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
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
     * @Route("/show", name="mysql_tables_priv_show", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])
            ->getRepository(TablesPriv::class);
        $tablesPriv = $repository->find(
            array(
                'host'=>$request->query->get('host'),
                'user'=>$request->query->get('user'),
                'db'=>$request->query->get('db'),
                'tableName'=>$request->query->get('tableName'),
            ));
        return $this->render('mysql/tables_priv/show.html.twig', [
            'tables_priv' => $tablesPriv,
        ]);
    }

    /**
     * @Route("/edit", name="mysql_tables_priv_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $repository = $this->getDoctrine()
            ->getRepository(TablesPriv::class, $this->getUser()->getRoles()[0]);
        $tablesPriv = $repository->find(
            array(
                'host'=>$request->query->get('host'),
                'user'=>$request->query->get('user'),
                'db'=>$request->query->get('db'),
                'tableName'=>$request->query->get('tableName'),
            ));
        $form = $this->createForm(TablesPrivType::class, $tablesPriv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('mysql_tables_priv_index');
        }

        return $this->render('mysql/tables_priv/edit.html.twig', [
            'tables_priv' => $tablesPriv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete", name="mysql_tables_priv_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $repository = $this->getDoctrine()
            ->getRepository(TablesPriv::class, $this->getUser()->getRoles()[0]);
        $tablesPriv = $repository->find(
            array(
                'host'=>$request->query->get('host'),
                'db'=>$request->query->get('db'),
                'user'=>$request->query->get('user')
            ));
        if ($this->isCsrfTokenValid('delete'.$tablesPriv->getHost(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->remove($tablesPriv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mysql_tables_priv_index');
    }

}
