<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Department;
use App\Entity\Like;
use App\Entity\Post;
use App\Entity\Tags;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Vous devez être connecté pour accéder à cette page');
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Onde - Manager')
            ->setTranslationDomain('admin')
        ;
    }

    public function configureMenuItems(): iterable
    {
        if($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_PARTENAIRE')){
            yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

            yield MenuItem::section('Initiatives');
            yield MenuItem::linkToCrud('Initiatives', 'icon class', Post::class);
        }

        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::linkToCrud('Commentaires', 'icon class', Comment::class);
            yield MenuItem::linkToCrud('Departements', 'icon class', Department::class);
            yield MenuItem::linkToCrud('Tags', 'icon class', Tags::class);
            yield MenuItem::linkToCrud('Goutte d\'eau', 'icon class', Like::class);

            yield MenuItem::section('----');
            yield MenuItem::linkToCrud('Utilisateurs', 'icon class', User::class);



        }
    }
}
