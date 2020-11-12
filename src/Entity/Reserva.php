<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reserva
 *
 * @ORM\Table(name="reserva", indexes={@ORM\Index(name="fk_reserva_estabelecimento1_idx", columns={"estabelecimento_idestabelecimento"})})
 * @ORM\Entity
 */
class Reserva
{
    /**
     * @var int
     *
     * @ORM\Column(name="idreserva", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreserva;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ItensReserva", inversedBy="reservaIdreserva")
     * @ORM\JoinTable(name="reserva_has_itens_reserva",
     *   joinColumns={
     *     @ORM\JoinColumn(name="reserva_idreserva", referencedColumnName="idreserva")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="itens_reserva_iditens_reserva", referencedColumnName="iditens_reserva")
     *   }
     * )
     */
    private $itensReservaIditensReserva;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->itensReservaIditensReserva = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdreserva(): ?int
    {
        return $this->idreserva;
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

    /**
     * @return Collection|ItensReserva[]
     */
    public function getItensReservaIditensReserva(): Collection
    {
        return $this->itensReservaIditensReserva;
    }

    public function addItensReservaIditensReserva(ItensReserva $itensReservaIditensReserva): self
    {
        if (!$this->itensReservaIditensReserva->contains($itensReservaIditensReserva)) {
            $this->itensReservaIditensReserva[] = $itensReservaIditensReserva;
        }

        return $this;
    }

    public function removeItensReservaIditensReserva(ItensReserva $itensReservaIditensReserva): self
    {
        if ($this->itensReservaIditensReserva->contains($itensReservaIditensReserva)) {
            $this->itensReservaIditensReserva->removeElement($itensReservaIditensReserva);
        }

        return $this;
    }

}
