<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            DateTimeField::new('date_created', 'Date de création'),
            DateField::new('date_end', 'Date de fin'),
            TextField::new('User.name', 'Créateur'),
        ];
    }
}
