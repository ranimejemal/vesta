<?php

namespace App\Entity;

use App\Repository\EmailTemplateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmailTemplateRepository::class)]
class EmailTemplate
{
   /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le titre est obligatoire.")
     */
    private $titre;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le sujet est obligatoire.")
     */
    private $sujet;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le contenu est obligatoire.")
     */
    private $contenu;

    // Getters & setters...
}
