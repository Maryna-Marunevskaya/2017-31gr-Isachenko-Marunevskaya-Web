<?php
//src/Project/SiteBundle/Entity/Sight.php
namespace Project\SiteBundle\Entity;
/**
* @ORM\Entity
**/
class Sight extends Place
{
     /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="sights")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     */
    protected $city;
}
