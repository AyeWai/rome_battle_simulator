<?php

namespace App\Controller;

use App\Service\LanguageSwitcher;
use App\Service\Provider\CenturiaProvider;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class LanguageController extends AbstractController
{

    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route('/change-language/{locale}', name: 'change_language')]
    public function switchLanguage(LanguageSwitcher $languageSwitcher, string $locale, Request $request, CenturiaProvider $centuriaProvider ): Response
    {
        $session = $request->getSession();

        if ($locale == 'fr' && $languageSwitcher->getLocale() == 'en'){
            $languageSwitcher->switchLocaleToFrench(); 
            $session->set('locale', 'fr');
        }else{
            $languageSwitcher->resetLocale();
            $session->set('locale', 'en');
            
        }
        // Redirigez vers la page d'accueil
        return $this->redirectToRoute('app_home');
    }
}
