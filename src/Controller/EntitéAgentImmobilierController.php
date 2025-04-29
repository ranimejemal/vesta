<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EntitéAgentImmobilierController extends AbstractController
{
    #[Route('/entit/agent/immobilier', name: 'app_entit_agent_immobilier')]
    public function index(): Response
    {
        return $this->render('entitéagent_immobilier/index.html.twig', [
            'controller_name' => 'EntitéAgentImmobilierController',
        ]);
    }
}
