<?php

namespace App\Controller\Api\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserPasswordChangeController extends AbstractController
{
    private $manager;
    private $encoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->manager = $entityManager;
        $this->encoder = $encoder;
    }

    public function __invoke(User $data)
    {
        $data
            ->setPassword($this->encoder->encodePassword($data, $data->getPassword()))
            ->setPasswordToken(null)
        ;

        $this->manager->persist($data);
        $this->manager->flush();

        return $data;
    }
}
