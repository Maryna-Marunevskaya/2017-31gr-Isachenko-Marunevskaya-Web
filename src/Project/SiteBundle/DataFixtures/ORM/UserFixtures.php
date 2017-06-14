<?php

namespace Project\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Project\SiteBundle\Entity\Role;
use Project\SiteBundle\Entity\User;

use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $administrator = new Role();
        $administrator->setRole('ROLE_ADMINISTRATOR');
        $administrator->setDisplay('Администратор');

        $manager->persist($administrator);

        $travelagent = new Role();
        $travelagent->setRole('ROLE_TRAVELAGENT');
        $travelagent->setDisplay('Турагент');

        $manager->persist($travelagent);

        $tourist = new Role();
        $tourist->setRole('ROLE_TOURIST');
        $tourist->setDisplay('Турист');

        $manager->persist($tourist);

        $user = new User();
        $user->setUsername('admin');
        $user->setSalt(md5(time()));

        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('admin', $user->getSalt());
        $user->setOriginalPassword('admin');
        $user->setPassword($password);

        $user->addRole($administrator);
        $user->setRole($administrator);

        $manager->persist($user);

        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }

}
