<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeEtablissementController extends AbstractController
{
    #[Route('/liste/etablissement', name: 'app_liste_etablissement')]
    public function index(): Response
    {
        return $this->render('liste_etablissement/index.html.twig', [
            'controller_name' => 'ListeEtablissementController',
        ]);
    }
}
