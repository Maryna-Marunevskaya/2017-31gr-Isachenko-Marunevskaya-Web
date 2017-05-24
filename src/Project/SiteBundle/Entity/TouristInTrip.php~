<?php
//src/Project/SiteBundle/Entity/TouristInTrip.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\TouristInTripRepository")
* @ORM\Table(name="touristintrip")
* @ORM\HasLifecycleCallbacks
*/
class TouristInTrip
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
     /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="trips")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $tourist;
     /**
     * @ORM\ManyToOne(targetEntity="Trip", inversedBy="touristsintrip")
     * @ORM\JoinColumn(name="trip_id", referencedColumnName="id", nullable=false)
     */
    protected $trip;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tourist
     *
     * @param \Project\SiteBundle\Entity\User $tourist
     *
     * @return TouristInTrip
     */
    public function setTourist(\Project\SiteBundle\Entity\User $tourist)
    {
        $this->tourist = $tourist;

        return $this;
    }

    /**
     * Get tourist
     *
     * @return \Project\SiteBundle\Entity\User
     */
    public function getTourist()
    {
        return $this->tourist;
    }

    /**
     * Set trip
     *
     * @param \Project\SiteBundle\Entity\Trip $trip
     *
     * @return TouristInTrip
     */
    public function setTrip(\Project\SiteBundle\Entity\Trip $trip)
    {
        $this->trip = $trip;

        return $this;
    }

    /**
     * Get trip
     *
     * @return \Project\SiteBundle\Entity\Trip
     */
    public function getTrip()
    {
        return $this->trip;
    }
}
