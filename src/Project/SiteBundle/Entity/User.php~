<?php
//src/Project/SiteBundle/Entity/User.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
* @ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\UserRepository")
* @ORM\Table(name="user")
* @ORM\HasLifecycleCallbacks
* @UniqueEntity(
*     fields={"login"},
*     message="Логин должен быть уникальным."
* )
*/
class User
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
    * @ORM\Column(name="login", type="string", unique=true, nullable=false)
    **/
    protected $login;
    /**
    * @ORM\Column(name="password", type="string", nullable=false)
    **/
    protected $password;
    /**
    * @ORM\Column(name="role", type="string", nullable=false)
    **/
    protected $role;
    /**
    * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
    */
	protected $comments;
    /**
    * @ORM\OneToMany(targetEntity="TouristInTrip", mappedBy="tourist")
    */
    protected $trips;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('login', new NotBlank());
        $metadata->addPropertyConstraint('password', new NotBlank());
        $metadata->addPropertyConstraint('role', new NotBlank());
     }
}
