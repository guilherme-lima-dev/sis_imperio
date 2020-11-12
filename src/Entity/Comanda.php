<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Comanda
 *
 * @ORM\Table(name="comanda", indexes={@ORM\Index(name="fk_comanda_estabelecimento1_idx", columns={"estabelecimento_idestabelecimento"}), @ORM\Index(name="fk_comanda_cliente1_idx", columns={"cliente_idcliente"}), @ORM\Index(name="fk_comanda_funcionario1_idx", columns={"funcionario_idfuncionarios"})})
 * @ORM\Entity
 */
class Comanda
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcomanda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcomanda;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_idcliente", referencedColumnName="idcliente")
     * })
     */
    private $clienteIdcliente;

    /**
     * @var \Estabelecimento
     *
     * @ORM\ManyToOne(targetEntity="Estabelecimento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estabelecimento_idestabelecimento", referencedColumnName="idestabelecimento")
     * })
     */
    private $estabelecimentoIdestabelecimento;

    /**
     * @var \Funcionario
     *
     * @ORM\ManyToOne(targetEntity="Funcionario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="funcionario_idfuncionarios", referencedColumnName="idfuncionarios")
     * })
     */
    private $funcionarioIdfuncionarios;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ItemComanda", inversedBy="comandaIdcomanda")
     * @ORM\JoinTable(name="comanda_has_item_comanda",
     *   joinColumns={
     *     @ORM\JoinColumn(name="comanda_idcomanda", referencedColumnName="idcomanda")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="item_comanda_iditem_comanda", referencedColumnName="iditem_comanda")
     *   }
     * )
     */
    private $itemComandaIditemComanda;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->itemComandaIditemComanda = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdcomanda(): ?int
    {
        return $this->idcomanda;
    }

    public function getClienteIdcliente(): ?Cliente
    {
        return $this->clienteIdcliente;
    }

    public function setClienteIdcliente(?Cliente $clienteIdcliente): self
    {
        $this->clienteIdcliente = $clienteIdcliente;

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

    public function getFuncionarioIdfuncionarios(): ?Funcionario
    {
        return $this->funcionarioIdfuncionarios;
    }

    public function setFuncionarioIdfuncionarios(?Funcionario $funcionarioIdfuncionarios): self
    {
        $this->funcionarioIdfuncionarios = $funcionarioIdfuncionarios;

        return $this;
    }

    /**
     * @return Collection|ItemComanda[]
     */
    public function getItemComandaIditemComanda(): Collection
    {
        return $this->itemComandaIditemComanda;
    }

    public function addItemComandaIditemComanda(ItemComanda $itemComandaIditemComanda): self
    {
        if (!$this->itemComandaIditemComanda->contains($itemComandaIditemComanda)) {
            $this->itemComandaIditemComanda[] = $itemComandaIditemComanda;
        }

        return $this;
    }

    public function removeItemComandaIditemComanda(ItemComanda $itemComandaIditemComanda): self
    {
        if ($this->itemComandaIditemComanda->contains($itemComandaIditemComanda)) {
            $this->itemComandaIditemComanda->removeElement($itemComandaIditemComanda);
        }

        return $this;
    }

}
