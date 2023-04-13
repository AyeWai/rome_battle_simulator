<?php

namespace App\Controller;

use App\Entity\Centurion;
use App\Form\CenturionType;
use App\Repository\CenturionRepository;
use App\Service\UserMessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/centurion')]
class CenturionController extends AbstractController
{
    #[Route('/', name: 'app_centurion_index', methods: ['GET'])]
    public function index(CenturionRepository $centurionRepository, UserMessageGenerator $message): Response
    {
        return $this->render('centurion/index.html.twig', [
            'centurions' => $centurionRepository->findAll(),
            'message' => $message->getWelcomeMessage(),
        ]);
    }

    #[Route('/new', name: 'app_centurion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CenturionRepository $centurionRepository): Response
    {
        $centurion = new Centurion();
        $form = $this->createForm(CenturionType::class, $centurion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centurionRepository->save($centurion, true);
            $this->addFlash('success', 'Centurion successfully created !');


            return $this->redirectToRoute('app_centurion_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('centurion/new.html.twig', [
            'centurion' => $centurion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centurion_show', methods: ['GET'])]
    public function show(Centurion $centurion): Response
    {
        return $this->render('centurion/show.html.twig', [
            'centurion' => $centurion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_centurion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Centurion $centurion, CenturionRepository $centurionRepository): Response
    {
        $form = $this->createForm(CenturionType::class, $centurion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centurionRepository->save($centurion, true);

            return $this->redirectToRoute('app_centurion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('centurion/edit.html.twig', [
            'centurion' => $centurion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centurion_delete', methods: ['POST'])]
    public function delete(Request $request, Centurion $centurion, CenturionRepository $centurionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$centurion->getId(), $request->request->get('_token'))) {
            $centurionRepository->remove($centurion, true);
        }

        return $this->redirectToRoute('app_centurion_index', [], Response::HTTP_SEE_OTHER);
    }
}
