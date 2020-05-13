<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_Registro;

    /**
     * @ORM\Column(type="integer")
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $provincia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contrasenya;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pedidos", mappedBy="id_cliente")
     */
    private $pedidosRL;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comentario", mappedBy="id_usuario")
     */
    private $comentarioUsuRL;

    /**
     * @ORM\Column(type="integer")
     */
    private $cod_postal;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $apellido;

    public function __construct()
    {
        $this->pedidosRL = new ArrayCollection();
        $this->comentarioUsuRL = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFechaRegistro(): ?\DateTimeInterface
    {
        return $this->fecha_Registro;
    }

    public function setFechaRegistro(\DateTimeInterface $fecha_Registro): self
    {
        $this->fecha_Registro = $fecha_Registro;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getContrasenya(): ?string
    {
        return $this->contrasenya;
    }

    public function setContrasenya(string $contrasenya): self
    {
        $this->contrasenya = $contrasenya;

        return $this;
    }

    /**
     * @return Collection|Pedidos[]
     */
    public function getPedidosRL(): Collection
    {
        return $this->pedidosRL;
    }

    public function addPedidosRL(Pedidos $pedidosRL): self
    {
        if (!$this->pedidosRL->contains($pedidosRL)) {
            $this->pedidosRL[] = $pedidosRL;
            $pedidosRL->setIdCliente($this);
        }

        return $this;
    }

    public function removePedidosRL(Pedidos $pedidosRL): self
    {
        if ($this->pedidosRL->contains($pedidosRL)) {
            $this->pedidosRL->removeElement($pedidosRL);
            // set the owning side to null (unless already changed)
            if ($pedidosRL->getIdCliente() === $this) {
                $pedidosRL->setIdCliente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comentario[]
     */
    public function getComentarioUsuRL(): Collection
    {
        return $this->comentarioUsuRL;
    }

    public function addComentarioUsuRL(Comentario $comentarioUsuRL): self
    {
        if (!$this->comentarioUsuRL->contains($comentarioUsuRL)) {
            $this->comentarioUsuRL[] = $comentarioUsuRL;
            $comentarioUsuRL->setIdUsuario($this);
        }

        return $this;
    }

    public function removeComentarioUsuRL(Comentario $comentarioUsuRL): self
    {
        if ($this->comentarioUsuRL->contains($comentarioUsuRL)) {
            $this->comentarioUsuRL->removeElement($comentarioUsuRL);
            // set the owning side to null (unless already changed)
            if ($comentarioUsuRL->getIdUsuario() === $this) {
                $comentarioUsuRL->setIdUsuario(null);
            }
        }

        return $this;
    }

    public function getCodPostal(): ?int
    {
        return $this->cod_postal;
    }

    public function setCodPostal(int $cod_postal): self
    {
        $this->cod_postal = $cod_postal;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }
    public function __toString()
    {
         return $this->getId();
    
    }
}
