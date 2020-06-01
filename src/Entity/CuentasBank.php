<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CuentasBankRepository")
 */
class CuentasBank
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="cuentasBanks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_cliente;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $num_tarjeta;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $ultimos_digitos;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titular;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $fecha_caducidad;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cvv;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pedidos", mappedBy="tarjeta_id")
     */
    private $pedidos;

    public function __construct()
    {
        $this->pedidos = new ArrayCollection();
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

    public function getNumTarjeta(): ?string
    {
        return $this->num_tarjeta;
    }

    public function setNumTarjeta(string $num_tarjeta): self
    {
        $this->num_tarjeta = $num_tarjeta;

        return $this;
    }

    public function getUltimosDigitos(): ?int
    {
        return $this->ultimos_digitos;
    }

    public function setUltimosDigitos(int $ultimos_digitos): self
    {
        $this->ultimos_digitos = $ultimos_digitos;

        return $this;
    }

    public function getTitular(): ?string
    {
        return $this->titular;
    }

    public function setTitular(string $titular): self
    {
        $this->titular = $titular;

        return $this;
    }

    public function getFechaCaducidad(): ?string
    {
        return $this->fecha_caducidad;
    }

    public function setFechaCaducidad(string $fecha_caducidad): self
    {
        $this->fecha_caducidad = $fecha_caducidad;

        return $this;
    }

    public function getCvv(): ?string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): self
    {
        $this->cvv = $cvv;

        return $this;
    }

    /**
     * @return Collection|Pedidos[]
     */
    public function getPedidos(): Collection
    {
        return $this->pedidos;
    }

    public function addPedido(Pedidos $pedido): self
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos[] = $pedido;
            $pedido->setTarjetaId($this);
        }

        return $this;
    }

    public function removePedido(Pedidos $pedido): self
    {
        if ($this->pedidos->contains($pedido)) {
            $this->pedidos->removeElement($pedido);
            // set the owning side to null (unless already changed)
            if ($pedido->getTarjetaId() === $this) {
                $pedido->setTarjetaId(null);
            }
        }

        return $this;
    }

}
