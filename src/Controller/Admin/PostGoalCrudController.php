<?php

namespace App\Controller\Admin;

use App\Entity\PostGoal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PostGoalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PostGoal::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
