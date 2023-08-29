<?php

namespace App\Entity;

use App\Repository\TipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoRepository::class)
 */
class Tipo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Proveedor::class, mappedBy="tipo", orphanRemoval=true)
     */
    private $proveedores;

    public function __construct()
    {
        $this->proveedores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Proveedor>
     */
    public function getProveedores(): Collection
    {
        return $this->proveedores;
    }

    public function addProveedores(Proveedor $proveedor): self
    {
        if (!$this->proveedores->contains($proveedor)) {
            $this->proveedores[] = $proveedor;
            $proveedor->setTipo($this);
        }

        return $this;
    }

    public function removeProveedores(Proveedor $proveedor): self
    {
        if ($this->proveedores->removeElement($proveedor)) {
            // set the owning side to null (unless already changed)
            if ($proveedor->getTipo() === $this) {
                $proveedor->setTipo(null);
            }
        }

        return $this;
    }
}
