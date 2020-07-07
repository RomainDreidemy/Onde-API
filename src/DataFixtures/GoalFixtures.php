<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\PostGoal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GoalFixtures extends AppFixtures implements DependentFixtureInterface
{

    protected function loadData(ObjectManager $manager)
    {
//        $goals = [
//            ['name' => 'Nettoyer 1km de plage', 'number' => 24],
//            ['name' => 'Nettoyer 2km de plage', 'number' => 42],
//            ['name' => 'Nettoyer toute la plage plage', 'number' => 64],
//        ];
//
//        $posts = $manager->getRepository(Post::class)->findAll();
//
//        foreach ($posts as $post){
//            $i = 1;
//            foreach ($goals as $g){
//                $goal = (new PostGoal())
//                    ->setName($g['name'])
//                    ->setNumber($g['number'])
//                    ->setPlacement($i)
//                    ->setPost($post)
//                    ->setDone(false)
//                ;
//
//                $manager->persist($goal);
//
//                $i++;
//            }
//        }
//
//        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PostFixtures::class
        ];
    }
}
