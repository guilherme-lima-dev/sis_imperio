<?php

namespace App\Controller;

use App\Entity\TipoEstabelecimento;
use App\Form\TipoEstabelecimentoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tipo/estabelecimento")
 */
class TipoEstabelecimentoController extends AbstractController
{
    /**
     * @Route("/", name="tipo_estabelecimento_index", methods={"GET"})
     */
    public function index(): Response
    {
        $tipoEstabelecimentos = $this->getDoctrine()
            ->getRepository(TipoEstabelecimento::class)
            ->findAll();

        return $this->render('tipo_estabelecimento/index.html.twig', [
            'tipo_estabelecimentos' => $tipoEstabelecimentos,
        ]);
    }

    /**
     * @Route("/new", name="tipo_estabelecimento_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoEstabelecimento = new TipoEstabelecimento();
        $form = $this->createForm(TipoEstabelecimentoType::class, $tipoEstabelecimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipoEstabelecimento);
            $entityManager->flush();

            return $this->redirectToRoute('tipo_estabelecimento_index');
        }

        return $this->render('tipo_estabelecimento/new.html.twig', [
            'tipo_estabelecimento' => $tipoEstabelecimento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idtipoEstabelecimento}", name="tipo_estabelecimento_show", methods={"GET"})
     */
    public function show(TipoEstabelecimento $tipoEstabelecimento): Response
    {
        return $this->render('tipo_estabelecimento/show.html.twig', [
            'tipo_estabelecimento' => $tipoEstabelecimento,
        ]);
    }

    /**
     * @Route("/{idtipoEstabelecimento}/edit", name="tipo_estabelecimento_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoEstabelecimento $tipoEstabelecimento): Response
    {
        $form = $this->createForm(TipoEstabelecimentoType::class, $tipoEstabelecimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipo_estabelecimento_index');
        }

        return $this->render('tipo_estabelecimento/edit.html.twig', [
            'tipo_estabelecimento' => $tipoEstabelecimento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idtipoEstabelecimento}", name="tipo_estabelecimento_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TipoEstabelecimento $tipoEstabelecimento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoEstabelecimento->getIdtipoEstabelecimento(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoEstabelecimento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tipo_estabelecimento_index');
    }
}
