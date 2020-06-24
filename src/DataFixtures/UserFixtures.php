<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends AppFixtures
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function loadData(ObjectManager $manager)
    {
        // User administrateur
        $usersAdmin = [
            ['email' => 'romain.dreidemy@hetic.net', 'surname' => 'Romain', 'name' => 'Dreidemy', 'type' => false, 'password' => 'onde'],
            ['email' => 'emma.cassagnettes@hetic.net', 'surname' => 'Emma', 'name' => 'Cassagnettesx', 'type' => false, 'password' => 'onde'],
            ['email' => 'victor.balducci@hetic.net', 'surname' => 'Victor', 'name' => 'Balducci', 'type' => false, 'password' => 'onde'],
            ['email' => 'camille.marquand@hetic.net', 'surname' => 'Camille', 'name' => 'Marquand', 'type' => false, 'password' => 'onde'],
            ['email' => 'fiona.roux@hetic.net', 'surname' => 'Fiona', 'name' => 'Roux', 'type' => false, 'password' => 'onde'],
        ];

        foreach ($usersAdmin as $userAdmin){
            $user = new User();
            $user
                ->setEmail($userAdmin['email'])
                ->setName($userAdmin['name'])
                ->setSurname($userAdmin['surname'])
                ->setRoles(['ROLE_ADMIN'])
                ->setType($userAdmin['type'])
                ->setPassword($this->encoder->encodePassword($user, $userAdmin['password']))
            ;

            $manager->persist($user);
        }

        $this->createMany(20, 'User', function (){
            $user = new User();
            $user
                ->setEmail($this->faker->email)
                ->setName($this->faker->name)
                ->setSurname($this->faker->firstName)
                ->setType($this->faker->randomElement([true, false]))
                ->setFonction($this->faker->jobTitle)
                ->setPassword($this->encoder->encodePassword($user, 'userPassword'))
            ;

            return $user;
        });

        $manager->flush();
    }
}
