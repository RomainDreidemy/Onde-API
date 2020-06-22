<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCreateController extends AbstractController
{
    private $manager;
    private $encoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->manager = $entityManager;
        $this->encoder = $encoder;
    }

    public function __invoke(User $data) : User
    {
        $data->setPassword($this->encoder->encodePassword($data, $data->getPassword()));

        $this->manager->persist($data);
        $this->manager->flush();

        return $data;
    }
}
