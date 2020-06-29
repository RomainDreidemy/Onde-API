<?php

namespace App\Controller\Api\Comment;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CommentGetWithUserController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->manager = $entityManager;
    }

    public function __invoke(Comment $data)
    {
        $commentsNew = [
            'id' => $data->getId(),
            'text' => $data->getText(),
            'User' => [
                'id' => $data->getUser()->getId(),
                'surname' => $data->getUser()->getSurname(),
                'name' => $data->getUser()->getName()
            ],
            'Likes' => $data->getLikes()
        ];

        return $this->json($commentsNew);
    }
}
