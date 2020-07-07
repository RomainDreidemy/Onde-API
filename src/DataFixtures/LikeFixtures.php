<?php

namespace App\DataFixtures;

use App\Entity\Like;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LikeFixtures extends AppFixtures implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        for($i = 0; $i < 200; $i++){
            $user = $this->faker->randomElement($manager->getRepository(User::class)->findAll());
            $post = $this->faker->randomElement($manager->getRepository(Post::class)->findAll());

            $alreadyExist = $manager->getRepository(Like::class)->findOneBy(['User' => $user, 'Post' => $post]);

            if(is_null($alreadyExist)){
                $like = (new Like())
                    ->setUser($user)
                    ->setPost($post)
                ;

                $manager->persist($like);
            }
        }

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
