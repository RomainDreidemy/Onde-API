<?php

namespace App\Controller\Api\Post;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PostTopController extends AbstractController
{
    private $manager;
    private $encoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->manager = $entityManager;
        $this->encoder = $encoder;
    }

    public function __invoke() : array
    {
        return $this->manager->getRepository(Post::class)->findByTop(10);;
    }
}
