<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Biznes
 *
 * @ORM\Table(name="biznes")
 * @ORM\Entity
 */
class Biznes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="role_id", type="integer", nullable=false)
     */
    private $roleId;

    /**
     * @var string
     *
     * @ORM\Column(name="emer_biznesi", type="string", length=255, nullable=false)
     */
    private $emerBiznesi;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nipt", type="string", length=25, nullable=false)
     */
    private $nipt;

    /**
     * @var string
     *
     * @ORM\Column(name="adresa", type="string", length=255, nullable=false)
     */
    private $adresa;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=false)
     */
    private $logo;

    /**
     * @var integer
     *
     * @ORM\Column(name="numer_telefoni", type="integer", nullable=false)
     */
    private $numerTelefoni;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var boolean
     *
     * @ORM\Column(name="aktiv", type="boolean", nullable=false)
     */
    private $aktiv;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=false)
     */
    private $isDeleted;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="paguar", type="boolean", nullable=false)
     */
    private $paguar;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set roleId
     *
     * @param integer $roleId
     *
     * @return Biznes
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set emerBiznesi
     *
     * @param string $emerBiznesi
     *
     * @return Biznes
     */
    public function setEmerBiznesi($emerBiznesi)
    {
        $this->emerBiznesi = $emerBiznesi;

        return $this;
    }

    /**
     * Get emerBiznesi
     *
     * @return string
     */
    public function getEmerBiznesi()
    {
        return $this->emerBiznesi;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Biznes
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nipt
     *
     * @param string $nipt
     *
     * @return Biznes
     */
    public function setNipt($nipt)
    {
        $this->nipt = $nipt;

        return $this;
    }

    /**
     * Get nipt
     *
     * @return string
     */
    public function getNipt()
    {
        return $this->nipt;
    }

    /**
     * Set adresa
     *
     * @param string $adresa
     *
     * @return Biznes
     */
    public function setAdresa($adresa)
    {
        $this->adresa = $adresa;

        return $this;
    }

    /**
     * Get adresa
     *
     * @return string
     */
    public function getAdresa()
    {
        return $this->adresa;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Biznes
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set numerTelefoni
     *
     * @param integer $numerTelefoni
     *
     * @return Biznes
     */
    public function setNumerTelefoni($numerTelefoni)
    {
        $this->numerTelefoni = $numerTelefoni;

        return $this;
    }

    /**
     * Get numerTelefoni
     *
     * @return integer
     */
    public function getNumerTelefoni()
    {
        return $this->numerTelefoni;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Biznes
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set aktiv
     *
     * @param boolean $aktiv
     *
     * @return Biznes
     */
    public function setAktiv($aktiv)
    {
        $this->aktiv = $aktiv;

        return $this;
    }

    /**
     * Get aktiv
     *
     * @return boolean
     */
    public function getAktiv()
    {
        return $this->aktiv;
    }

    /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return Biznes
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return Biznes
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set paguar
     *
     * @param boolean $paguar
     *
     * @return Biznes
     */
    public function setPaguar($paguar)
    {
        $this->paguar = $paguar;

        return $this;
    }

    /**
     * Get paguar
     *
     * @return boolean
     */
    public function getPaguar()
    {
        return $this->paguar;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
