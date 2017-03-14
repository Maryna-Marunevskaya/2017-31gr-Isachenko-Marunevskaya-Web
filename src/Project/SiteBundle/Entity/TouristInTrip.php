<?php
//src/Project/SiteBundle/Entity/TouristInTrip.php
namespace Project\SiteBundle\Entity;
/**
* @ORM\Entity
* @ORM\Table(name="touristintrip")
* @ORM\HasLifecycleCallbacks
*/
class TouristInTrip
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer", name="id")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $tourist;
     /**
     * @ORM\ManyToOne(targetEntity="Trip", inversedBy="touristsintrip")
     * @ORM\JoinColumn(name="trip_id", referencedColumnName="id", nullable=false)
     */
    protected $trip;
}
