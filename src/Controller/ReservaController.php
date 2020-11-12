<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Form\ReservaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reserva")
 */
class ReservaController extends AbstractController
{
    /**
     * @Route("/", name="reserva_index", methods={"GET"})
     */
    public function index(): Response
    {
        $reservas = $this->getDoctrine()
            ->getRepository(Reserva::class)
            ->findAll();

        return $this->render('reserva/index.html.twig', [
            'reservas' => $reservas,
        ]);
    }

    /**
     * @Route("/new", name="reserva_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reserva = new Reserva();
        $form = $this->createForm(ReservaType::class, $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reserva);
            $entityManager->flush();

            return $this->redirectToRoute('reserva_index');
        }

        return $this->render('reserva/new.html.twig', [
            'reserva' => $reserva,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idreserva}", name="reserva_show", methods={"GET"})
     */
    public function show(Reserva $reserva): Response
    {
        return $this->render('reserva/show.html.twig', [
            'reserva' => $reserva,
        ]);
    }

    /**
     * @Route("/{idreserva}/edit", name="reserva_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reserva $reserva): Response
    {
        $form = $this->createForm(ReservaType::class, $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reserva_index');
        }

        return $this->render('reserva/edit.html.twig', [
            'reserva' => $reserva,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idreserva}", name="reserva_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reserva $reserva): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reserva->getIdreserva(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reserva);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reserva_index');
    }
}
