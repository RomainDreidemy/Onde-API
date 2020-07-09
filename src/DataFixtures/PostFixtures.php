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
            ['name' => 'Stop à la captivité et l’exploitation des dauphins et des orques de Marineland', 'description' => "<p>Fréquenté par 1.3 millions de visiteurs par an, ce parc possède actuellement des dauphins et des orques qui produisent généralement un répertoire varié de tours et d’acrobaties souvent accompagnés d’une forte musique lors de présentations ou de spectacles.</p> <p>Depuis l’ouverture du parc en 1970, 27 dauphins (19 d’entre eux capturés) et 9 orques ont perdu la vie à un âge précoce. Chez les dauphins : Manon vers 13 ans, Fenix et Kaly vers 8 ans, et la liste est longue. Chez les orques : Calypso vers 11 ans, Clovis vers 4 ans, Kim Oum vers 14 ans, Betty vers 13 ans.</p> <p>Les pensionnaires du Marineland d’Antibes présentent de nombreuses blessures et travaillent inlassablement chaque jour à raison de 2 spectacles par jour, et retournent ensuite dans leurs petits bassins. La propreté du parc laisse à désirer : installations petites, sales, et mal entretenues.</p> <p>Plusieurs pays ont déjà interdit les delphinariums : le Chili et le Costa Rica en 2005, la Suisse en 2012 et l’Inde en 2013. Au sein de l’Union européenne, certains pays n’en possèdent aucun : l’Autriche, Chypre, la Croatie, l’Estonie, la Hongrie, l’Irlande, la Lettonie, le Luxembourg, la Pologne, la République tchèque, la Roumanie, le Royaume-Uni, la Slovaquie et la Slovénie.</p> <p>Réunissons-nous pour une France sans Delphinarium devant Marineland à Antibes, le samedi 8 août entre 18h et 19h.</p> <p>Un journaliste amateur sera présent pour filmer l’événement !</p>", 'departement' => '06', 'tags' => 'Protection animale', 'partenaire' => '', 'dateCreation' => new \DateTime('2020-07-08'), 'dateEnd' => new \DateTime('2020-08-24'), 'dateMeeting' => new \DateTime('2020-08-08T18:00:00')],
            ['name' => 'Opération de nettoyage des fonds marins', 'description' => "<p>L’association SOS Grand Bleu organise le nettoyage des fonds marins sur l’anse d’Espalmador à Saint-Jean-Cap-Ferrat, le samedi 25 juillet 2020 entre 9h00 et 11h00.</p> <p>Le rendez-vous est fixé sur la plage de Grasseuil. Vous pourrez garer vos véhicules sur l’avenue de Grasseuil (places réservées pour les bénévoles) à partir de 8h.</p> <p>Cette opération est une occasion supplémentaire pour sensibiliser l’ensemble des utilisateurs de la mer, le grand public à l’impact de certains gestes sur le milieu marin.</p> <p>Nous vous attendons nombreux, plongeurs (minimum niveau 2), apnéistes, bénévoles sur la plage pour participer à cette opération de nettoyage.<br>Nous rappelons que cette opération est également ouverte aux plongeurs de niveau 1, accompagnés d’un moniteur de niveau minimum E2.</p> <p>En fin d’opération, une petite collation est prévue pour l’ensemble des participants.</p>", 'departement' => '06', 'tags' => 'Nettoyage', 'partenaire' => 'SOS Grand Bleu', 'dateCreation' => new \DateTime('2020-07-03'), 'dateEnd' => new \DateTime('2020-08-10'), 'dateMeeting' => new \DateTime('2020-07-25T18:00:00')],
            ['name' => 'Restaurer la biodiversité marine côtière', 'description' => "<p>Au cœur des 6152 hectares de l'Aire marine protégée de la côte agathoise, labellisée site Natura 2000 des Posidonies du Cap d'Agde et gérée par la Ville d'Agde, le projet d’installation de la plus grande zone de mouillages écologiques en mer de la région Languedoc-Roussillon a besoin de vous !</p> <p>Cette Zone de Mouillages et d'Equipements Légers (ZMEL) a pour objectif de mieux protéger et gérer le milieu marin agathois et de sécuriser ce secteur pour les usagers en mer (plaisanciers, pêcheurs, baigneurs, plongeurs, …).</p> <p>Les milieux et espèces concernés autour de l'île de Brescou - seule île du Languedoc-Roussillon -, sont les herbiers de posidonies (habitat protégé spécifiquement méditerranéen, aux multiples fonctions écologiques et d'intérêt européen), les petits fonds rocheux méditerranéens et certaines espèces comme la Grande nacre, mollusque protégé vivant en Méditerranée.</p> <p>Les bateaux ne pourront donc plus jeter l'ancre n'importe où et fragiliser le milieu marin mais ils pourront s'amarrer aux bouées en place, disposant d’un marquage autocollant spécifique à leur longueur autorisée.</p> <p>L'opération est conduite par la direction de la gestion du milieu marin de la Ville d’Agde qui gère l'Aire marine protégée de la côte agathoise, pour un coût total de 230 000 € HT. Elle dispose de financements du Ministère de l'Ecologie (avec l'un des plus importants Contrat Natura 2000 marins français - 80 000 €), de l'Agence de l'eau Rhône Méditerranée Corse et de la Ville d’Agde.</p> <p>Nous vous donnons rendez-vous le dimanche 19 juillet à partir de 10h, aux abords de la Plage Richelieu pour une grande collecte solidaire.</p> <p>Sur place, une buvette installée permettra de vous désaltérer.</p>", 'departement' => '34', 'tags' => 'Collecte de fonds', 'partenaire' => '', 'dateCreation' => new \DateTime('2020-06-23'), 'dateEnd' => new \DateTime('2020-08-03'), 'dateMeeting' => new \DateTime('2020-07-19T10:00:00')],
            ['name' => 'Végétaliser le parking de la plage de l’Espiguette', 'description' => "<p>Plus de 5 500 places de stationnement pour le site classé de l’Espiguette ! 13 kilomètres de plage pour rejoindre la pointe en plein soleil.<p> <p>Les arbres créent dans un parking des espaces agréables, transparents et couverts à la fois. Il est particulièrement apprécié en périodes de chaleur pour son ombre.<p> <p>De plus, le contact avec les arbres a un effet bienfaisant pour le moral !<p> <p>Réunissons-nous pour planter le premier arbre, le samedi 5 septembre à 10h00.</p>", 'departement' => '30', 'tags' => 'Végétalisation', 'partenaire' => 'WWF', 'dateCreation' => new \DateTime('2020-08-20'), 'dateEnd' => new \DateTime('2020-09-21'), 'dateMeeting' => new \DateTime('2020-09-05T10:00:00')],
            ['name' => 'Enseignement des écogestes', 'description' => "<p>Sensibiliser les plaisanciers pour inciter à des changements de pratique concernant les équipements et les comportements, dans l’objectif de réduire leurs impacts sur la biodiversité marine.<p> <p>La plaisance tient une place importante dans les activités du littoral. Elle représente une source d’emploi non négligeable ainsi qu’une source de revenus liés au tourisme. Les plaisanciers peu ou mal avertis peuvent néanmoins affecter l’environnement marin à travers leur activité.<p> <p>Il s’agit de les sensibiliser aux impacts de leurs usages et les accompagner vers des comportements plus respectueux des écosystèmes marins.<p> <p>Le rendez-vous est donné ! Mercredi 5 août de 9h30 à 17h00 au club de plongée de Porto-vecchio<p>", 'departement' => '2A', 'tags' => 'Manifestation', 'partenaire' => '', 'dateCreation' => new \DateTime('2020-07-17'), 'dateEnd' => new \DateTime('2020-08-24'), 'dateMeeting' => new \DateTime('2020-08-05T09:30:00')],
            ['name' => 'Nettoyage de la Digue à la Mer', 'description' => "<p>Au cours du 19e siècle, la Camargue a fait face à plusieurs crues, provoquant des dégâts considérables. La Digue à la Mer, construite entre 1857 et 1859, protège la Camargue des entrées marines dans les terres et permet le développement agricole dans le sud de la Camargue.<p> <p>Cet ouvrage, qui s’étend sur plus de 40km, entre les Saintes-Maries-de-la-Mer et Salin-de-Giraud, sépare les lagunes des étangs centraux. Les échanges d’eau entre la mer et les étangs se font par l’intermédiaire de vannes, appelées pertuis.<p> <p>Lorsque l’eau monte, elle dépose ses déchets sur la digue. Dans un souci de propreté, une opération de nettoyage et de collecte est organisée le dimanche 16 août à La Digue à la Mer de 8h30 à 11h00.<p>", 'departement' => '13', 'tags' => 'Nettoyage', 'partenaire' => '', 'dateCreation' => new \DateTime('2020-07-30'), 'dateEnd' => new \DateTime('2020-08-31'), 'dateMeeting' => new \DateTime('2020-08-16T08:30:00')],
            [
                'name' => 'Collecte des déchets sur la plage de Pampelonne',
                'description' => "<p>Pourquoi y participer ? Pour faire une bonne action dont les effets sont concrètement visibles et quantifiables. Les participants prennent généralement conscience des impacts de la pollution liée aux déchets directement sur le terrain.<p> <p> C’est une action concrète permettant de protéger l’environnement tout en passant un moment agréable en famille, entre amis ou avec de nouvelles personnes.<p> <p>Venez nous aider à préserver la beauté de ce lieu ! Tout le matériel nécessaire à la collecte sera distribué sur place.<p> <p> La collecte à lieu le 11 juillet sur la plage de Pampelonne de 19h00 à 21h00 afin de profiter de la fraicheur !<p>",
                'departement' => '83',
                'tags' => 'Plage',
                'partenaire' => '',
                'dateCreation' => new \DateTime('2020-06-23'),
                'dateEnd' => new \DateTime('2020-07-27'),
                'dateMeeting' => new \DateTime('2020-07-11T08:30:00')
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
