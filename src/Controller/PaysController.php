<?php

namespace App\Controller;

use App\Entity\Player;
use App\Repository\PayeRepository;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaysController extends AbstractController
{

    public function __construct(private PayeRepository $paysRepository){}
    #[Route('/pays', name: 'pays.index')]
    public function index(): Response
    {
        $pays = $this->paysRepository->findAll();
        return $this->render('pays/index.html.twig', [
            'pays' => $pays,
        ]);
    }

    #[Route("/pays/detail/{id}", name: "pays.detail")]
    /**
     * @Route("Route", name="RouteName")
     */ 

    public function detail(int $id): Response
    {
        $pays = $this->paysRepository->findOneBy(['id' => $id]);
        return $this->render('pays/detail.html.twig', [
            'pays' => $pays
        ]);
    }

}
