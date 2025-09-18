<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $categories = $manager->getRepository(Category::class)->findAll();
        for ($i = 1; $i <= 30; $i++) {
            $post = new Post();
            $post->setTitle($faker->sentence(3))
                 ->setContent($faker->paragraphs(5, true))
                 ->setCreatedAt((\DateTimeImmutable::createFromMutable($faker->dateTimeBetween("-60 days", "now"))))
                 ->setEditedAt((\DateTimeImmutable::createFromMutable($faker->dateTimeBetween("-20 days", "now"))))
                 ->setImage($i .".jpg")
                 ->setIsPublished($faker->boolean(90))
                 ->setCategory($categories[array_rand($categories)]);
            $manager->persist($post);
        }


        $manager->flush();
    }
}
