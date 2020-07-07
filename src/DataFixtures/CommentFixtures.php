<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends AppFixtures implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
//        $this->createMany(80, 'comment', function (){
//            $comment = (new Comment())
//                ->setText($this->faker->paragraph)
//                ->setDate($this->faker->dateTimeBetween('-2 month', 'now'))
//                ->setUser($this->getRandomReference('user'))
//                ->setPost($this->getRandomReference('post'))
//            ;
//
//            return $comment;
//        });
//        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            PostFixtures::class
        ];
    }
}
