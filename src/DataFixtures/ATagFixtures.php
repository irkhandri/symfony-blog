<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ATagFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tag1 = new Tag();
        $tag1->setName('foo');
        $manager->persist($tag1);

        $tag2 = new Tag();
        $tag2->setName('boo');
        $manager->persist($tag2);

        $tag3 = new Tag();
        $tag3->setName('php');
        $manager->persist($tag3);

        $tag4 = new Tag();
        $tag4->setName('hph');
        $manager->persist($tag4);

        $tag5 = new Tag();
        $tag5->setName('joo');
        $manager->persist($tag5);

        $manager->flush();

        $this->addReference('tag_1', $tag1);
        $this->addReference('tag_2', $tag2);
        $this->addReference('tag_3', $tag3);
        $this->addReference('tag_4', $tag4);
        $this->addReference('tag_5', $tag5);


    }
}
