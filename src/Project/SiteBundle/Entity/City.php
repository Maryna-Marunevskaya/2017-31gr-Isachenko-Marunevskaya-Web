<?php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
*@ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\CityRepository")
*@ORM\Table(name="city")
*@ORM\HasLifecycleCallbacks
*@UniqueEntity(
*     fields={"country","name"},
*     message="Название города должно быть уникальным в пределах страны."
* )
**/

class City extends Place
{
    /**
     *@ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     *@ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     */
    protected $country;

    /**
    *@ORM\OneToMany(targetEntity="Sight", mappedBy="city")
    *@ORM\OrderBy({"name" = "ASC"})
    */
	protected $sights;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('shortdescription', new NotBlank());
        $metadata->addPropertyConstraint('description', new NotBlank());
        $metadata->addPropertyConstraint('image', new NotBlank());
        $metadata->addPropertyConstraint('country', new NotNull());
    }

    public function getFullname(){
        return $this->country->getName().", ".$this->name;
    }

    public function getDiscr(){
        return 'city';
    }

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
     * Set shortdescription
     *
     * @param string $shortdescription
     *
     * @return City
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
     * @return City
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
}
