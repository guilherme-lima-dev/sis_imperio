<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente", indexes={@ORM\Index(name="fk_cliente_estabelecimento1_idx", columns={"estabelecimento_idestabelecimento"})})
 * @ORM\Entity
 */
class Cliente
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcliente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcliente;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=11, nullable=false)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var \Estabelecimento
     *
     * @ORM\ManyToOne(targetEntity="Estabelecimento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estabelecimento_idestabelecimento", referencedColumnName="idestabelecimento")
     * })
     */
    private $estabelecimentoIdestabelecimento;

    public function getIdcliente(): ?int
    {
        return $this->idcliente;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEstabelecimentoIdestabelecimento(): ?Estabelecimento
    {
        return $this->estabelecimentoIdestabelecimento;
    }

    public function setEstabelecimentoIdestabelecimento(?Estabelecimento $estabelecimentoIdestabelecimento): self
    {
        $this->estabelecimentoIdestabelecimento = $estabelecimentoIdestabelecimento;

        return $this;
    }


}
