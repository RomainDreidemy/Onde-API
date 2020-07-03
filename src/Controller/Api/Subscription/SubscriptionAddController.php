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

    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer)
    {
        $this->manager = $entityManager;
        $this->mailer = $mailer;
    }

    public function __invoke(Subscription $data)
    {
        $goals = $data->getPost()->getPostGoals();

        $alreadyExist = $this->manager->getRepository(Subscription::class)->findOneBy(['User' => $data->getUser(), 'Post' => $data->getPost()]);

//        return $this->json([count($subscriptions) + 1, ]);

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

                if($goal->getNumber() === count($subscriptions)){

                    $goal->setDone(true);
                    $this->manager->persist($goal);
                    $this->manager->flush();

                    foreach ($subscriptions as $subscription){
                        $user = $subscription->getUser();

                        $mail = (new TemplatedEmail())
                            ->from('contact.onde.projet@gmail.com')
                            ->to(new Address($user->getEmail()))
                            ->subject('Onde - Objectif atteind : ' . $goal->getName())
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
