<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            UserFixtures::class,
        ];
    }
    public function __construct(private readonly SluggerInterface $slugger)
    {

    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $categories = $manager->getRepository(Category::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();
        for ($i = 1; $i <= 30; $i++) {
            $post = new Post();
            $post->setTitle($faker->sentence(3))
                 ->setContent($faker->paragraphs(5, true))
                 ->setCreatedAt((\DateTimeImmutable::createFromMutable($faker->dateTimeBetween("-60 days", "now"))))
                 ->setEditedAt((\DateTimeImmutable::createFromMutable($faker->dateTimeBetween("-20 days", "now"))))
                 ->setImage($i .".jpg")
                 ->setIsPublished($faker->boolean(90))
                 ->setCategory($categories[array_rand($categories)])
                 ->setSlug($this->slugger->slug($post->getTitle()))
                 ->setUser($users[array_rand($users)]);
            $manager->persist($post);

        }


        $manager->flush();
    }
}
