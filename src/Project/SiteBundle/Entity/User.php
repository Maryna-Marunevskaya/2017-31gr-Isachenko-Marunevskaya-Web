<?php
//src/Project/SiteBundle/Entity/User.php
namespace Project\SiteBundle\Entity;

/**
* @ORM\Entity
* @ORM\Table(name="user")
* @ORM\HasLifecycleCallbacks
*/
class User
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer", name="id")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
    * @ORM\Column(type="string", unique=true, nullable=false)
    **/
    protected $login;
    /**
    * @ORM\Column(type="string", nullable=false)
    **/
    protected $password;
    /**
    * @ORM\Column(type="string", nullable=false)
    **/
    protected $role;
}
