<?php

namespace App\Controller;

use App\Entity\Centuria;
use App\Form\Centuria2Type;
use App\Repository\CenturiaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/centuria')]
class CenturiaController extends AbstractController
{
    #[Route('/', name: 'app_centuria_index', methods: ['GET'])]
    public function index(CenturiaRepository $centuriaRepository): Response
    {
        return $this->render('centuria/index.html.twig', [
            'centurias' => $centuriaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_centuria_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CenturiaRepository $centuriaRepository): Response
    {
        $centurium = new Centuria();
        $form = $this->createForm(Centuria2Type::class, $centurium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centuriaRepository->save($centurium, true);

            return $this->redirectToRoute('app_centuria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('centuria/new.html.twig', [
            'centurium' => $centurium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centuria_show', methods: ['GET'])]
    public function show(Centuria $centurium): Response
    {
        return $this->render('centuria/show.html.twig', [
            'centurium' => $centurium,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_centuria_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Centuria $centurium, CenturiaRepository $centuriaRepository): Response
    {
        $form = $this->createForm(Centuria2Type::class, $centurium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centuriaRepository->save($centurium, true);

            return $this->redirectToRoute('app_centuria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('centuria/edit.html.twig', [
            'centurium' => $centurium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centuria_delete', methods: ['POST'])]
    public function delete(Request $request, Centuria $centurium, CenturiaRepository $centuriaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$centurium->getId(), $request->request->get('_token'))) {
            $centuriaRepository->remove($centurium, true);
        }

        return $this->redirectToRoute('app_centuria_index', [], Response::HTTP_SEE_OTHER);
    }
}
