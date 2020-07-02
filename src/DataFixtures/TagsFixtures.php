<?php

namespace App\DataFixtures;

use App\Entity\Tags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tags = [
            ['name' => 'Sauvetage', 'color' => '#ABABAB'],
            ['name' => 'Nettoyage', 'color' => '#ABABAB'],
            ['name' => 'Protection animale', 'color' => '#ABABAB'],
            ['name' => 'Manifestations', 'color' => '#ABABAB'],
            ['name' => 'Collecte de fonds', 'color' => '#ABABAB'],
            ['name' => 'Expositions', 'color' => '#ABABAB'],
            ['name' => 'Biodiversité', 'color' => '#ABABAB'],
            ['name' => 'Végétalisation/Reforestation', 'color' => '#ABABAB'],
        ];

        foreach ($tags as $tag){
            $t = (new Tags())
                ->setName($tag['name'])
            ;
            $manager->persist($t);
        }

        $manager->flush();
    }
}
