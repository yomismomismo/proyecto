<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PedidosRepository")
 */
class Pedidos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_cliente;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre_cliente;

    /**
     * @ORM\Column(type="integer")
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $provincia;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_pedido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Productoxpedidos", mappedBy="id_pedido")
     */
    private $productoxpedidos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CuentasBank", inversedBy="pedido_tarjeta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_tarjeta;


    public function __construct()
    {
        $this->productoxpedidos = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCliente(): ?usuario
    {
        return $this->id_cliente;
    }

    public function setIdCliente(?usuario $id_cliente): self
    {
        $this->id_cliente = $id_cliente;

        return $this;
    }

    public function getNombreCliente(): ?string
    {
        return $this->nombre_cliente;
    }

    public function setNombreCliente(string $nombre_cliente): self
    {
        $this->nombre_cliente = $nombre_cliente;

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

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

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

    public function getFechaPedido(): ?\DateTimeInterface
    {
        return $this->fecha_pedido;
    }

    public function setFechaPedido(\DateTimeInterface $fecha_pedido): self
    {
        $this->fecha_pedido = $fecha_pedido;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Collection|Productoxpedidos[]
     */
    public function getProductoxpedidos(): Collection
    {
        return $this->productoxpedidos;
    }

    public function addProductoxpedido(Productoxpedidos $productoxpedido): self
    {
        if (!$this->productoxpedidos->contains($productoxpedido)) {
            $this->productoxpedidos[] = $productoxpedido;
            $productoxpedido->setIdPedido($this);
        }

        return $this;
    }

    public function removeProductoxpedido(Productoxpedidos $productoxpedido): self
    {
        if ($this->productoxpedidos->contains($productoxpedido)) {
            $this->productoxpedidos->removeElement($productoxpedido);
            // set the owning side to null (unless already changed)
            if ($productoxpedido->getIdPedido() === $this) {
                $productoxpedido->setIdPedido(null);
            }
        }

        return $this;
    }



    public function getIdTarjeta(): ?cuentasBank
    {
        return $this->id_tarjeta;
    }

    public function setIdTarjeta(?cuentasBank $id_tarjeta): self
    {
        $this->id_tarjeta = $id_tarjeta;

        return $this;
    }

}
