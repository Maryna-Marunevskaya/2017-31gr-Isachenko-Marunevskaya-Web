<?php
//src/Project/SiteBundle/Entity/Route.php
namespace Project\SiteBundle\Entity;
/**
* @ORM\Entity
* @ORM\Table(name="route")
* @ORM\HasLifecycleCallbacks
*/
class Route
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
    * @ORM\OneToMany(targetEntity="PlaceInRoute", mappedBy="route")
    */
    protected $placesInRoute;
}
