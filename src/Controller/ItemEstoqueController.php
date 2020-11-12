<?php

namespace App\Controller;

use App\Entity\ItemEstoque;
use App\Form\ItemEstoqueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/item/estoque")
 */
class ItemEstoqueController extends AbstractController
{
    /**
     * @Route("/", name="item_estoque_index", methods={"GET"})
     */
    public function index(): Response
    {
        $itemEstoques = $this->getDoctrine()
            ->getRepository(ItemEstoque::class)
            ->findAll();

        return $this->render('item_estoque/index.html.twig', [
            'item_estoques' => $itemEstoques,
        ]);
    }

    /**
     * @Route("/new", name="item_estoque_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $itemEstoque = new ItemEstoque();
        $form = $this->createForm(ItemEstoqueType::class, $itemEstoque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($itemEstoque);
            $entityManager->flush();

            return $this->redirectToRoute('item_estoque_index');
        }

        return $this->render('item_estoque/new.html.twig', [
            'item_estoque' => $itemEstoque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{iditemEstoque}", name="item_estoque_show", methods={"GET"})
     */
    public function show(ItemEstoque $itemEstoque): Response
    {
        return $this->render('item_estoque/show.html.twig', [
            'item_estoque' => $itemEstoque,
        ]);
    }

    /**
     * @Route("/{iditemEstoque}/edit", name="item_estoque_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ItemEstoque $itemEstoque): Response
    {
        $form = $this->createForm(ItemEstoqueType::class, $itemEstoque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('item_estoque_index');
        }

        return $this->render('item_estoque/edit.html.twig', [
            'item_estoque' => $itemEstoque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{iditemEstoque}", name="item_estoque_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ItemEstoque $itemEstoque): Response
    {
        if ($this->isCsrfTokenValid('delete'.$itemEstoque->getIditemEstoque(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($itemEstoque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('item_estoque_index');
    }
}
