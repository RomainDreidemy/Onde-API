<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $entityManager, Request $request)
    {

        $param = $request->query;

        if(is_null(is_null($param->get('type')))){
            return $this->json(['error' => 'Le paramètre type est requis'], 404);
        }

        $filtre = [];
        $type = '';

        if(!is_null($param->get('department'))){
            $splitDepartment = explode(',', $param->get('department'));

            foreach ($splitDepartment as $dep){
                $filtre['department'][] = $dep;
            }
        }

        if(!is_null($param->get('type'))){
            $type = $param->get('type');
        }

        if(!is_null($param->get('limit'))){
            $limit = $param->get('limit');
        }
//            dd($filtre);

        $posts = $entityManager->getRepository(Post::class)->findByCritere($type, $filtre, ($limit ?? null));


        return $this->json($posts, 200);
    }
}
