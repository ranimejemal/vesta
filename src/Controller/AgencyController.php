<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\AgentImmobiler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AgencyController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/property/{id}', name: 'agent_profil')]
    public function consulterProfil(int $id): Response
    {
        // Directly use the EntityManagerInterface
        $agent = $this->entityManager->getRepository(AgentImmobiler::class)->find($id);

        if (!$agent) {
            return $this->render('error.html.twig', [
                'message' => 'Agent introuvable.'
            ]);
        }

        return $this->render('agent/profil.html.twig', [
            'agent' => $agent
        ]);
    }
}