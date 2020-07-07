<?php

namespace App\Controller\Api\Comment;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CommentGetCollectionWithUserController extends AbstractController
{
    private $manager;

    /**
     * CommentGetCollectionWithUserController constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->manager = $entityManager;
    }

    /**
     * @param Post $data
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function __invoke(Post $data)
    {
        // Récupération des commentaires du Post
        $data = $data->getComments();

        $commentsNew = [];

        // Ajout des informations de l'utilisateur pour return dans le commentairec
        foreach ($data as $comment){
            $commentsNew[] = [
                'id' => $comment->getId(),
                'text' => $comment->getText(),
                'User' => [
                    'id' => $comment->getUser()->getId(),
                    'surname' => $comment->getUser()->getSurname(),
                    'name' => $comment->getUser()->getName()
                ],
                'Likes' => $comment->getLikes()
            ];
        }


        return $this->json($commentsNew);
    }
}
