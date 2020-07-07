<?php

namespace App\Controller\Api\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class UserPasswordResetController extends AbstractController
{
    private $manager;
    private $mailer;

    /**
     * UserPasswordResetController constructor.
     * @param EntityManagerInterface $entityManager
     * @param MailerInterface $mailer
     */
    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer)
    {
        $this->manager = $entityManager;
        $this->mailer = $mailer;
    }

    /**
     * @param User $data
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function __invoke(User $data)
    {
        //Add a token for reset password
        $token = bin2hex(random_bytes(15));
        $data->setPasswordToken($token);
        $this->manager->persist($data);
        $this->manager->flush();

        // Création de l'email
        //TODO: Ajouter la vrai URL du front
        $email = new TemplatedEmail();

        $email
            ->from('contact.onde.projet@gmail.com')
            ->to(new Address($data->getEmail()))
            ->subject('Onde - Réinitialisation de votre mot de passe')
            ->htmlTemplate('mailer/reset-password.html.twig')
            ->context([
                'user' => $data
            ]);

        //Envoi de l'Email
        $this->mailer->send($email);

        return $this->json(['message' => 'mail envoyé']);
    }
}
