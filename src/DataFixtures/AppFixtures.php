<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class AppFixtures extends Fixture
{
    protected $manager;
    /** @var Generator $faker */
    protected $faker;
    private $referencesIndex = [];

    // méthode pour générer les entités
    // à implémenter par les classes enfant
    abstract protected function loadData(ObjectManager $manager);

    // méthode utilisée par le système de fixtures
    // Enregistre le Manager, initialise Faker et appelle loadData()
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create('fr_FR');
        $this->loadData($manager);
        $this->manager->flush();
    }

    // Execute $count fois la fonction $factory
    // $factory doit créer et retourner une entité
    protected function createMany(int $count, string $groupName, callable $factory)
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = $factory($i);

            if (null === $entity) {
                throw new \LogicException('L\'Entité doit être retournée');
            }

            $this->manager->persist($entity);
            $this->addReference(sprintf('%s_%d', $groupName, $i), $entity);
        }
    }

    protected function getRandomReference(string $groupName)
    {
        // Enregistrement des références si nécessaire
        if (!isset($this->referencesIndex[$groupName])) {
            $this->referencesIndex[$groupName] = [];

            foreach ($this->referenceRepository->getReferences() as $key => $ref) {
                if (strpos($key, $groupName.'_') === 0) {
                    $this->referencesIndex[$groupName][] = $key;
                }
            }
        }

        if (empty($this->referencesIndex[$groupName])) {
            throw new \Exception(sprintf('Ne peut trouver de référence pour le groupe "%s"', $groupName));
        }

        // Retourner une référence aléatoire
        $randomReferenceKey = $this->faker->randomElement($this->referencesIndex[$groupName]);
        return $this->getReference($randomReferenceKey);
    }
}