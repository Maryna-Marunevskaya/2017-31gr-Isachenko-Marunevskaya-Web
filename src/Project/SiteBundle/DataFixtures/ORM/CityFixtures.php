<?php
// src/Project/SiteBundle/DataFixtures/ORM/CityFixtures.php

namespace Project\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Project\SiteBundle\Entity\Country;
use Project\SiteBundle\Entity\City;

class CityFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $city=new City();
        $city->setName("London");
        $city->setImage("london.jpg");
        $city->setCountry($manager->merge($this->getReference('country')));

        $manager->persist($city);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
