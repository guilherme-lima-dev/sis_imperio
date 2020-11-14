<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function home(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
            ]);
        }
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/dashboard", name="dashboard", methods={"GET"})
     */
    public function dashboard(Request $request): Response
    {
        return $this->render('home/dashboard.html.twig');
    }
}
