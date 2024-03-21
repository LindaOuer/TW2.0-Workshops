<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StudentRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column]
    #[Assert\NotBlank(message: 'NSC is required')]
    private $nsc;

    #[ORM\Column(length: 50, nullable: false)]
    #[Assert\NotBlank(message: 'Email is required')]
    #[Assert\Email(message: 'Email {{ value }} must be valid')]

    private $email;

    public function getNsc(): ?int
    {
        return $this->nsc;
    }

    public function setNsc(int $nsc): static
    {
        $this->nsc = $nsc;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}
