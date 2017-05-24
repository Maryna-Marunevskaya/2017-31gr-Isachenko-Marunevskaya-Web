<?php
//src/Project/SiteBundle/Entity/Letter.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

/**
* @ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\LetterRepository")
* @ORM\Table(name="letter")
* @ORM\HasLifecycleCallbacks
*/

class Letter
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
    * @ORM\Column(name="fullname", type="string", nullable=false);
    **/
    protected $fullname;
    /**
    * @ORM\Column(name="phone", type="string", nullable=false);
    **/
    protected $phone;
    /**
    * @ORM\Column(name="email", type="string", nullable=false);
    **/
    protected $email;
    /**
    * @ORM\Column(name="theme", type="string", nullable=false);
    **/
    protected $theme;
    /**
    * @ORM\Column(name="content", type="text", nullable=false);
    **/
    protected $content;
      /**
    * @ORM\Column(name="created", type="datetime", nullable=false);
    **/
    protected $created;

         public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('fullname', new NotBlank());
        $metadata->addPropertyConstraint('phone', new NotBlank());
        $metadata->addPropertyConstraint('email', new Email());
        $metadata->addPropertyConstraint('theme', new NotBlank());
        $metadata->addPropertyConstraint('content', new NotBlank());
     }
}
