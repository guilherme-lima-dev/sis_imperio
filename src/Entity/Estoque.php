<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estoque
 *
 * @ORM\Table(name="estoque")
 * @ORM\Entity
 */
class Estoque
{
    /**
     * @var int
     *
     * @ORM\Column(name="idestoque", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idestoque;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_estoque", type="string", length=45, nullable=false)
     */
    private $nomeEstoque;

    public function getIdestoque(): ?int
    {
        return $this->idestoque;
    }

    public function getNomeEstoque(): ?string
    {
        return $this->nomeEstoque;
    }

    public function setNomeEstoque(string $nomeEstoque): self
    {
        $this->nomeEstoque = $nomeEstoque;

        return $this;
    }
    public function __toString()
    {
        return $this->getNomeEstoque();
    }

}
