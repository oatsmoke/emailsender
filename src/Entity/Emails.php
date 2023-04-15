<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emails
 *
 * @ORM\Table(name="emails")
 * @ORM\Entity
 */
class Emails
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="checked", type="boolean", nullable=false)
     */
    private $checked = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="valid", type="boolean", nullable=false)
     */
    private $valid = '0';

    public function getId(): ?int
    {
        return $this->id;
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

    public function isChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }

    public function isValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }


}
