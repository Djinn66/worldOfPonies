<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Transaction;
use App\Form\WorldOfPonies\TransactionType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/worldofponies/transaction")
 * @Security("is_granted('ROLE_SUPERUSER') or is_granted('ROLE_PROGRAMMER')")
 */
class TransactionController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_transaction_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $transactionLabel = $request->query->get('transactionLabel');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($transactionLabel !="")
            $criteria += ['transactionLabel' => $transactionLabel];

        $transactions =  $this->getDoctrine()
            ->getRepository(Transaction::class, $this->getUser()->getRoles()[0])
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $transactions,
            $request->query->getInt('page',1),
            6
        );

        return $this->render('world_of_ponies/transaction/index.html.twig', [
            'transactionLabel' => $transactionLabel,
            'order' => $order,
            'sortBy' => $sortBy,
            'transactions' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="world_of_ponies_transaction_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->persist($transaction);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_transaction_index');
        }

        return $this->render('world_of_ponies/transaction/new.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{transactionId}", name="world_of_ponies_transaction_show", methods={"GET"})
     */
    public function show(Transaction $transaction): Response
    {
        return $this->render('world_of_ponies/transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * @Route("/edit/{transactionId}", name="world_of_ponies_transaction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Transaction $transaction): Response
    {
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('world_of_ponies_transaction_index');
        }

        return $this->render('world_of_ponies/transaction/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{transactionId}", name="world_of_ponies_transaction_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Transaction $transaction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getTransactionId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->remove($transaction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_transaction_index');
    }

    /**
     * @Route("/", name="world_of_ponies_transaction_delete_selected", methods={"DELETE"})
     */
    public function deleteSelected(Request $request): Response
    {
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            $transaction = $this->getDoctrine()
                ->getRepository(Transaction::class, $this->getUser()->getRoles()[0])
                ->find($id);

            if(isset($transaction)){
                $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
                $entityManager->remove($transaction);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        return $this->json( "deleted");
    }
}
