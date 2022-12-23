<?php

namespace App\Controller;

use App\Entity\Player;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{

    public function __construct(private PlayerRepository $playerRepository){}
    #[Route('/players', name: 'players.index')]
    public function index(): Response
    {
        $players = $this->playerRepository->findAll();
        return $this->render('player/index.html.twig', [
            'players' => $players,
        ]);
    }

    #[Route("/players/detail/{id}", name: "player.detail")]
    /**
     * @Route("Route", name="RouteName")
     */ 

    public function detail(int $id): Response
    {
        $players = $this->playerRepository->findAll();
        $player = $this->playerRepository->findOneBy(['id' => $id]);
        function search($id, $players): Player {
            for ($i=0; $i < count($players) ; $i++) {
                if($players[$i]->getId() == $id) return $players[$i]; 
            }
            return $players[0];
        }
        // dd($player);
        return $this->render('player/detail.html.twig', [
            'player' => $player// search($id, $players)
        ]);
    }

}
