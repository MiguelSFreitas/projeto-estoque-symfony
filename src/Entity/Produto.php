<?php

namespace App\Entity;

use App\Repository\ProdutoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProdutoRepository::class)]
class Produto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: 'O nome do produto é obrigatório.')]
    #[Assert\Length(max: 150)]
    private ?string $nome = null;

    #[ORM\Column(length: 50, unique: true)]
    #[Assert\NotBlank(message: 'O código é obrigatório.')]
    #[Assert\Length(max: 50)]
    private ?string $codigo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descricao = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Assert\NotBlank(message: 'Informe o preço.')]
    #[Assert\PositiveOrZero(message: 'O preço não pode ser negativo.')]
    private ?string $preco = null;

    #[ORM\Column(options: ['default' => 0])]
    #[Assert\PositiveOrZero(message: 'A quantidade não pode ser negativa.')]
    private int $quantidade = 0;

    #[ORM\Column(options: ['default' => 0])]
    #[Assert\PositiveOrZero(message: 'O estoque mínimo não pode ser negativo.')]
    private int $estoqueMinimo = 0;

    #[ORM\Column(options: ['default' => true])]
    private bool $ativo = true;

    #[ORM\Column]
    private ?\DateTimeImmutable $criadoEm = null;

    #[ORM\ManyToOne(inversedBy: 'produtos')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: 'Selecione uma categoria.')]
    private ?Categoria $categoria = null;

    public function __construct()
    {
        $this->criadoEm = new \DateTimeImmutable();
    }

    public function getId(): ?int { return $this->id; }

    public function getNome(): ?string { return $this->nome; }
    public function setNome(string $nome): static { $this->nome = $nome; return $this; }

    public function getCodigo(): ?string { return $this->codigo; }
    public function setCodigo(string $codigo): static { $this->codigo = $codigo; return $this; }

    public function getDescricao(): ?string { return $this->descricao; }
    public function setDescricao(?string $descricao): static { $this->descricao = $descricao; return $this; }

    public function getPreco(): ?string { return $this->preco; }
    public function setPreco(string $preco): static { $this->preco = $preco; return $this; }

    public function getQuantidade(): int { return $this->quantidade; }
    public function setQuantidade(int $quantidade): static { $this->quantidade = $quantidade; return $this; }

    public function getEstoqueMinimo(): int { return $this->estoqueMinimo; }
    public function setEstoqueMinimo(int $estoqueMinimo): static { $this->estoqueMinimo = $estoqueMinimo; return $this; }

    public function isAtivo(): bool { return $this->ativo; }
    public function setAtivo(bool $ativo): static { $this->ativo = $ativo; return $this; }

    public function getCriadoEm(): ?\DateTimeImmutable { return $this->criadoEm; }

    public function getCategoria(): ?Categoria { return $this->categoria; }
    public function setCategoria(?Categoria $categoria): static { $this->categoria = $categoria; return $this; }

    public function isEstoqueBaixo(): bool
    {
        return $this->quantidade <= $this->estoqueMinimo;
    }
}