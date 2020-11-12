<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoUsuario
 *
 * @ORM\Table(name="tipo_usuario")
 * @ORM\Entity
 */
class TipoUsuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtipo_usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipoUsuario;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tipoUsuario", type="string", length=45, nullable=true, options={"default"="NULL"})
     */
    private $tipousuario = 'NULL';

    public function getIdtipoUsuario(): ?int
    {
        return $this->idtipoUsuario;
    }

    public function getTipousuario(): ?string
    {
        return $this->tipousuario;
    }

    public function setTipousuario(?string $tipousuario): self
    {
        $this->tipousuario = $tipousuario;

        return $this;
    }
    public function __toString()
    {
        return $this->getTipousuario();
    }

}
