<?php

namespace App\DataFixtures;

use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SubscriptionFixtures extends AppFixtures implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(30, 'subscription', function (){
            $subscription = (new Subscription())
                ->setUser($this->getRandomReference('user'))
                ->setPost($this->getRandomReference('post'))
            ;

            return $subscription;
        });
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            PostFixtures::class
        ];
    }
}
