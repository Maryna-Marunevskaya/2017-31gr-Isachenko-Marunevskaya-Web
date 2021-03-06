<?php
//src/Project/SiteBundle/Entity/PlaceInRoute.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\PlaceInRouteRepository")
* @ORM\Table(name="placeinroute")
* @ORM\HasLifecycleCallbacks
*/
class PlaceInRoute
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
     * @ORM\OneToOne(targetEntity="Place")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id", nullable=false)
     */
    protected $place;
    /**
    * @ORM\Column(name="placetype", type="string", nullable=false)
    **/
    protected $placeType;
     /**
     * @ORM\ManyToOne(targetEntity="Route", inversedBy="placesinroute")
     * @ORM\JoinColumn(name="route_id", referencedColumnName="id", nullable=false)
     */
    protected $route;

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
     * Set placeType
     *
     * @param string $placeType
     *
     * @return PlaceInRoute
     */
    public function setPlaceType($placeType)
    {
        $this->placeType = $placeType;

        return $this;
    }

    /**
     * Get placeType
     *
     * @return string
     */
    public function getPlaceType()
    {
        return $this->placeType;
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
