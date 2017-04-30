<?php
// src/Project/SiteBundle/DataFixtures/ORM/CountryFixtures.php

namespace Project\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Project\SiteBundle\Entity\Country;

class CountryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $country=new Country();
        $country->setName("England");
        $country->setImage("england.jpg");

        $manager->persist($country);

        $manager->flush();

        $this->addReference('country', $country);
    }

    public function getOrder()
    {
        return 1;
    }
}
