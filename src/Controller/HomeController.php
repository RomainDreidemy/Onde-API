<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $comments = $entityManager->getRepository(Comment::class)->findAll();

        $commentsNew = [];

        foreach ($comments as $comment){
            $commentsNew[] = [
                'id' => $comment->getId(),
                'text' => $comment->getText(),
                'User' => $comment->getUser()
            ];
        }

        return $this->json($commentsNew);
    }
}
