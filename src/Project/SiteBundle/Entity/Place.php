<?php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
*@ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\PlaceRepository")
*@ORM\Table(name="place")
*@ORM\HasLifecycleCallbacks
*@ORM\InheritanceType("JOINED")
*@ORM\DiscriminatorColumn(name="discr", type="string")
*@ORM\DiscriminatorMap({"city" = "City", "sight" = "Sight"})
*/

abstract class Place
{
    /**
    *@ORM\Id
    *@ORM\Column(name="id", type="integer")
    *@ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
    *@ORM\Column(name="name", type="string", nullable=false)
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

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('shortdescription', new NotBlank());
        $metadata->addPropertyConstraint('description', new NotBlank());
        $metadata->addPropertyConstraint('image', new NotBlank());
    }

    public abstract function getFullname();
    public abstract function getDiscr();

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
     * @return Place
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
     * @return Place
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
     * @return Place
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
     * @return Place
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
}
