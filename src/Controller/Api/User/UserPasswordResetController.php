<?php

namespace App\Controller\Api\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserPasswordResetController extends AbstractController
{
    private $manager;
    private $encoder;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    public function __invoke(User $data)
    {
        // TODO: Create a code field

        // TODO: Mail with a link for a new password
        return $this->json(['Email envoyé']);
    }
}
