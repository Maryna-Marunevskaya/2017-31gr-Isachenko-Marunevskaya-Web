<?php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
*@ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\CountryRepository")
*@ORM\Table(name="country")
*@ORM\HasLifecycleCallbacks
*@UniqueEntity(
*   fields={"name"},
*   message="Название страны должно быть уникальным."
*)
**/
class Country
{
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
    *@ORM\OneToMany(targetEntity="City", mappedBy="country")
    *@ORM\OrderBy({"name" = "ASC"})
    */
    protected $cities;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('shortdescription', new NotBlank());
        $metadata->addPropertyConstraint('description', new NotBlank());
        $metadata->addPropertyConstraint('image', new NotBlank());
    }

    public function isSights(){
        foreach($this->cities as $city){
            if(sizeof($city->getSights())!=0){
                return true;
            }
        }
        return false;
    }
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
     * Set shortdescription
     *
     * @param string $shortdescription
     *
     * @return Country
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
     * @return Country
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
