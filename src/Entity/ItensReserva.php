<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ItensReserva
 *
 * @ORM\Table(name="itens_reserva")
 * @ORM\Entity
 */
class ItensReserva
{
    /**
     * @var int
     *
     * @ORM\Column(name="iditens_reserva", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iditensReserva;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var float
     *
     * @ORM\Column(name="preco", type="float", precision=10, scale=0, nullable=false)
     */
    private $preco;

    /**
     * @var int
     *
     * @ORM\Column(name="tempo", type="integer", nullable=false)
     */
    private $tempo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Reserva", mappedBy="itensReservaIditensReserva")
     */
    private $reservaIdreserva;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservaIdreserva = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIditensReserva(): ?int
    {
        return $this->iditensReserva;
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

    public function getPreco(): ?float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): self
    {
        $this->preco = $preco;

        return $this;
    }

    public function getTempo(): ?int
    {
        return $this->tempo;
    }

    public function setTempo(int $tempo): self
    {
        $this->tempo = $tempo;

        return $this;
    }

    /**
     * @return Collection|Reserva[]
     */
    public function getReservaIdreserva(): Collection
    {
        return $this->reservaIdreserva;
    }

    public function addReservaIdreserva(Reserva $reservaIdreserva): self
    {
        if (!$this->reservaIdreserva->contains($reservaIdreserva)) {
            $this->reservaIdreserva[] = $reservaIdreserva;
            $reservaIdreserva->addItensReservaIditensReserva($this);
        }

        return $this;
    }

    public function removeReservaIdreserva(Reserva $reservaIdreserva): self
    {
        if ($this->reservaIdreserva->contains($reservaIdreserva)) {
            $this->reservaIdreserva->removeElement($reservaIdreserva);
            $reservaIdreserva->removeItensReservaIditensReserva($this);
        }

        return $this;
    }

}
