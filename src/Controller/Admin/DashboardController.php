<?php

namespace App\Controller\Admin;

use App\Entity\Department;
use App\Entity\Like;
use App\Entity\Post;
use App\Entity\Tags;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Onde - Manager');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'icon class', User::class);
        yield MenuItem::linkToCrud('Initiatives', 'icon class', Post::class);
        yield MenuItem::linkToCrud('Departements', 'icon class', Department::class);
        yield MenuItem::linkToCrud('Tags', 'icon class', Tags::class);
        yield MenuItem::linkToCrud('Goutte d\'eau', 'icon class', Like::class);
    }
}
