<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductoxpedidosRepository")
 */
class Productoxpedidos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Producto", inversedBy="productoxpedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_producto;


    /**
     * @ORM\Column(type="integer")
     */
    private $cantidad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pedidos", inversedBy="productoxpedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_pedido;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProducto(): ?producto
    {
        return $this->id_producto;
    }

    public function setIdProducto(?producto $id_producto): self
    {
        $this->id_producto = $id_producto;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getIdPedido(): ?pedidos
    {
        return $this->id_pedido;
    }

    public function setIdPedido(?pedidos $id_pedido): self
    {
        $this->id_pedido = $id_pedido;

        return $this;
    }
}
