<?php

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Admin\MesajRepository")
 */
class Mesaj
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $konu;

    /**
     * @ORM\Column(type="text")
     */
    private $mesaj;

    /**
     * @ORM\Column(type="string",  length=12)
     */
    private $phone;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getKonu(): ?string
    {
        return $this->konu;
    }

    public function setKonu(string $konu): self
    {
        $this->konu = $konu;

        return $this;
    }

    public function getMesaj(): ?string
    {
        return $this->mesaj;
    }

    public function setMesaj(string $mesaj): self
    {
        $this->mesaj = $mesaj;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
