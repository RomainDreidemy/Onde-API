<?php

namespace App\Controller\Api\Tags;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TagsGetAllController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    public function __invoke(Post $data)
    {
        $tags = [];

        foreach ($data->getTags() as $tag){
            $tags['normal'][] = ['id' => $tag->getId(), 'name' => $tag->getName()];
        }

        $tags['department'] = ['id' => $data->getDepartment()->getId(), 'name' => $data->getDepartment()->getName()];

        if(in_array('ROLE_PARTENAIRE', $data->getUser()->getRoles())){
            $tags['partenaire'] = ['id' => $data->getUser()->getId(), 'name' => $data->getUser()->getName()];
        }

        return $this->json($tags);
    }
}