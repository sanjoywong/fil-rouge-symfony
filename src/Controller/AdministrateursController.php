<?php

namespace App\Controller;

use App\Entity\Administrateurs;
use App\Form\AdministrateursType;
use App\Repository\AdministrateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/administrateurs')]
class AdministrateursController extends AbstractController
{
    #[Route('/', name: 'app_administrateurs_index', methods: ['GET'])]
    public function index(AdministrateursRepository $administrateursRepository): Response
    {
        return $this->render('administrateurs/index.html.twig', [
            'administrateurs' => $administrateursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_administrateurs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AdministrateursRepository $administrateursRepository): Response
    {
        $administrateur = new Administrateurs();
        $form = $this->createForm(AdministrateursType::class, $administrateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $administrateursRepository->save($administrateur, true);

            return $this->redirectToRoute('app_administrateurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('administrateurs/new.html.twig', [
            'administrateur' => $administrateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_administrateurs_show', methods: ['GET'])]
    public function show(Administrateurs $administrateur): Response
    {
        return $this->render('administrateurs/show.html.twig', [
            'administrateur' => $administrateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_administrateurs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Administrateurs $administrateur, AdministrateursRepository $administrateursRepository): Response
    {
        $form = $this->createForm(AdministrateursType::class, $administrateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $administrateursRepository->save($administrateur, true);

            return $this->redirectToRoute('app_administrateurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('administrateurs/edit.html.twig', [
            'administrateur' => $administrateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_administrateurs_delete', methods: ['POST'])]
    public function delete(Request $request, Administrateurs $administrateur, AdministrateursRepository $administrateursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$administrateur->getId(), $request->request->get('_token'))) {
            $administrateursRepository->remove($administrateur, true);
        }

        return $this->redirectToRoute('app_administrateurs_index', [], Response::HTTP_SEE_OTHER);
    }
}
