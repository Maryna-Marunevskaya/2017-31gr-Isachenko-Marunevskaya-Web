<?php
//src/Project/SiteBundle/Entity/City.php
namespace Project\SiteBundle\Entity;
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
    * @ORM\OneToMany(targetEntity="Sight", mappedBy="city")
    */
	protected $sights;
}
