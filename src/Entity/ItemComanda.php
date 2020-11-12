<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ItemComanda
 *
 * @ORM\Table(name="item_comanda")
 * @ORM\Entity
 */
class ItemComanda
{
    /**
     * @var int
     *
     * @ORM\Column(name="iditem_comanda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iditemComanda;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_item", type="string", length=45, nullable=false)
     */
    private $nomeItem;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Comanda", mappedBy="itemComandaIditemComanda")
     */
    private $comandaIdcomanda;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comandaIdcomanda = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIditemComanda(): ?int
    {
        return $this->iditemComanda;
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

    /**
     * @return Collection|Comanda[]
     */
    public function getComandaIdcomanda(): Collection
    {
        return $this->comandaIdcomanda;
    }

    public function addComandaIdcomanda(Comanda $comandaIdcomanda): self
    {
        if (!$this->comandaIdcomanda->contains($comandaIdcomanda)) {
            $this->comandaIdcomanda[] = $comandaIdcomanda;
            $comandaIdcomanda->addItemComandaIditemComanda($this);
        }

        return $this;
    }

    public function removeComandaIdcomanda(Comanda $comandaIdcomanda): self
    {
        if ($this->comandaIdcomanda->contains($comandaIdcomanda)) {
            $this->comandaIdcomanda->removeElement($comandaIdcomanda);
            $comandaIdcomanda->removeItemComandaIditemComanda($this);
        }

        return $this;
    }

}
