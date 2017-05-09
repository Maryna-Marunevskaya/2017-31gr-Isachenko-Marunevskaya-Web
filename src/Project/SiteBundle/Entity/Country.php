<?php
//src/Project/SiteBundle/Entity/Country.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="country")
* @ORM\HasLifecycleCallbacks
*/
class Country
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
    * @ORM\Column(name="name",type="string", unique=true, nullable=false)
    **/
    protected $name;
     /**
    * @ORM\OneToMany(targetEntity="City", mappedBy="country")
    */
    protected $cities;
    /**
    * @ORM\Column(name="image",type="string", nullable=false)
    **/
    protected $image;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Country
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
     * Set image
     *
     * @param string $image
     *
     * @return Country
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
     * Add city
     *
     * @param \Project\SiteBundle\Entity\City $city
     *
     * @return Country
     */
    public function addCity(\Project\SiteBundle\Entity\City $city)
    {
        $this->cities[] = $city;

        return $this;
    }

    /**
     * Remove city
     *
     * @param \Project\SiteBundle\Entity\City $city
     */
    public function removeCity(\Project\SiteBundle\Entity\City $city)
    {
        $this->cities->removeElement($city);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }
}
