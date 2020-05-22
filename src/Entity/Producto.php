<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductoRepository")
 */
class Producto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoria", inversedBy="productos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagen;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $unidades_stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $unidades_vendidas;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comentario", mappedBy="id_producto")
     */
    private $comentarios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Productoxpedidos", mappedBy="id_producto")
     */
    private $productoxpedidos;

    public function __construct()
    {
        $this->productoxpedidos = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoriaId(): ?categoria
    {
        return $this->categoria_id;
    }

    public function setCategoriaId(?categoria $categoria_id): self
    {
        $this->categoria_id = $categoria_id;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUnidadesStock(): ?int
    {
        return $this->unidades_stock;
    }

    public function setUnidadesStock(int $unidades_stock): self
    {
        $this->unidades_stock = $unidades_stock;

        return $this;
    }

    public function getUnidadesVendidas(): ?int
    {
        return $this->unidades_vendidas;
    }

    public function setUnidadesVendidas(int $unidades_vendidas): self
    {
        $this->unidades_vendidas = $unidades_vendidas;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * @return Collection|Comentario[]
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios[] = $comentario;
            $comentario->setIdProducto($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->contains($comentario)) {
            $this->comentarios->removeElement($comentario);
            // set the owning side to null (unless already changed)
            if ($comentario->getIdProducto() === $this) {
                $comentario->setIdProducto(null);
            }
        }

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
            $productoxpedido->setIdProducto($this);
        }

        return $this;
    }

    public function removeProductoxpedido(Productoxpedidos $productoxpedido): self
    {
        if ($this->productoxpedidos->contains($productoxpedido)) {
            $this->productoxpedidos->removeElement($productoxpedido);
            // set the owning side to null (unless already changed)
            if ($productoxpedido->getIdProducto() === $this) {
                $productoxpedido->setIdProducto(null);
            }
        }

        return $this;
    }

}
