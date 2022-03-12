<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $TypeR;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DescriptionR;

    /**
     * @ORM\Column(type="date")
     */
    private $DateR;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reclamation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeR(): ?string
    {
        return $this->TypeR;
    }

    public function setTypeR(string $TypeR): self
    {
        $this->TypeR = $TypeR;

        return $this;
    }

    public function getDescriptionR(): ?string
    {
        return $this->DescriptionR;
    }

    public function setDescriptionR(string $DescriptionR): self
    {
        $this->DescriptionR = $DescriptionR;

        return $this;
    }

    public function getDateR(): ?\DateTimeInterface
    {
        return $this->DateR;
    }

    public function setDateR(\DateTimeInterface $DateR): self
    {
        $this->DateR = $DateR;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->Client;
    }

    public function setClient(?User $Client): self
    {
        $this->Client = $Client;

        return $this;
    }
}
