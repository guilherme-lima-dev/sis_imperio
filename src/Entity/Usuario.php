<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="fk_usuario_tipo_usuario1_idx", columns={"tipo_usuario_idtipo_usuario"})})
 * @ORM\Entity
 */
class Usuario implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="idusuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=45, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=255, nullable=false)
     */
    private $senha;

    /**
     * @var \TipoUsuario
     *
     * @ORM\ManyToOne(targetEntity="TipoUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_usuario_idtipo_usuario", referencedColumnName="idtipo_usuario")
     * })
     */
    private $tipoUsuarioIdtipoUsuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Estabelecimento", inversedBy="usuarioIdfuncionario")
     * @ORM\JoinTable(name="usuario_has_estabelecimento",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario_idfuncionario", referencedColumnName="idusuario")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="estabelecimento_idestabelecimento", referencedColumnName="idestabelecimento")
     *   }
     * )
     */
    private $estabelecimentoIdestabelecimento;

    public function __toString()
    {
        return $this->login;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estabelecimentoIdestabelecimento = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdusuario(): ?int
    {
        return $this->idusuario;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function getTipoUsuarioIdtipoUsuario(): ?TipoUsuario
    {
        return $this->tipoUsuarioIdtipoUsuario;
    }

    public function setTipoUsuarioIdtipoUsuario(?TipoUsuario $tipoUsuarioIdtipoUsuario): self
    {
        $this->tipoUsuarioIdtipoUsuario = $tipoUsuarioIdtipoUsuario;

        return $this;
    }

    /**
     * @return Collection|Estabelecimento[]
     */
    public function getEstabelecimentoIdestabelecimento(): Collection
    {
        return $this->estabelecimentoIdestabelecimento;
    }

    public function addEstabelecimentoIdestabelecimento(Estabelecimento $estabelecimentoIdestabelecimento): self
    {
        if (!$this->estabelecimentoIdestabelecimento->contains($estabelecimentoIdestabelecimento)) {
            $this->estabelecimentoIdestabelecimento[] = $estabelecimentoIdestabelecimento;
        }

        return $this;
    }

    public function removeEstabelecimentoIdestabelecimento(Estabelecimento $estabelecimentoIdestabelecimento): self
    {
        if ($this->estabelecimentoIdestabelecimento->contains($estabelecimentoIdestabelecimento)) {
            $this->estabelecimentoIdestabelecimento->removeElement($estabelecimentoIdestabelecimento);
        }

        return $this;
    }

    public function getRoles()
    {
        return !$this->roles ? [] : explode(',', $this->roles);
    }

    public function setRoles($roles):Usuario
    {
        $this->roles = implode(',' , $roles);
        return $this;
    }

    public function getPassword()
    {
        return $this->getSenha();
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->getLogin();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
