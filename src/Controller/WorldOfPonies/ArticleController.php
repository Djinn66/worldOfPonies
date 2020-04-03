<?php

namespace App\Controller\WorldOfPonies;

use App\Entity\WorldOfPonies\Article;
use App\Form\WorldOfPonies\ArticleType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/worldofponies/article")
 * @Security("is_granted('ROLE_SUPERUSER') or is_granted('ROLE_PROGRAMMER')")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="world_of_ponies_article_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $title = $request->query->get('title');
        $articleId = $request->query->get('articleId');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $orderBy = [];
        $criteria = [];

        if($sortBy != "")
            $orderBy = [$sortBy=> $order];
        if($articleId != "")
            $criteria += ['articleId' => $articleId];
        if($title != "")
            $criteria += ['title' => $title];

        $articles =  $this->getDoctrine()
            ->getManager($this->getUser()->getRoles()[0])
            ->getRepository(Article::class)
            ->findBy($criteria, $orderBy);

        $pagination = $paginator->paginate(
            $articles,
            $request->query->getInt('page',1),
            30
        );

        return $this->render('world_of_ponies/article/index.html.twig', [
            'articleId' => $articleId,
            'title' => $title,
            'order' => $order,
            'sortBy' => $sortBy,
            'articles' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="world_of_ponies_article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('world_of_ponies_article_index');
        }

        return $this->render('world_of_ponies/article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{articleId}", name="world_of_ponies_article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('world_of_ponies/article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/edit/{articleId}", name="world_of_ponies_article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article): Response
    {

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager($this->getUser()->getRoles()[0])->flush();

            return $this->redirectToRoute('world_of_ponies_article_index');
        }

        return $this->render('world_of_ponies/article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{articleId}", name="world_of_ponies_article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getArticleId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('world_of_ponies_article_index');
    }
    /**
     * @Route("/", name="world_of_ponies_article_delete_selected", methods={"DELETE"})
     */
    public function deleteSelected(Request $request): Response
    {
        $ids = $request->request->get('tab');
        foreach($ids as $id){
            $article = $this->getDoctrine()
                ->getRepository(Article::class, $this->getUser()->getRoles()[0])
                ->find($id);

            if(isset($article)){
                $entityManager = $this->getDoctrine()->getManager($this->getUser()->getRoles()[0]);
                $entityManager->remove($article);
                $entityManager->flush();
            } else return $this->json( "already");

        }

        return $this->json( "deleted");
    }
}
