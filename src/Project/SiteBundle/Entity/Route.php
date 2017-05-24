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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->placesInRoute = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Route
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Route
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Route
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add placesInRoute
     *
     * @param \Project\SiteBundle\Entity\PlaceInRoute $placesInRoute
     *
     * @return Route
     */
    public function addPlacesInRoute(\Project\SiteBundle\Entity\PlaceInRoute $placesInRoute)
    {
        $this->placesInRoute[] = $placesInRoute;

        return $this;
    }

    /**
     * Remove placesInRoute
     *
     * @param \Project\SiteBundle\Entity\PlaceInRoute $placesInRoute
     */
    public function removePlacesInRoute(\Project\SiteBundle\Entity\PlaceInRoute $placesInRoute)
    {
        $this->placesInRoute->removeElement($placesInRoute);
    }

    /**
     * Get placesInRoute
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlacesInRoute()
    {
        return $this->placesInRoute;
    }
}
