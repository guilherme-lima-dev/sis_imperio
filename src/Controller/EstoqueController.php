<?php

namespace App\Controller;

use App\Entity\Estoque;
use App\Form\EstoqueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/estoque")
 */
class EstoqueController extends AbstractController
{
    /**
     * @Route("/", name="estoque_index", methods={"GET"})
     */
    public function index(): Response
    {
        $estoques = $this->getDoctrine()
            ->getRepository(Estoque::class)
            ->findAll();

        return $this->render('estoque/index.html.twig', [
            'estoques' => $estoques,
        ]);
    }

    /**
     * @Route("/new", name="estoque_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $estoque = new Estoque();
        $form = $this->createForm(EstoqueType::class, $estoque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estoque);
            $entityManager->flush();

            return $this->redirectToRoute('estoque_index');
        }

        return $this->render('estoque/new.html.twig', [
            'estoque' => $estoque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idestoque}", name="estoque_show", methods={"GET"})
     */
    public function show(Estoque $estoque): Response
    {
        return $this->render('estoque/show.html.twig', [
            'estoque' => $estoque,
        ]);
    }

    /**
     * @Route("/{idestoque}/edit", name="estoque_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Estoque $estoque): Response
    {
        $form = $this->createForm(EstoqueType::class, $estoque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estoque_index');
        }

        return $this->render('estoque/edit.html.twig', [
            'estoque' => $estoque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idestoque}", name="estoque_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Estoque $estoque): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estoque->getIdestoque(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estoque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('estoque_index');
    }
}
