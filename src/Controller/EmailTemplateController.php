<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\EmailTemplate; 
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 

final class EmailTemplateController extends AbstractController
{
    
        #[Route('/email/template', name: 'app_email_template')] // New route
        #[Route("/email-template/create", name: "email_template_create")] // New route
        public function create(Request $request, EntityManagerInterface $entityManager): Response
        {
            $template = new EmailTemplate();
    
            $form = $this->createFormBuilder($template)
                ->add('titre', TextType::class)
                ->add('sujet', TextType::class)
                ->add('contenu', TextareaType::class)
                ->add('save', SubmitType::class, ['label' => 'Créer le modèle'])
                ->getForm();
    
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                // Use the injected EntityManagerInterface to persist and flush the template
                $entityManager->persist($template);
                $entityManager->flush();
    
                return $this->redirectToRoute('email_template_success');
            }
    
            return $this->render('email_template/create.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

