<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 */
class Marque
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
     * @ORM\OneToMany(targetEntity=Articles::class, mappedBy="marque")
     */
    private $article;

    public function __construct()
    {
        $this->article = new ArrayCollection();
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

    /**
     * @return Collection|Articles[]
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Articles $article): self
    {
        if (!$this->article->contains($article)) {
            $this->article[] = $article;
            $article->setMarque($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): self
    {
        if ($this->article->contains($article)) {
            $this->article->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getMarque() === $this) {
                $article->setMarque(null);
            }
        }

        return $this;
    }
}
