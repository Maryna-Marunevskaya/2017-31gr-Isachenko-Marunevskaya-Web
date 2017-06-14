<?php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
*@ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\SightRepository")
*@ORM\Table(name="sight")
*@ORM\HasLifecycleCallbacks
*@UniqueEntity(
*     fields={"city","name"},
*     message="Название достопримечательности должно быть уникальным в пределах города."
* )
**/

class Sight extends Place
{
    /**
     *@ORM\ManyToOne(targetEntity="City", inversedBy="sights")
     *@ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     */
    protected $city;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('shortdescription', new NotBlank());
        $metadata->addPropertyConstraint('description', new NotBlank());
        $metadata->addPropertyConstraint('image', new NotBlank());
        $metadata->addPropertyConstraint('city', new NotNull());
    }

    public function getFullname(){
        return $this->city->getFullname().", ".$this->name;
    }

    public function getDiscr(){
        return 'sight';
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
     * @return Sight
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
     * @return Sight
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
     * @return Sight
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
     * @return Sight
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
     * Set city
     *
     * @param \Project\SiteBundle\Entity\City $city
     *
     * @return Sight
     */
    public function setCity(\Project\SiteBundle\Entity\City $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Project\SiteBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }
}
