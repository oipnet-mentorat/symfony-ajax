<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

final class PostFixtures extends Fixture {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i = 0; $i < 25; $i++) {
            $post = new Post();
            $post->setTitle($faker->sentence());
            $post->setContent($faker->paragraph(5));

            $manager->persist($post);
        }

        $manager->flush();
    }
}