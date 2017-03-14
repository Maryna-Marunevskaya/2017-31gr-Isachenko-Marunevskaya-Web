<?php
//src/Project/SiteBundle/Entity/Country.php
namespace Project\SiteBundle\Entity;
/**
* @ORM\Entity
* @ORM\Table(name="country")
* @ORM\HasLifecycleCallbacks
*/
class Country
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
    protected $name;
     /**
    * @ORM\OneToMany(targetEntity="City", mappedBy="country")
    */
    protected $cities;
}
