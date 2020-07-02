<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ModeLivrasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ModeLivrasonRepository::class)
 */
class ModeLivrason
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
    private $libele;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Livraison::class, mappedBy="modeLivrason")
     */
    private $livraison;

    public function __construct()
    {
        $this->livraison = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibele(): ?string
    {
        return $this->libele;
    }

    public function setLibele(string $libele): self
    {
        $this->libele = $libele;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Livraison[]
     */
    public function getLivraison(): Collection
    {
        return $this->livraison;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraison->contains($livraison)) {
            $this->livraison[] = $livraison;
            $livraison->setModeLivrason($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraison->contains($livraison)) {
            $this->livraison->removeElement($livraison);
            // set the owning side to null (unless already changed)
            if ($livraison->getModeLivrason() === $this) {
                $livraison->setModeLivrason(null);
            }
        }

        return $this;
    }
}
