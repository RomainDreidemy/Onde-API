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
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Vous devez être connecté pour accéder à cette page');
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());

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



        if($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_MODO')){
            yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

            yield MenuItem::section('Api');
            yield MenuItem::linktoRoute('Documentation', 'fas fa-book', 'api_entrypoint')->setLinkTarget('_blank');

            yield MenuItem::section('Initiatives');
            yield MenuItem::linkToCrud('Initiatives', 'far fa-newspaper', Post::class);
        }

        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::linkToCrud('Commentaires', 'far fa-comments', Comment::class);
            yield MenuItem::linkToCrud('Departements', 'fas fa-map-marker-alt', Department::class);
            yield MenuItem::linkToCrud('Tags', 'fas fa-tags', Tags::class);
            yield MenuItem::linkToCrud('Goutte d\'eau', 'fa fa-tint', Like::class);

            yield MenuItem::section('----');
            yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        }
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            ->setName($user->getSurname() . ' ' . $user->getName())

            // use this method if you don't want to display the name of the user
//            ->displayUserName(false)

            // you can return an URL with the avatar image
            // use this method if you don't want to display the user image
            ->displayUserAvatar(false)
            // you can also pass an email address to use gravatar's service
            ->setGravatarEmail($user->getUsername())

            // you can use any type of menu item, except submenus
            ->addMenuItems([
                MenuItem::linkToCrud('Mon profile', 'fa fa-id-card', User::class)->setAction('detail')->setEntityId($user->getId()),
                MenuItem::section(),
            ])
        ;
    }
}
