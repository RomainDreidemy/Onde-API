<?php

namespace App\DataFixtures;

use App\Entity\Like;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LikeFixtures extends AppFixtures implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(30, 'likePost', function (){
           $like = (new Like())
               ->setUser($this->getRandomReference('user'))
               ->setPost($this->getRandomReference('post'))
           ;

           return $like;
        });

        $this->createMany(150, 'likeComment', function (){
            $like = (new Like())
                ->setUser($this->getRandomReference('user'))
                ->setComment($this->getRandomReference('comment'))
            ;

            return $like;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PostFixtures::class,
            CommentFixtures::class,
            UserFixtures::class
        ];
    }
}
