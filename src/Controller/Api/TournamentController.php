<?php

namespace App\Controller\Api;

use App\Entity\Tournament;
use App\Enum\TournamentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TournamentController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/tournaments', name: 'api_create_tournament', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            if (empty($data['name']) || empty($data['type'])) {
                return $this->json(['error' => 'Name and Type are required'], 400);
            }

            if (!in_array($data['type'], ['mixed', 'championship', 'elimination'])) {
                return $this->json(['error' => 'Invalid tournament type'], 400);
            }

            $tournament = new Tournament();
            $tournament->setName($data['name']);
            $tournament->setType(TournamentType::from($data['type'])); // enum

            $this->entityManager->persist($tournament);
            $this->entityManager->flush();

            return $this->json(['message' => 'Tournament created successfully'], 201);
        } catch (\Throwable $e) {
            return $this->json(['error' => $e->getMessage()], 500);
        }
    }

    #[Route('/api/tournaments_list', name: 'api_list_tournaments', methods: ['GET'])]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $tournaments = $entityManager->getRepository(Tournament::class)->findAll();

        $data = [];

        foreach ($tournaments as $tournament) {
            $data[] = [
                'id' => $tournament->getId(),
                'name' => $tournament->getName(),
                'type' => $tournament->getType(),
            ];
        }

        return new JsonResponse($data);
    }
}
