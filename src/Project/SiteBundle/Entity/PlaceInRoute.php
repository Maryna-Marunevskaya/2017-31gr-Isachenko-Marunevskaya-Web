<?php
//src/Project/SiteBundle/Entity/PlaceInRoute.php
namespace Project\SiteBundle\Entity;
/**
* @ORM\Entity
* @ORM\Table(name="placeinroute")
* @ORM\HasLifecycleCallbacks
*/
class PlaceInRoute
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer", name="id")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
     * @OneToOne(targetEntity="Place")
     * @JoinColumn(name="place_id", referencedColumnName="id", nullable=false)
     */
    protected $place;
    /**
    * @ORM\Column(type="string", nullable=false)
    **/
    protected $placeType;
     /**
     * @ORM\ManyToOne(targetEntity="Route", inversedBy="placesinroute")
     * @ORM\JoinColumn(name="route_id", referencedColumnName="id", nullable=false)
     */
    protected $route;

}
