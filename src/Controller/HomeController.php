<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="home",methods={"GET"})
     */
    public function home(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('estabelecimento_index');
        }

        return $this->redirectToRoute('app_login');
    }
}