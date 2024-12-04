<?php 

// src/Entity/EmploiDuTemps.php
namespace App\Entity;

use App\Repository\EmploiDuTempsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EmploiDuTempsRepository::class)]
#[ORM\Table(name: 'emploi_du_temps')]
class EmploiDuTemps
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private ?string $titre = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private ?string $lieu = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private ?string $enseignant = null;

    #[ORM\Column(type: 'string', length: 10)]
    #[Assert\Choice(choices: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'], message: 'Choisissez un jour valide.')]
    private ?string $jour = null; // Nouveau champ pour le jour de la semaine

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $debut = null;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $fin = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $recurrence = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $intervalle = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $finRecurrence = null;

    // Getters et Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getEnseignant(): ?string
    {
        return $this->enseignant;
    }

    public function setEnseignant(string $enseignant): self
    {
        $this->enseignant = $enseignant;
        return $this;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;
        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;
        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;
        return $this;
    }

    public function getRecurrence(): ?string
    {
        return $this->recurrence;
    }

    public function setRecurrence(?string $recurrence): self
    {
        $this->recurrence = $recurrence;
        return $this;
    }

    public function getIntervalle(): ?int
    {
        return $this->intervalle;
    }

    public function setIntervalle(?int $intervalle): self
    {
        $this->intervalle = $intervalle;
        return $this;
    }

    public function getFinRecurrence(): ?\DateTimeInterface
    {
        return $this->finRecurrence;
    }

    public function setFinRecurrence(?\DateTimeInterface $finRecurrence): self
    {
        $this->finRecurrence = $finRecurrence;
        return $this;
    }
}
