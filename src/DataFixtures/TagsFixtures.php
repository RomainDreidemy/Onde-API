<?php

namespace App\DataFixtures;

use App\Entity\Tags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tags = ['Sauvetage', 'Nettoyage', 'Animaux', 'Manifestation', 'Collecte de fonds', 'Exposition', 'Biodiversité', 'Revegétalisation', 'Reforestation', 'Protection animale'];

        foreach ($tags as $tag){
            $t = (new Tags())
                ->setName($tag)
            ;
            $manager->persist($t);
        }

        $manager->flush();
    }
}
