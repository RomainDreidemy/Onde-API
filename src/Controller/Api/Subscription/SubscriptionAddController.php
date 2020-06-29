<?php

namespace App\Controller\Api\Subscription;

use App\Entity\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SubscriptionAddController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->manager = $entityManager;
    }

    public function __invoke(Subscription $data) : Subscription
    {
        $subscriptions = $data->getPost()->getSubscriptions();
        $goals = $data->getPost()->getPostGoals();

        foreach ($goals as $goal){
            if($goal->getDone() !== true){
                if($goal->getNumber() <= (count($subscriptions) + 1)){
                    $goal->setDone(true);
                    $this->manager->persist($goal);

                    //Todo envoyer un mail
                }
            }
        }

        $this->manager->persist($data);
        $this->manager->flush();

        return $data;
    }
}
