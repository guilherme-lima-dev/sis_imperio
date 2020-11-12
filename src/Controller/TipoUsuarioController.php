<?php

namespace App\Controller;

use App\Entity\TipoUsuario;
use App\Form\TipoUsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tipo/usuario")
 */
class TipoUsuarioController extends AbstractController
{
    /**
     * @Route("/", name="tipo_usuario_index", methods={"GET"})
     */
    public function index(): Response
    {
        $tipoUsuarios = $this->getDoctrine()
            ->getRepository(TipoUsuario::class)
            ->findAll();

        return $this->render('tipo_usuario/index.html.twig', [
            'tipo_usuarios' => $tipoUsuarios,
        ]);
    }

    /**
     * @Route("/new", name="tipo_usuario_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoUsuario = new TipoUsuario();
        $form = $this->createForm(TipoUsuarioType::class, $tipoUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipoUsuario);
            $entityManager->flush();

            return $this->redirectToRoute('tipo_usuario_index');
        }

        return $this->render('tipo_usuario/new.html.twig', [
            'tipo_usuario' => $tipoUsuario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idtipoUsuario}", name="tipo_usuario_show", methods={"GET"})
     */
    public function show(TipoUsuario $tipoUsuario): Response
    {
        return $this->render('tipo_usuario/show.html.twig', [
            'tipo_usuario' => $tipoUsuario,
        ]);
    }

    /**
     * @Route("/{idtipoUsuario}/edit", name="tipo_usuario_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoUsuario $tipoUsuario): Response
    {
        $form = $this->createForm(TipoUsuarioType::class, $tipoUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipo_usuario_index');
        }

        return $this->render('tipo_usuario/edit.html.twig', [
            'tipo_usuario' => $tipoUsuario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idtipoUsuario}", name="tipo_usuario_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TipoUsuario $tipoUsuario): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoUsuario->getIdtipoUsuario(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoUsuario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tipo_usuario_index');
    }
}
