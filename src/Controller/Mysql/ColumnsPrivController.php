<?php

namespace App\Controller\Mysql;

use App\Entity\Mysql\ColumnsPriv;
use App\Form\Mysql\ColumnsPrivType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/mysql/columns_priv")
 * @IsGranted("ROLE_USERADMIN")
 */
class ColumnsPrivController extends AbstractController
{
    /**
     * @Route("/", name="mysql_columns_priv_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $host = $request->query->get('host');
        $db = $request->query->get('db');
        $user = $request->query->get('user');
        $tableName = $request->query->get('tableName');

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
        if($tableName !="")
            $criteria += ['tableName' => $tableName];

        if($this->getUser()->getUsername()!= null){
            $columnsPrivs =  $this->getDoctrine()
                ->getRepository(ColumnsPriv::class, $this->getUser()->getRoles()[0])
                ->findBy($criteria,$orderBy);
            $pagination = $paginator->paginate(
                $columnsPrivs,
                $request->query->getInt('page',1),
                6
            );

            return $this->render('mysql/columns_priv/index.html.twig', [
                'host' => $host,
                'db' => $db,
                'user' => $user,
                'tableName' => $tableName,
                'order' => $order,
                'sortBy' => $sortBy,
                'columnsPrivs' => $pagination,

            ]);

        }else return $this->redirectToRoute('app_login');

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
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
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
     * @Route("/show", name="mysql_columns_priv_show", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        $repository = $this->getDoctrine()
            ->getRepository(ColumnsPriv::class, $this->getUser()->getRoles()[0]);
        $columnsPriv = $repository->find(
            array(
                'host'=>$request->query->get('host'),
                'user'=>$request->query->get('user'),
                'db'=>$request->query->get('db'),
                'tableName'=>$request->query->get('tableName'),
                'columnName'=>$request->query->get('columnName'),
            ));
        return $this->render('mysql/columns_priv/show.html.twig', [
            'columns_priv' => $columnsPriv,
        ]);
    }

    /**
     * @Route("/edit", name="mysql_columns_priv_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $repository = $this->getDoctrine()
            ->getRepository(ColumnsPriv::class,$this->getUser()->getRoles()[0]);
        $columnsPriv = $repository->find(
            array(
                'host'=>$request->query->get('host'),
                'user'=>$request->query->get('user'),
                'db'=>$request->query->get('db'),
                'tableName'=>$request->query->get('tableName'),
                'columnName'=>$request->query->get('columnName'),
            ));

        $form = $this->createForm(ColumnsPrivType::class, $columnsPriv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('mysql_columns_priv_index');
        }

        return $this->render('mysql/columns_priv/edit.html.twig', [
            'columns_priv' => $columnsPriv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete", name="mysql_columns_priv_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $repository = $this->getDoctrine()
            ->getRepository(ColumnsPriv::class,$this->getUser()->getRoles()[0]);
        $columnsPriv = $repository->find(
            array(
                'host'=>$request->query->get('host'),
                'user'=>$request->query->get('user'),
                'db'=>$request->query->get('db'),
                'tableName'=>$request->query->get('tableName'),
                'columnName'=>$request->query->get('columnName'),
            ));
        if ($this->isCsrfTokenValid('delete'.$columnsPriv->getHost(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->remove($columnsPriv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mysql_columns_priv_index');
    }
}
