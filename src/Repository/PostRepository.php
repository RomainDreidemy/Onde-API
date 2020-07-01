<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findByTop(int $nb)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Post p
            LEFT JOIN p.likes l
            GROUP BY p.id
            ORDER BY count(l.id) DESC'
        )->setMaxResults($nb);

        return $query->getResult();
    }

    public function findByCritere(string $type, $params, int $limit = null)
    {
        $entityManager = $this->getEntityManager();

        $queryString =
            'SELECT p
            FROM App\Entity\Post p
            LEFT JOIN p.likes l
            '
        ;



        // Ajout des paramettres
        if(!empty($params)){
            $i=1;
            $j = 1;
            $valuesForParam = [];
            foreach($params as $param){
                if(!is_null($param)){
                    if(key($params) === 'department'){


                        if($j !== 1){
                            $queryString .= ' AND ';
                        }else{
                            $queryString .= ' WHERE ';
                        }

                        $queryString .= '(';

                        foreach ($params[key($params)] as $item){

                            if($i !== 1){
                                $queryString .= ' OR ';
                            }

                            $where = 'p.' . key($params) . ' = :field' . $i;
                            $queryString .= $where;
                            $valuesForParam[] = $item;
                            $i++;
                        }
                        $queryString .= ')';
                    }
                }
            }
        }


        switch ($type) {
            case 'populaire' :
                $queryString .= '
                GROUP BY p.id
                ORDER BY count(l.id) DESC';
                break;
            case 'recent' :
                $queryString .= '
                GROUP BY p.id
                ORDER BY p.id DESC';
                break;
            case 'objectif_done' :
                $queryString .= '
                GROUP BY p.id
                ORDER BY p.id DESC';
                break;
        }

        $query = $entityManager->createQuery($queryString);

        $i = 1;
        if(isset($valuesForParam)){
            foreach ($valuesForParam as $item){
                $query->setParameter('field' . $i, $item);
                $i++;
            }
        }


        if(!is_null($limit)){
            dump($limit);
            $query->setMaxResults($limit);
        }



        dump($query->getSQL());

        $posts = $query->getResult();

        $postsFinal = [];

        if($type === 'objectif_done'){
            foreach ($posts as $post){
                $postDone = true;
                foreach ($post->getPostGoals() as $objectif){
                    if($postDone){
                        if(!$objectif->getDone()){
                            $postDone = false;
                        }
                    }
                }

                if($postDone){
                    $postsFinal[] = $post;
                }
            }
        }else{ $postsFinal = $posts; }

        return $postsFinal;
    }

    // /**
    //  * @return Post[] Returns an array of Post objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
