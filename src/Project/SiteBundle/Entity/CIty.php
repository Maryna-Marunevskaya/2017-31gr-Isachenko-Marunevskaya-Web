<?php
//src/Project/SiteBundle/Entity/City.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
**/
class City extends Place
{
    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     */
    protected $country;
     /**
    * @ORM\OneToMany(targetEntity="Place", mappedBy="city")
    */
	protected $sights;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sights = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return City
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
     * @return City
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
     * Set country
     *
     * @param \Project\SiteBundle\Entity\Country $country
     *
     * @return City
     */
    public function setCountry(\Project\SiteBundle\Entity\Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Project\SiteBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add sight
     *
     * @param \Project\SiteBundle\Entity\Sight $sight
     *
     * @return City
     */
    public function addSight(\Project\SiteBundle\Entity\Sight $sight)
    {
        $this->sights[] = $sight;

        return $this;
    }

    /**
     * Remove sight
     *
     * @param \Project\SiteBundle\Entity\Sight $sight
     */
    public function removeSight(\Project\SiteBundle\Entity\Sight $sight)
    {
        $this->sights->removeElement($sight);
    }

    /**
     * Get sights
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSights()
    {
        return $this->sights;
    }

    /**
     * Add sigt
     *
     * @param \Project\SiteBundle\Entity\Place $sigt
     *
     * @return City
     */
    public function addSigt(\Project\SiteBundle\Entity\Place $sigt)
    {
        $this->sigts[] = $sigt;

        return $this;
    }

    /**
     * Remove sigt
     *
     * @param \Project\SiteBundle\Entity\Place $sigt
     */
    public function removeSigt(\Project\SiteBundle\Entity\Place $sigt)
    {
        $this->sigts->removeElement($sigt);
    }

    /**
     * Get sigts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSigts()
    {
        return $this->sigts;
    }
}
