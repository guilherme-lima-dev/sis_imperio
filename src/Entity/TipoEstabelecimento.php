<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoEstabelecimento
 *
 * @ORM\Table(name="tipo_estabelecimento")
 * @ORM\Entity
 */
class TipoEstabelecimento
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtipo_estabelecimento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipoEstabelecimento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tipoEstabelecimento", type="string", length=45, nullable=true, options={"default"="NULL"})
     */
    private $tipoestabelecimento = 'NULL';

    public function getIdtipoEstabelecimento(): ?int
    {
        return $this->idtipoEstabelecimento;
    }

    public function getTipoestabelecimento(): ?string
    {
        return $this->tipoestabelecimento;
    }

    public function setTipoestabelecimento(?string $tipoestabelecimento): self
    {
        $this->tipoestabelecimento = $tipoestabelecimento;

        return $this;
    }
    public function __toString()
    {
        return $this->getTipoestabelecimento();
    }

}
