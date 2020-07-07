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

    /**
     * PostTopController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    /**
     * @return array
     */
    public function __invoke() : array
    {
        // Retourne les Post avec le plus de like
        return $this->manager->getRepository(Post::class)->findByTop(10);;
    }
}
