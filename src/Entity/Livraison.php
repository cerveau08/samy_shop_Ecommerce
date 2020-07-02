<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=LivraisonRepository::class)
 */
class Livraison
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $livreur;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephoneLivreur;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="livraison", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=ModeLivrason::class, inversedBy="livraison")
     */
    private $modeLivrason;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLivreur(): ?string
    {
        return $this->livreur;
    }

    public function setLivreur(string $livreur): self
    {
        $this->livreur = $livreur;

        return $this;
    }

    public function getTelephoneLivreur(): ?int
    {
        return $this->telephoneLivreur;
    }

    public function setTelephoneLivreur(int $telephoneLivreur): self
    {
        $this->telephoneLivreur = $telephoneLivreur;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getModeLivrason(): ?ModeLivrason
    {
        return $this->modeLivrason;
    }

    public function setModeLivrason(?ModeLivrason $modeLivrason): self
    {
        $this->modeLivrason = $modeLivrason;

        return $this;
    }
}
