<?php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotNull;

/**
*@ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\PlaceInRouteRepository")
*@ORM\Table(name="placeinroute")
*@ORM\HasLifecycleCallbacks
*/

class PlaceInRoute
{
    /**
    *@ORM\Id
    *@ORM\Column(name="id", type="integer")
    *@ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
     *@ORM\ManyToOne(targetEntity="Place")
     *@ORM\JoinColumn(name="place_id", referencedColumnName="id", nullable=false, unique=false)
     */
    protected $place;

    /**
     *@ORM\ManyToOne(targetEntity="Route", inversedBy="placesInRoute")
     *@ORM\JoinColumn(name="route_id", referencedColumnName="id", nullable=false, unique=false, onDelete="CASCADE")
     */
    protected $route;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('place', new NotNull());
        $metadata->addPropertyConstraint('route', new NotNull());
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
     * Set place
     *
     * @param \Project\SiteBundle\Entity\Place $place
     *
     * @return PlaceInRoute
     */
    public function setPlace(\Project\SiteBundle\Entity\Place $place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return \Project\SiteBundle\Entity\Place
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set route
     *
     * @param \Project\SiteBundle\Entity\Route $route
     *
     * @return PlaceInRoute
     */
    public function setRoute(\Project\SiteBundle\Entity\Route $route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return \Project\SiteBundle\Entity\Route
     */
    public function getRoute()
    {
        return $this->route;
    }
}
