<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EmailTemplateController extends AbstractController
{
    #[Route('/email/template', name: 'app_email_template')]
    /**
     * @Route("/email-template/create", name="email_template_create")
     */
    public function create(Request $request): Response
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($template);
            $em->flush();

            return $this->redirectToRoute('email_template_success');
        }

        return $this->render('email_template/create.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
