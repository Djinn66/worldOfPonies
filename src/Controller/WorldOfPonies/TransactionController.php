<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Transaction;
use App\Form\WorldOfPonies\TransactionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/worldofponies/transaction")
 */
class TransactionController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_transaction_index", methods={"GET"})
     */
    public function index(): Response
    {
        $transactions = $this->getDoctrine()
            ->getRepository(Transaction::class)
            ->findAll();

        return $this->render('world_of_ponies/transaction/index.html.twig', [
            'transactions' => $transactions,
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
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
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
     * @Route("/{transactionId}/edit", name="world_of_ponies_transaction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Transaction $transaction): Response
    {
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('worldofponies')->flush();

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
            $entityManager = $this->getDoctrine()->getManager('worldofponies');
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
        //return $this->json($request->request->get('_token'));
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            //if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $player = $this->getDoctrine()->getRepository(Transaction::class)->find($id);
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
