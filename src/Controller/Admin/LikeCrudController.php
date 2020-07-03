<?php

namespace App\Controller\Admin;

use App\Entity\Like;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Goutte d\'eau')
            ->setEntityLabelInPlural('Gouttes d\'eau')
//            ->setEntityPermission('ROLE_ADMIN')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
//            ->add('User')
//            ->add('Post')
//            ->add('Comment')
        ;
    }
}
