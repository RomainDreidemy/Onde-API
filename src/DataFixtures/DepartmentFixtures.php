<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $departments = [
            ['code' => '66', 'name' => 'Pyrénées oriental'],
            ['code' => '11', 'name' => 'Aude'],
            ['code' => '34', 'name' => 'Hérault'],
            ['code' => '30', 'name' => 'Gard'],
            ['code' => '13', 'name' => 'Bouches du Rhone'],
            ['code' => '83', 'name' => 'Var'],
            ['code' => '06', 'name' => 'Alpes maritimes'],
            ['code' => '2B', 'name' => 'Haute Corse' ],
            ['code' => '2A', 'name' => 'Corse du sud']
        ];

        foreach ($departments as $department){
            $dep = (new Department())
                ->setCode($department['code'])
                ->setName($department['name'])
            ;

            $manager->persist($dep);
        }

        $manager->flush();
    }
}
