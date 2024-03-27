<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $blog = new Blog();
        // $blog->setTitle('Dummmmmmy');
        // $blog->setDescription('Decdsfsd sdfsdf');
        // $blog->setImageUrl('https://www.epitech-it.es/wp-content/uploads/2021/05/que-es-php.jpg');

        // $blog->addTag($this->getReference('tag_1'));
        // $blog->addTag($this->getReference('tag_2'));
        // $blog->addTag($this->getReference('tag_3'));

        // $manager->persist($blog);


        // $blog2 = new Blog();
        // $blog2->setTitle('Dummmmmmy2222');
        // $blog2->setDescription('Decdsfsd sdfsdf 2222222');
        // $blog2->setImageUrl('https://logowik.com/content/uploads/images/php.jpg');
        // $blog2->addTag($this->getReference('tag_5'));
        // $blog2->addTag($this->getReference('tag_4'));
        // $blog2->addTag($this->getReference('tag_3'));
        // $blog2->addTag($this->getReference('tag_2'));


        // $manager->persist($blog2);


        // $manager->flush();

        // $this->addReference('blog_1', $blog);
        // $this->addReference('blog_2', $blog2);


    }
}
