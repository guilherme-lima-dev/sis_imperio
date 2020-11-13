<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Estabelecimento
 *
 * @ORM\Table(name="estabelecimento", indexes={@ORM\Index(name="fk_estabelecimento_tipo_estabelecimento_idx", columns={"tipo_estabelecimento_idtipo_estabelecimento"}), @ORM\Index(name="fk_estabelecimento_estoque1_idx", columns={"estoque_idestoque"})})
 * @ORM\Entity
 */
class Estabelecimento
{
    /**
     * @var int
     *
     * @ORM\Column(name="idestabelecimento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idestabelecimento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_estabelecimento", type="string", length=45, nullable=false)
     */
    private $nomeEstabelecimento;

    /**
     * @var \Estoque
     *
     * @ORM\ManyToOne(targetEntity="Estoque")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estoque_idestoque", referencedColumnName="idestoque")
     * })
     */
    private $estoqueIdestoque;

    /**
     * @var \TipoEstabelecimento
     *
     * @ORM\ManyToOne(targetEntity="TipoEstabelecimento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_estabelecimento_idtipo_estabelecimento", referencedColumnName="idtipo_estabelecimento")
     * })
     */
    private $tipoEstabelecimentoIdtipoEstabelecimento;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="estabelecimentoIdestabelecimento")
     */
    private $usuarioIdfuncionario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarioIdfuncionario = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdestabelecimento(): ?int
    {
        return $this->idestabelecimento;
    }

    public function getNomeEstabelecimento(): ?string
    {
        return $this->nomeEstabelecimento;
    }

    public function setNomeEstabelecimento(string $nomeEstabelecimento): self
    {
        $this->nomeEstabelecimento = $nomeEstabelecimento;

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

    public function getTipoEstabelecimentoIdtipoEstabelecimento(): ?TipoEstabelecimento
    {
        return $this->tipoEstabelecimentoIdtipoEstabelecimento;
    }

    public function setTipoEstabelecimentoIdtipoEstabelecimento(?TipoEstabelecimento $tipoEstabelecimentoIdtipoEstabelecimento): self
    {
        $this->tipoEstabelecimentoIdtipoEstabelecimento = $tipoEstabelecimentoIdtipoEstabelecimento;

        return $this;
    }

    /**
     * @return Collection|Usuario[]
     */
    public function getUsuarioIdfuncionario(): Collection
    {
        return $this->usuarioIdfuncionario;
    }

    public function addUsuarioIdfuncionario(Usuario $usuarioIdfuncionario): self
    {
        if (!$this->usuarioIdfuncionario->contains($usuarioIdfuncionario)) {
            $this->usuarioIdfuncionario[] = $usuarioIdfuncionario;
            $usuarioIdfuncionario->addEstabelecimentoIdestabelecimento($this);
        }

        return $this;
    }

    public function removeUsuarioIdfuncionario(Usuario $usuarioIdfuncionario): self
    {
        if ($this->usuarioIdfuncionario->contains($usuarioIdfuncionario)) {
            $this->usuarioIdfuncionario->removeElement($usuarioIdfuncionario);
            $usuarioIdfuncionario->removeEstabelecimentoIdestabelecimento($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNomeEstabelecimento();
    }
}
