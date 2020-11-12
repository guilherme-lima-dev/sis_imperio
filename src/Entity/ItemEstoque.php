<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemEstoque
 *
 * @ORM\Table(name="item_estoque", indexes={@ORM\Index(name="fk_item_estoque_estoque1_idx", columns={"estoque_idestoque"})})
 * @ORM\Entity
 */
class ItemEstoque
{
    /**
     * @var int
     *
     * @ORM\Column(name="iditem_estoque", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iditemEstoque;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_item", type="string", length=45, nullable=false)
     */
    private $nomeItem;

    /**
     * @var float
     *
     * @ORM\Column(name="preco", type="float", precision=10, scale=0, nullable=false)
     */
    private $preco;

    /**
     * @var int
     *
     * @ORM\Column(name="quantidade", type="integer", nullable=false)
     */
    private $quantidade;

    /**
     * @var \Estoque
     *
     * @ORM\ManyToOne(targetEntity="Estoque")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estoque_idestoque", referencedColumnName="idestoque")
     * })
     */
    private $estoqueIdestoque;

    public function getIditemEstoque(): ?int
    {
        return $this->iditemEstoque;
    }

    public function getNomeItem(): ?string
    {
        return $this->nomeItem;
    }

    public function setNomeItem(string $nomeItem): self
    {
        $this->nomeItem = $nomeItem;

        return $this;
    }

    public function getPreco(): ?float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): self
    {
        $this->preco = $preco;

        return $this;
    }

    public function getQuantidade(): ?int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): self
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    public function getEstoqueIdestoque(): ?Estoque
    {
        return $this->estoqueIdestoque;
    }

    public function setEstoqueIdestoque(?Estoque $estoqueIdestoque): self
    {
        $this->estoqueIdestoque = $estoqueIdestoque;

        return $this;
    }


}
