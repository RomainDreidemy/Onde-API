<?php

namespace App\Controller\Api\Subscription;

use App\Entity\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SubscriptionAddController extends AbstractController
{
    private $manager;
    private $mailer;

    /**
     * SubscriptionAddController constructor.
     * @param EntityManagerInterface $entityManager
     * @param MailerInterface $mailer
     */
    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer)
    {
        $this->manager = $entityManager;
        $this->mailer = $mailer;
    }

    /**
     * @param Subscription $data
     * @return Subscription|\Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function __invoke(Subscription $data)
    {
        // Récupère les objectifs
        $goals = $data->getPost()->getPostGoals();

        // Vérifie si la combinaison User Subscription existe déjà
        $alreadyExist = $this->manager->getRepository(Subscription::class)->findOneBy(['User' => $data->getUser(), 'Post' => $data->getPost()]);

        if(!is_null($alreadyExist)){
            return $this->json([
                'error' => 'L\'utilisateur est déjà abonné à cette initiative.'
            ], 500);
        }

        $this->manager->persist($data);
        $this->manager->flush();

        $subscriptions = $data->getPost()->getSubscriptions();

        foreach ($goals as $goal){
            if($goal->getDone() !== true){

                // Si un objectif est atteind
                if($goal->getNumber() === count($subscriptions)){

                    $goal->setDone(true);
                    $this->manager->persist($goal);
                    $this->manager->flush();

                    foreach ($subscriptions as $subscription){
                        $user = $subscription->getUser();
                        // On envoi un mail à tous les abonnées du post
                        $mail = (new TemplatedEmail())
                            ->from('contact.onde.projet@gmail.com')
                            ->to(new Address($user->getEmail()))
                            ->subject('Onde - Objectif atteint : ' . $goal->getName())
                            ->htmlTemplate('mailer/goal-done.html.twig')
                            ->context([
                                'user' => $user,
                                'goal' => $goal
                            ]);

                        $this->mailer->send($mail);
                    }
                }
            }
        }



        return $data;
    }
}
