<?php

namespace App\Controller;

use App\Entity\ItensReserva;
use App\Form\ItensReservaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/itens/reserva")
 */
class ItensReservaController extends AbstractController
{
    /**
     * @Route("/", name="itens_reserva_index", methods={"GET"})
     */
    public function index(): Response
    {
        $itensReservas = $this->getDoctrine()
            ->getRepository(ItensReserva::class)
            ->findAll();

        return $this->render('itens_reserva/index.html.twig', [
            'itens_reservas' => $itensReservas,
        ]);
    }

    /**
     * @Route("/new", name="itens_reserva_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $itensReserva = new ItensReserva();
        $form = $this->createForm(ItensReservaType::class, $itensReserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($itensReserva);
            $entityManager->flush();

            return $this->redirectToRoute('itens_reserva_index');
        }

        return $this->render('itens_reserva/new.html.twig', [
            'itens_reserva' => $itensReserva,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{iditensReserva}", name="itens_reserva_show", methods={"GET"})
     */
    public function show(ItensReserva $itensReserva): Response
    {
        return $this->render('itens_reserva/show.html.twig', [
            'itens_reserva' => $itensReserva,
        ]);
    }

    /**
     * @Route("/{iditensReserva}/edit", name="itens_reserva_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ItensReserva $itensReserva): Response
    {
        $form = $this->createForm(ItensReservaType::class, $itensReserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('itens_reserva_index');
        }

        return $this->render('itens_reserva/edit.html.twig', [
            'itens_reserva' => $itensReserva,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{iditensReserva}", name="itens_reserva_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ItensReserva $itensReserva): Response
    {
        if ($this->isCsrfTokenValid('delete'.$itensReserva->getIditensReserva(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($itensReserva);
            $entityManager->flush();
        }

        return $this->redirectToRoute('itens_reserva_index');
    }
}
