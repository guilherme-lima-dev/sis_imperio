<?php

namespace App\Controller;

use App\Entity\Comanda;
use App\Form\ComandaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comanda")
 */
class ComandaController extends AbstractController
{
    /**
     * @Route("/", name="comanda_index", methods={"GET"})
     */
    public function index(): Response
    {
        $comandas = $this->getDoctrine()
            ->getRepository(Comanda::class)
            ->findAll();

        return $this->render('comanda/index.html.twig', [
            'comandas' => $comandas,
        ]);
    }

    /**
     * @Route("/new", name="comanda_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $comanda = new Comanda();
        $form = $this->createForm(ComandaType::class, $comanda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comanda);
            $entityManager->flush();

            return $this->redirectToRoute('comanda_index');
        }

        return $this->render('comanda/new.html.twig', [
            'comanda' => $comanda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcomanda}", name="comanda_show", methods={"GET"})
     */
    public function show(Comanda $comanda): Response
    {
        return $this->render('comanda/show.html.twig', [
            'comanda' => $comanda,
        ]);
    }

    /**
     * @Route("/{idcomanda}/edit", name="comanda_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Comanda $comanda): Response
    {
        $form = $this->createForm(ComandaType::class, $comanda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comanda_index');
        }

        return $this->render('comanda/edit.html.twig', [
            'comanda' => $comanda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcomanda}", name="comanda_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Comanda $comanda): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comanda->getIdcomanda(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comanda);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comanda_index');
    }
}
