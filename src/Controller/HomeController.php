<?php

namespace App\Controller;

use App\Repository\CenturiaRepository;
use App\Service\Battle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Provider\CenturiaProvider;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\LanguageController;
use App\Service\LanguageSwitcher;
use Symfony\Bundle\SecurityBundle\Security;

use function PHPUnit\Framework\throwException;

class HomeController extends AbstractController
{
    public function __construct(
        private Security $security,
    ){
    }

    #[Route('/', name: 'app_home')]
    public function index(Request $request, Battle $battle, CenturiaRepository $centuriaRepository, CenturiaProvider $centuriaProvider, LanguageSwitcher $languageSwitcher): Response
    {  
        if ($request->getSession()->get('locale') === 'fr') {
            $languageSwitcher->switchLocaleToFrench();
        }

        // returns User object or null if not authenticated
        $user = $this->security->getUser()->getUserIdentifier();

        return $this->render('home/index.html.twig', [
            'message' => 'Home',
            'user' => $user,
        ]);
    }

    #[Route('/battle', name: 'app_battle')]
    public function battle(Request $request, LanguageSwitcher $languageSwitcher, Battle $battle, CenturiaRepository $centuriaRepository, CenturiaProvider $centuriaProvider): Response
    {  
        $request_array = $request->request->all();
        $centurias_ids = array_values($request_array);
        if (!$centurias_ids) {
            throw new \Exception("Centurias haven't been selected");
        }
        $c1 = $centuriaRepository->findOneBy(['id' => $centurias_ids[0]]);
        if (!$c1) {
            throw new \Exception('First centuria not found');
        }
        
        $c2 = $centuriaRepository->findOneBy(['id' =>  $centurias_ids[1]]);
        if (!$c2) {
            throw new \Exception('Second centuria not found');
        }
        
        $results = $battle->CenturiaFighting($c1, $c2);

        if ($request->getSession()->get('locale') === 'fr') {
            $languageSwitcher->switchLocaleToFrench();
        }

        $user = $this->security->getUser()->getUserIdentifier();

        return $this->render('home/index.html.twig', [
            'message' => 'Home',
            'results' => $results,
            'user' => $user,

        ]);
    }
}
