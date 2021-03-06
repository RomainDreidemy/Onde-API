<?php

namespace App\Controller\Api\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCreateController extends AbstractController
{
    private $manager;
    private $encoder;

    /**
     * UserCreateController constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->manager = $entityManager;
        $this->encoder = $encoder;
    }

    /**
     * @param User $data
     * @return User
     */
    public function __invoke(User $data) : User
    {
        // Encodage du mot de passe
        $data->setPassword($this->encoder->encodePassword($data, $data->getPassword()));

        $this->manager->persist($data);
        $this->manager->flush();

        return $data;
    }
}
