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

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->manager = $entityManager;
    }

    public function __invoke(Post $data)
    {
        $data = $data->getComments();

        $commentsNew = [];

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
