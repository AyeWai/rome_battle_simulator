<?php

namespace App\Controller;

use App\Repository\CenturiaRepository;
use App\Service\Battle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Provider\CenturiaProvider;
use Symfony\Component\HttpFoundation\Request;

use function PHPUnit\Framework\throwException;

class HomeController extends AbstractController
{
    
    #[Route('/', name: 'app_home')]
    public function battle(Battle $battle, CenturiaRepository $centuriaRepository, CenturiaProvider $centuriaProvider): Response
    {  

        $c1 = $centuriaRepository->findOneBy(['id' => 1]);
        if (!$c1) {
            throw new \Exception('First centuria not found');
        }
        
        $c2 = $centuriaRepository->findOneBy(['id' => 2]);
        if (!$c2) {
            throw new \Exception('Second centuria not found');
        }
        
        $results = $battle->CenturiaFighting($c1, $c2);
            
        return $this->render('home/index.html.twig', [
            'message' => 'Home',
            'results' => $results,
            'centurias' =>$centuriaProvider->getCenturias(),
        ]);
    }

    #[Route('/battle', name: 'app_battle')]
    public function index(Request $request,Battle $battle, CenturiaRepository $centuriaRepository, CenturiaProvider $centuriaProvider): Response
    {  
        dd($request);
        $first_centuria_id = $request->request->get('first_centuria_id');
        $second_centuria_id = $request->request->get('second_centuria_id');

        $c1 = $centuriaRepository->findOneBy(['id' => $first_centuria_id]);
        if (!$c1) {
            throw new \Exception('First centuria not found');
        }
        
        $c2 = $centuriaRepository->findOneBy(['id' =>  $second_centuria_id]);
        if (!$c2) {
            throw new \Exception('Second centuria not found');
        }
        
        $results = $battle->CenturiaFighting($c1, $c2);

        return $this->render('home/index.html.twig', [
            'message' => 'Home',
            'results' => $results,
            'centurias' =>$centuriaProvider->getCenturias(),
        ]);
    
    }
}
