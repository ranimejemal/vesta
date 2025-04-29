<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class AdminController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'admin_dashboard')]
   
    public function dashboard(): Response
    {
        // Récupère le nombre d'utilisateurs
        $userCount = 5;
        
        // Rend la vue avec les données
        return $this->render('admin/dashboard.html.twig', [
            'user_count' => $userCount,
            'controller_name' => 'admin_controller',
        ]);
    }
    
}
