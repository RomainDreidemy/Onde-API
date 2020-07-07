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
            ['email' => 'emma.cassagnettes@hetic.net', 'surname' => 'Emma', 'name' => 'Cassagnettes', 'type' => false, 'password' => 'onde'],
            ['email' => 'victor.balducci@hetic.net', 'surname' => 'Victor', 'name' => 'Balducci', 'type' => false, 'password' => 'onde'],
            ['email' => 'camille.marquand@hetic.net', 'surname' => 'Camille', 'name' => 'Marquand', 'type' => false, 'password' => 'onde'],
            ['email' => 'fiona.roux@hetic.net', 'surname' => 'Fiona', 'name' => 'Roux', 'type' => false, 'password' => 'onde'],
            ['email' => 'aymericmayeux@gmail.com', 'surname' => 'Aymeric', 'name' => 'Mayeux', 'type' => false, 'password' => 'intervenant'],
            ['email' => 'bastien.calou@gmail.com', 'surname' => 'Bastien', 'name' => 'Calou', 'type' => false, 'password' => 'intervenant'],
        ];

        $userPartenaire = [
            ['email' => 'contact@wwf.fr', 'name' => 'WWF', 'password' => 'partenaire'],
            ['email' => 'contact@greenpeace.fr', 'name' => 'GreenPeace', 'password' => 'partenaire'],
            ['email' => 'contact@upm.fr', 'name' => 'WWF', 'UpM' => 'partenaire'],
            ['email' => 'contact@eaurmc.fr', 'name' => 'Eau RMC', 'password' => 'partenaire'],
            ['email' => 'contact@sosgrandbleau.fr', 'name' => 'SOS Grand Bleu', 'password' => 'partenaire'],
        ];

        foreach ($usersAdmin as $userAdmin){
            $user = new User();
            $user
                ->setEmail($userAdmin['email'])
                ->setName($userAdmin['name'])
                ->setSurname($userAdmin['surname'])
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword($this->encoder->encodePassword($user, $userAdmin['password']))
            ;

            $manager->persist($user);
        }

        $this->createMany(40, 'user', function (){
            $user = new User();
            $user
                ->setEmail($this->faker->email)
                ->setName($this->faker->name)
                ->setSurname($this->faker->firstName)
                ->setRoles($this->faker->randomElement([['ROLE_USER'], ['ROLE_PARTENAIRE'], ['ROLE_MODO']]))
                ->setFonction($this->faker->jobTitle)
                ->setPassword($this->encoder->encodePassword($user, 'userPassword'))
            ;

            return $user;
        });

        $manager->flush();
    }
}
