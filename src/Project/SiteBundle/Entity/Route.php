<?php
//src/Project/SiteBundle/Entity/Route.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\RouteRepository")
* @ORM\Table(name="route")
* @ORM\HasLifecycleCallbacks
*/
class Route
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
    * @ORM\Column(name="name", type="string", unique=true, nullable=false)
    **/
    protected $name;
    /**
    * @ORM\Column(name="description", type="text", nullable=false)
    **/
    protected $description;
    /**
    * @ORM\Column(name="image", type="string", nullable=false)
    **/
    protected $image;
    /**
    * @ORM\OneToMany(targetEntity="PlaceInRoute", mappedBy="route")
    */
    protected $placesInRoute;
}
