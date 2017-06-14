<?php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
*@ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\RouteRepository")
*@ORM\Table(name="route")
*@ORM\HasLifecycleCallbacks
*@UniqueEntity(
*   fields={"name"},
*   message="Название маршрута должно быть уникальным."
*)
*/
class Route{
    /**
    *@ORM\Id
    *@ORM\Column(name="id", type="integer")
    *@ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
    *@ORM\Column(name="name", type="string", nullable=false, unique=true)
    **/
    protected $name;

    /**
    *@ORM\Column(name="shortdescription", type="string", nullable=false)
    **/
    protected $shortdescription;

    /**
    *@ORM\Column(name="description", type="text", nullable=false)
    **/
    protected $description;

    /**
    *@ORM\Column(name="image", type="string", nullable=false)
    **/
    protected $image;

    /**
    *@ORM\OneToMany(targetEntity="PlaceInRoute", mappedBy="route")
    */
    protected $placesInRoute;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('shortdescription', new NotBlank());
        $metadata->addPropertyConstraint('description', new NotBlank());
        $metadata->addPropertyConstraint('image', new NotBlank());
    }
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
     * Set shortdescription
     *
     * @param string $shortdescription
     *
     * @return Route
     */
    public function setShortdescription($shortdescription)
    {
        $this->shortdescription = $shortdescription;

        return $this;
    }

    /**
     * Get shortdescription
     *
     * @return string
     */
    public function getShortdescription()
    {
        return $this->shortdescription;
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