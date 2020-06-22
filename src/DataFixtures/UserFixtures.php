<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // User administrateur
        $usersAdmin = [
            [
                'email' => 'romain.dreidemy@gmail.com',
                'surname' => 'Romain',
                'name' => 'Dreidemy',
                'type' => false,
                'password' => 'romain'
            ]
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

        // User standard
        for ($i = 0; $i < 10; $i++){
            $user = new User();

            $user
                ->setEmail('onde' . $i . '@gmail.com')
                ->setName('Onde' . $i)
                ->setSurname('Onde' . $i)
                ->setRoles(['ROLE_USER'])
                ->setType(false)
                ->setPassword($this->encoder->encodePassword($user, 'Onde' . $i))
            ;

            $manager->persist($user);
        }

        //User partenaire
        for ($i = 0; $i < 3; $i++){
            $user = new User();

            $user
                ->setEmail('onde-partenaire' . $i . '@gmail.com')
                ->setName('partenaire' . $i)
                ->setSurname('Opartenairende' . $i)
                ->setRoles(['ROLE_USER'])
                ->setType(true)
                ->setPassword($this->encoder->encodePassword($user, 'Partenaire' . $i))
            ;

            $manager->persist($user);
        }



        $manager->flush();
    }
}
