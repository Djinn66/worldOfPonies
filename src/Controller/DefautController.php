<?php

namespace App\Controller;

use App\Repository\WorldOfPonies\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefautController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     * @return Response
     */
    public function index():Response
    {
        return $this->redirectToRoute('app_login' );
    }
}