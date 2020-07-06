<?php

namespace App\Controller\Api\Post;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostFilterController extends AbstractController
{
    /**
     * @Route("/api/posts/filter", name="postFilter")
     */
    public function index(EntityManagerInterface $entityManager, Request $request)
    {
        // Resultat

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

        if(!is_null($param->get('tags'))){
            $splitTags = explode(',', $param->get('tags'));

            foreach ($splitTags as $tag){
                $filtre['tags'][] = $tag;
            }
        }

        if(!is_null($param->get('validated'))){
                $filtre['validated'][] = $param->get('validated');
        }

        if(!is_null($param->get('user'))){
            $splitTags = explode(',', $param->get('user'));

            foreach ($splitTags as $tag){
                $filtre['User'][] = $tag;
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

        dd($posts);

        return $this->json($posts, 200);
    }
}
