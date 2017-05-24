<?php
//src/Project/SiteBundle/Entity/Country.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;


/**
* @ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\CountryRepository")
* @ORM\Table(name="country")
* @ORM\HasLifecycleCallbacks
* @UniqueEntity(
*     fields={"name"},
*     message="Название страны должно быть уникальным."
* )
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
    * @ORM\Column(name="description", type="text", nullable=false)
    **/
    protected $description;
    /**
    * @ORM\Column(name="image",type="string", nullable=false)
    **/
    protected $image;
    /**
    * @ORM\OneToMany(targetEntity="City", mappedBy="country")
    */
    protected $cities;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('description', new NotBlank());
        $metadata->addPropertyConstraint('image', new NotBlank());
     }
}
