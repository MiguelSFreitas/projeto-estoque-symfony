<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 51, unique: true)]
    #[Assert\NotBlank(message: 'O nome da categoria é obrigatório.')]
    #[Assert\Length(max: 51, maxMessage: 'O nome deve ter no máximo {{ limit }} caracteres.')]
    private ?string $nome = null;

    /** @var Collection<int, Produto> */
    #[ORM\OneToMany(mappedBy: 'categoria', targetEntity: Produto::class)]
    private Collection $produtos;

    public function __construct()
    {
        $this->produtos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    /** @return Collection<int, Produto> */
    public function getProdutos(): Collection
    {
        return $this->produtos;
    }
}