<?php
//src/Project/SiteBundle/Entity/Trip.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\TripRepository")
* @ORM\Table(name="trip")
* @ORM\HasLifecycleCallbacks
*/
class Trip
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
     * @ORM\OneToOne(targetEntity="Route")
     * @ORM\JoinColumn(name="route_id", referencedColumnName="id", nullable=false)
     */
    protected $route;
    /**
    * @ORM\Column(name="startdate", type="datetime", nullable=false)
    **/
    protected $startDate;
    /**
    * @ORM\Column(name="finishdate", type="datetime", nullable=false)
    **/
    protected $finishDate;
    /**
    * @ORM\Column(name="maxnumoftourists", type="integer", nullable=false)
    **/
    protected $maxNumOfTourists;
    /**
    * @ORM\Column(name="description", type="text", nullable=false)
    **/
    protected $description;
    /**
    * @ORM\Column(name="image", type="string", nullable=false)
    **/
    protected $image;
    /**
    * @ORM\OneToMany(targetEntity="TouristInTrip", mappedBy="trip")
    */
    protected $touristsInTrip;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->touristsInTrip = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Trip
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set finishDate
     *
     * @param \DateTime $finishDate
     *
     * @return Trip
     */
    public function setFinishDate($finishDate)
    {
        $this->finishDate = $finishDate;

        return $this;
    }

    /**
     * Get finishDate
     *
     * @return \DateTime
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * Set maxNumOfTourists
     *
     * @param integer $maxNumOfTourists
     *
     * @return Trip
     */
    public function setMaxNumOfTourists($maxNumOfTourists)
    {
        $this->maxNumOfTourists = $maxNumOfTourists;

        return $this;
    }

    /**
     * Get maxNumOfTourists
     *
     * @return integer
     */
    public function getMaxNumOfTourists()
    {
        return $this->maxNumOfTourists;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Trip
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
     * Set route
     *
     * @param \Project\SiteBundle\Entity\Route $route
     *
     * @return Trip
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

    /**
     * Add touristsInTrip
     *
     * @param \Project\SiteBundle\Entity\TouristInTrip $touristsInTrip
     *
     * @return Trip
     */
    public function addTouristsInTrip(\Project\SiteBundle\Entity\TouristInTrip $touristsInTrip)
    {
        $this->touristsInTrip[] = $touristsInTrip;

        return $this;
    }

    /**
     * Remove touristsInTrip
     *
     * @param \Project\SiteBundle\Entity\TouristInTrip $touristsInTrip
     */
    public function removeTouristsInTrip(\Project\SiteBundle\Entity\TouristInTrip $touristsInTrip)
    {
        $this->touristsInTrip->removeElement($touristsInTrip);
    }

    /**
     * Get touristsInTrip
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTouristsInTrip()
    {
        return $this->touristsInTrip;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Trip
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
}
