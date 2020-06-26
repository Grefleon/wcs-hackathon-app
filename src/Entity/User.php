<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)\N
     * @Assert\NotBlank(
     *     message="Veuillez indiquer un nom d'utilisateur"
     * )
     * @Assert\Length(
     *     max = 180,
     *     maxMessage="Veuillez indiquer un nom d'utilisateur inférieur à 180 caractères"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message="Veuillez indiquer une adresse mail valide"
     * )
     * @Assert\NotBlank(
     *     message="Veuillez indiquer une adresse mail"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $experience;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avatar;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\ManyToMany(targetEntity=Goal::class)
     */
    private $goals;

    /**
     * @ORM\Column(type="boolean")
     */
    private $moodTest;
  
    /**
     * @ORM\ManyToMany(targetEntity=ExperienceList::class)
     */
    private $experienceList;

    /**
     * @ORM\ManyToMany(targetEntity=GoalSection::class, inversedBy="users")
     */
    private $interests;

    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->experienceList = new ArrayCollection();
        $this->interests = new ArrayCollection();
        $this->createdGoals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience = 0): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level = 1): self
    {
        $this->level = $level;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar = "/images/default.png"): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection|Goal[]
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(Goal $goal): self
    {
        if (!$this->goals->contains($goal)) {
            $this->goals[] = $goal;
        }

        return $this;
    }

    public function removeGoal(Goal $goal): self
    {
        if ($this->goals->contains($goal)) {
            $this->goals->removeElement($goal);
        }

        return $this;
    }

    /**
     * @return Collection|ExperienceList[]
     */
    public function getExperienceList(): Collection
    {
        return $this->experienceList;
    }

    public function addExperienceList(ExperienceList $experienceList): self
    {
        if (!$this->experienceList->contains($experienceList)) {
            $this->experienceList[] = $experienceList;
        }

        return $this;
    }

    public function removeExperienceList(ExperienceList $experienceList): self
    {
        if ($this->experienceList->contains($experienceList)) {
            $this->experienceList->removeElement($experienceList);
        }

        return $this;
    }
  
    public function getMoodTest(): ?bool
    {
        return $this->moodTest;
    }

    public function setMoodTest(bool $moodTest): self
    {
        $this->moodTest = $moodTest;

        return $this;
    }

    /**
     * @return Collection|GoalSection[]
     */
    public function getInterests(): Collection
    {
        return $this->interests;
    }

    public function addInterest(GoalSection $interest): self
    {
        if (!$this->interests->contains($interest)) {
            $this->interests[] = $interest;
        }

        return $this;
    }

    public function removeInterest(GoalSection $interest): self
    {
        if ($this->interests->contains($interest)) {
            $this->interests->removeElement($interest);
        }

        return $this;
    }
}
