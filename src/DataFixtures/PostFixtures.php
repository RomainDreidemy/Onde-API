<?php

namespace App\DataFixtures;

use App\Entity\Department;
use App\Entity\Post;
use App\Entity\Tags;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends AppFixtures implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $posts = [
            [
                'name' => 'Stop à la captivité et l’exploitation des dauphins et des orques de Marineland',
                'description' => "<p>Fréquenté par 1.3 millions de visiteurs par an, ce parc possède actuellement des dauphins et des orques qui produisent généralement un répertoire varié de tours et d’acrobaties souvent accompagnés d’une forte musique lors de présentations ou de spectacles.</p> <p>Depuis l’ouverture du parc en 1970, 27 dauphins (19 d’entre eux capturés) et 9 orques ont perdu la vie à un âge précoce. Chez les dauphins : Manon vers 13 ans, Fenix et Kaly vers 8 ans, et la liste est longue. Chez les orques : Calypso vers 11 ans, Clovis vers 4 ans, Kim Oum vers 14 ans, Betty vers 13 ans.</p> <p>Les pensionnaires du Marineland d’Antibes présentent de nombreuses blessures et travaillent inlassablement chaque jour à raison de 2 spectacles par jour, et retournent ensuite dans leurs petits bassins. La propreté du parc laisse à désirer : installations petites, sales, et mal entretenues.</p> <p>Plusieurs pays ont déjà interdit les delphinariums : le Chili et le Costa Rica en 2005, la Suisse en 2012 et l’Inde en 2013. Au sein de l’Union européenne, certains pays n’en possèdent aucun : l’Autriche, Chypre, la Croatie, l’Estonie, la Hongrie, l’Irlande, la Lettonie, le Luxembourg, la Pologne, la République tchèque, la Roumanie, le Royaume-Uni, la Slovaquie et la Slovénie.</p> <p>Réunissons-nous pour une France sans Delphinarium devant Marineland à Antibes, le samedi 8 août entre 18h et 19h.</p> <p>Un journaliste amateur sera présent pour filmer l’événement !</p>",
                'departement' => '06',
                'tags' => 'Protection animale',
                'partenaire' => '',
                'dateCreation' => new \DateTime('2020-07-08'),
                'dateEnd' => new \DateTime('2020-08-24'),
                'dateMeeting' => new \DateTime('2020-08-08T18:00:00'),
            ],
        ];

        foreach ($posts as $post){
            $postI = (new Post())
                ->setName($post['name'])
                ->setDescription($post['description'])
                ->setDepartment($manager->getRepository(Department::class)->findOneBy(['code' => $post['departement']]))
                ->addTag($manager->getRepository(Tags::class)->findOneBy(['name' => $post['tags']]))
                ->setDateCreated($post['dateCreation'])
                ->setDateEnd($post['dateEnd'])
                ->setDateMeeting($post['dateMeeting'])
                ->setValidated(true)
            ;

            if(!empty($post['partenaire'])){
                $postI->setUser($manager->getRepository(User::class)->findOneBy(['name' => $post['partenaire']]));
            }else{
                $postI->setUser($this->faker->randomElement($manager->getRepository(User::class)->findAll()));
            }

            $manager->persist($postI);
        }

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
