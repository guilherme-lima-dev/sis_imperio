<?php

namespace App\Controller;

use App\Entity\ItemComanda;
use App\Form\ItemComandaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/item/comanda")
 */
class ItemComandaController extends AbstractController
{
    /**
     * @Route("/", name="item_comanda_index", methods={"GET"})
     */
    public function index(): Response
    {
        $itemComandas = $this->getDoctrine()
            ->getRepository(ItemComanda::class)
            ->findAll();

        return $this->render('item_comanda/index.html.twig', [
            'item_comandas' => $itemComandas,
        ]);
    }

    /**
     * @Route("/new", name="item_comanda_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $itemComanda = new ItemComanda();
        $form = $this->createForm(ItemComandaType::class, $itemComanda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($itemComanda);
            $entityManager->flush();

            return $this->redirectToRoute('item_comanda_index');
        }

        return $this->render('item_comanda/new.html.twig', [
            'item_comanda' => $itemComanda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{iditemComanda}", name="item_comanda_show", methods={"GET"})
     */
    public function show(ItemComanda $itemComanda): Response
    {
        return $this->render('item_comanda/show.html.twig', [
            'item_comanda' => $itemComanda,
        ]);
    }

    /**
     * @Route("/{iditemComanda}/edit", name="item_comanda_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ItemComanda $itemComanda): Response
    {
        $form = $this->createForm(ItemComandaType::class, $itemComanda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('item_comanda_index');
        }

        return $this->render('item_comanda/edit.html.twig', [
            'item_comanda' => $itemComanda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{iditemComanda}", name="item_comanda_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ItemComanda $itemComanda): Response
    {
        if ($this->isCsrfTokenValid('delete'.$itemComanda->getIditemComanda(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($itemComanda);
            $entityManager->flush();
        }

        return $this->redirectToRoute('item_comanda_index');
    }
}
