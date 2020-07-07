<?php

namespace App\Controller\Api\Like;

use App\Entity\Comment;
use App\Entity\Like;
use App\Entity\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LikeAddController extends AbstractController
{
    private $manager;

    /**
     * LikeAddController constructor.
     * @param EntityManagerInterface $entityManager
     * @param MailerInterface $mailer
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    public function __invoke(Like $data)
    {
        // Récupération des objectifs
        $goals = $data->getPost()->getPostGoals();

        // Si un commentaire et un post est ciblé
        if(!is_null($data->getComment()) && !is_null($data->getPost())){
            return $this->json([
                'error' => 'Il faut faire un choix entre Post et Comment pour attribuer le like'
            ], 500);
        }

        // Si aucun des deux ne sont ciblé
        if(is_null($data->getComment()) && is_null($data->getPost())){
            return $this->json([
                'error' => 'Il faut faire au que soit Post soit Comment soit défini'
            ], 500);
        }

        // Si la combinaison Post User existe déjà
        if(!is_null($data->getPost())){
            $alreadyExist = $this->manager->getRepository(Like::class)->findOneBy(['User' => $data->getUser(), 'Post' => $data->getPost()]);
        }

        // Si La combinaison Comment User existe déjà
        if(!is_null($data->getComment())){
            $alreadyExist = $this->manager->getRepository(Like::class)->findOneBy(['User' => $data->getUser(), 'Comment' => $data->getComment()]);
        }


        if(!is_null($alreadyExist)){
            return $this->json([
                'error' => 'La combinaison existe déjà'
            ], 500);
        }

        $this->manager->persist($data);
        $this->manager->flush();

        return $data;
    }
}
