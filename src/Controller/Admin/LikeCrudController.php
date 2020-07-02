<?php

namespace App\Controller\Admin;

use App\Entity\Like;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class LikeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Like::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            IntegerField::new('User.id', 'Utilisateur'),
            IntegerField::new('Post.id', 'Initiative'),
            IntegerField::new('Comment.id', 'Commentaire')
        ];
    }
}
