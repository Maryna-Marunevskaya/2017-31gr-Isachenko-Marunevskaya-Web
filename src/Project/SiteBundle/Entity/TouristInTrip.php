<?php
namespace Project\SiteBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotNull;

/**
*@ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\TouristInTripRepository")
*@ORM\Table(name="touristintrip")
*@ORM\HasLifecycleCallbacks
*@UniqueEntity(
*     fields={"tourist","trip"},
*     message="Турист уже присоединился к данной поездке."
*)
**/

class TouristInTrip
{
    /**
    *@ORM\Id
    *@ORM\Column(name="id", type="integer")
    *@ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
    *@ORM\ManyToOne(targetEntity="User", inversedBy="trips")
    *@ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
    **/
    protected $tourist;

    /**
    *@ORM\ManyToOne(targetEntity="Trip", inversedBy="touristsInTrip")
    *@ORM\JoinColumn(name="trip_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
    **/
    protected $trip;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('tourist', new NotNull());
		$metadata->addPropertyConstraint('trip', new NotNull());
    }

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
