<?php

namespace App\Entity;

use App\Repository\GoalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GoalRepository::class)
 */
class Goal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=GoalSection::class, inversedBy="goals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $section;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="personalGoals")
     */
    private $creatorId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSection(): ?GoalSection
    {
        return $this->section;
    }

    public function setSection(?GoalSection $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getCreatorId(): ?User
    {
        return $this->creatorId;
    }

    public function setCreatorId(?User $creatorId): self
    {
        $this->creatorId = $creatorId;

        return $this;
    }
}
