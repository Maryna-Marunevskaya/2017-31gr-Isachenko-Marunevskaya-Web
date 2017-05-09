<?php
// src/Project/SiteBundle/DataFixtures/ORM/SightFixtures.php

namespace Project\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Project\SiteBundle\Entity\City;
use Project\SiteBundle\Entity\Sight;

class SightFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $sight=new Sight();
        $sight->setName("Tower");
        $sight->setImage("tower.jpg");
        $sight->setCity($manager->merge($this->getReference('city')));

        $manager->persist($sight);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
