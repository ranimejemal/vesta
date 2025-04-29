<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AgenyController extends AbstractController
{ /**
    * @Route("/agent/{id}", name="agent_profil")
    */
   public function consulterProfil(int $id): Response
   {
       $agent = $this->getDoctrine()->getRepository(AgentImmobilier::class)->find($id);

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
