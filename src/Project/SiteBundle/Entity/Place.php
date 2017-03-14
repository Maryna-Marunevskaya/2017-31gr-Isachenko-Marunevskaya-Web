<?php
//src/Project/SiteBundle/Entity/Place.php
/**
* @ORM\Entity
* @ORM\Table(name="place")
* @ORM\HasLifecycleCallbacks
* @InheritanceType("SINGLE_TABLE")
* @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"place" = "Place", "city" = "City", "sight" = "Sight"})
*/
namespace Project\SiteBundle\Entity;
abstract class Place
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer", name="id")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
    * @ORM\Column(type="string", nullable=false)
    **/
    protected $name;
}
