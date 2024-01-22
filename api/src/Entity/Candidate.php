<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\CandidateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;

#[ORM\Entity(repositoryClass: CandidateRepository::class)]
#[ApiResource]
#[ApiFilter(OrderFilter::class, properties: ['id', 'firstName', 'lastName', 'email', 'phoneNumber', 'expectedSalary', 'level', 'position'], arguments: ['orderParameterName' => 'order'])]
#[ApiFilter(BooleanFilter::class, properties: ['viewed'])]
class Candidate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $phoneNumber = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?float $expectedSalary = null;

    #[ORM\Column(length: 7)]
    private ?string $level = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $position = null;

    #[ORM\Column]
    private ?bool $viewed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
    public function getExpectedSalary(): ?float
    {
        return $this->expectedSalary;
    }

    public function setExpectedSalary(float $expectedSalary): static
    {
        $this->expectedSalary = $expectedSalary;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function isViewed(): ?bool
    {
        return $this->viewed;
    }

    public function setViewed(bool $viewed): static
    {
        $this->viewed = $viewed;

        return $this;
    }

}
