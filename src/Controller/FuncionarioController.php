<?php

namespace App\Controller;

use App\Entity\Funcionario;
use App\Form\FuncionarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/funcionario")
 */
class FuncionarioController extends AbstractController
{
    /**
     * @Route("/", name="funcionario_index", methods={"GET"})
     */
    public function index(): Response
    {
        $funcionarios = $this->getDoctrine()
            ->getRepository(Funcionario::class)
            ->findAll();

        return $this->render('funcionario/index.html.twig', [
            'funcionarios' => $funcionarios,
        ]);
    }

    /**
     * @Route("/new", name="funcionario_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $funcionario = new Funcionario();
        $form = $this->createForm(FuncionarioType::class, $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($funcionario);
            $entityManager->flush();

            return $this->redirectToRoute('funcionario_index');
        }

        return $this->render('funcionario/new.html.twig', [
            'funcionario' => $funcionario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idfuncionarios}", name="funcionario_show", methods={"GET"})
     */
    public function show(Funcionario $funcionario): Response
    {
        return $this->render('funcionario/show.html.twig', [
            'funcionario' => $funcionario,
        ]);
    }

    /**
     * @Route("/{idfuncionarios}/edit", name="funcionario_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Funcionario $funcionario): Response
    {
        $form = $this->createForm(FuncionarioType::class, $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('funcionario_index');
        }

        return $this->render('funcionario/edit.html.twig', [
            'funcionario' => $funcionario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idfuncionarios}", name="funcionario_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Funcionario $funcionario): Response
    {
        if ($this->isCsrfTokenValid('delete'.$funcionario->getIdfuncionarios(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($funcionario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('funcionario_index');
    }
}
