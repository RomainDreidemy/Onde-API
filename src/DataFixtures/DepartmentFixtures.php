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
            ['code' => '66', 'name' => 'Pyrenees oriental'],
            ['code' => '11', 'name' => 'Aude'],
            ['code' => '34', 'name' => 'Herault'],
            ['code' => '30', 'name' => 'Gar'],
            ['code' => '13', 'name' => 'Bouche du Rhone'],
            ['code' => '83', 'name' => 'Var'],
            ['code' => '06', 'name' => 'Alples Maritimes'],
            ['code' => '2B', 'name' => 'Haute Corse'],
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
