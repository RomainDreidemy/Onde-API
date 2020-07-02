<?php

namespace App\DataFixtures;

use App\Entity\Department;
use App\Entity\Post;
use App\Entity\Tags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends AppFixtures implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {

        $this->createMany(20, 'post', function (){

            $departments = $this->manager->getRepository(Department::class)->findAll();
            $tags = $this->manager->getRepository(Tags::class)->findAll();
            $post = (new Post())
               ->setName($this->faker->name)
               ->setDescription($this->faker->paragraph(3))
               ->setDateCreated($this->faker->dateTimeBetween('-2 month', 'now'))
               ->setDateEnd($this->faker->dateTimeBetween('now', '+30 days'))
               ->setValidated($this->faker->randomElement([0, 1]))
               ->setUser($this->getRandomReference('user'))
               ->setDepartment($this->faker->randomElement($departments))
                ->setDateMeeting($this->faker->dateTimeBetween('now', '+30 days'))
           ;
            $nbTags = $this->faker->randomElement([1, 2, 3]);

            for ($i = 0; $i < $nbTags; $i++){
                $post->addTag($this->faker->randomElement($tags));
            }

           return $post;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            DepartmentFixtures::class,
            TagsFixtures::class
        ];
    }
}
