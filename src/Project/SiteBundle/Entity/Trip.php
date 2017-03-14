<?php
//src/Project/SiteBundle/Entity/Trip.php
namespace Project\SiteBundle\Entity;
/**
* @ORM\Entity
* @ORM\Table(name="trip")
* @ORM\HasLifecycleCallbacks
*/
class Trip
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer", name="id")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
     * @OneToOne(targetEntity="Route")
     * @JoinColumn(name="route_id", referencedColumnName="id", nullable=false)
     */
    protected $route;
    /**
    * @ORM\Column(type="datetime", name="startdate", nullable=false)
    **/
    protected $startDate;
    /**
    * @ORM\Column(type="datetime", name="finishdate", nullable=false)
    **/
    protected $finishDate;
    /**
    * @ORM\Column(type="integer", name="finishdate", nullable=false)
    **/
    protected $maxNumOfTourists;
     /**
    * @ORM\OneToMany(targetEntity="TouristInTrip", mappedBy="trip")
    */
    protected $touristsInTrip;

}
