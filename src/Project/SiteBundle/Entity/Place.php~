<?php
//src/Project/SiteBundle/Entity/Place.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
* @ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\PlaceRepository")
* @ORM\Table(name="place")
* @ORM\HasLifecycleCallbacks
* @ORM\InheritanceType("JOINED")
* @ORM\DiscriminatorColumn(name="discr", type="string")
* @ORM\DiscriminatorMap({"city" = "City", "sight" = "Sight"})
*/
abstract class Place
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
    * @ORM\Column(name="name",type="string", nullable=false)
    **/
    protected $name;
    /**
    * @ORM\Column(name="description", type="text", nullable=false)
    **/
    protected $description;
    /**
    * @ORM\Column(name="image",type="string", nullable=false)
    **/
    protected $image;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('description', new NotBlank());
        $metadata->addPropertyConstraint('image', new NotBlank());
     }
}
