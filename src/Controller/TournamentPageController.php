<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TournamentPageController extends AbstractController
{
    #[Route('/tournament/new', name: 'tournament_new')]
    public function new(): Response
    {
        return $this->render('tournament/new.html.twig');
    }
}
