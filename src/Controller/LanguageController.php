<?php

namespace App\Controller;

use App\Service\LanguageSwitcher;
use App\Service\Provider\CenturiaProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends AbstractController
{

    #[Route('/change-language/{locale}', name: 'change_language')]
    public function toFrench(LanguageSwitcher $languageSwitcher, string $locale, Request $request, CenturiaProvider $centuriaProvider ): Response
    {
        if ($locale == 'fr'){ 
            $languageSwitcher->switchLocaleToFrench(); 
        }else{
            $languageSwitcher->resetLocale();
        }
        // Redirigez vers la page d'accueil
        //return $this->redirectToRoute('app_home');

        return $this->render('home/index.html.twig', [
            'message' => 'Home',
            'centurias' =>$centuriaProvider->getCenturias(),
        ]);
    }
}
