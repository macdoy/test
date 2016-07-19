<?php

namespace Potogan\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Potogan\TestBundle\Validator\Constraints as AcmeAssert;

/**
* User
* @ORM\Entity
* @ORM\Table(name="user")
* @UniqueEntity("email", message="This email is already in used.")
* @UniqueEntity("pseudo", message="This pseudo is already in used.")
*/
class User extends AbstractType
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    *
    * @var integer
    */
    protected $id;
    /**
    * @ORM\Column(name="prenom", type="string", length=255)
    *
    * @var string
    */
    protected $prenom;
    /**
    * @ORM\Column(name="nom", type="string", length=255)
    *
    * @var string
    */
    protected $nom;
    /**
    * @ORM\Column(name="email", type="string", length=255)
    * @Assert\Email(checkMX="true")
    *
    * @var string
    */
    protected $email;
    /**
    * @ORM\Column(name="mobile", type="string", length=255)
    * @AcmeAssert\Numeric\ContainsNumeric
    *
    * @var string
    */
    protected $mobile;
    /**
    * @ORM\Column(name="pseudo", type="string", length=255, nullable=true)
    *
    * @var string
    */
    protected $pseudo;
    /**
    * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
    * @AcmeAssert\Twitter\ContainsTwitter
    *
    * @var string
    */
    protected $twitter;
    /**
    * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
    * @AcmeAssert\Facebook\ContainsFacebook
    *
    * @var string
    */
    protected $facebook;
    /**
    * @ORM\Column(name="extension", type="string", length=255, nullable=true)
    */
    protected $extension;
    /**
    * @Assert\Image(maxWidth = 420, maxHeight = 420)
    */
    protected $file;

    public function getId()
    {
        return $this->id;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getTwitter()
    {
        return $this->twitter;
    }

    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
        return $this;
    }

    public function getFacebook()
    {
        return $this->facebook;
    }

    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        if ($this->file) {
            $this->extension = $this->file->guessExtension();
        }
    }
}
