<?php

namespace App\Controller;

use App\Entity\Estabelecimento;
use App\Form\EstabelecimentoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/estabelecimento")
 */
class EstabelecimentoController extends AbstractController
{
    /**
     * @Route("/", name="estabelecimento_index", methods={"GET"})
     */
    public function index(): Response
    {
        $estabelecimentos = $this->getDoctrine()
            ->getRepository(Estabelecimento::class)
            ->findAll();

        return $this->render('estabelecimento/index.html.twig', [
            'estabelecimentos' => $estabelecimentos,
        ]);
    }

    /**
     * @Route("/new", name="estabelecimento_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $estabelecimento = new Estabelecimento();
        $form = $this->createForm(EstabelecimentoType::class, $estabelecimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estabelecimento);
            $entityManager->flush();

            return $this->redirectToRoute('estabelecimento_index');
        }

        return $this->render('estabelecimento/new.html.twig', [
            'estabelecimento' => $estabelecimento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idestabelecimento}", name="estabelecimento_show", methods={"GET"})
     */
    public function show(Estabelecimento $estabelecimento): Response
    {
        return $this->render('estabelecimento/show.html.twig', [
            'estabelecimento' => $estabelecimento,
        ]);
    }

    /**
     * @Route("/{idestabelecimento}/edit", name="estabelecimento_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Estabelecimento $estabelecimento): Response
    {
        $form = $this->createForm(EstabelecimentoType::class, $estabelecimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estabelecimento_index');
        }

        return $this->render('estabelecimento/edit.html.twig', [
            'estabelecimento' => $estabelecimento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idestabelecimento}", name="estabelecimento_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Estabelecimento $estabelecimento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estabelecimento->getIdestabelecimento(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estabelecimento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('estabelecimento_index');
    }
}
