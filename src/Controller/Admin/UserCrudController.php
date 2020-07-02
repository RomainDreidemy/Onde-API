<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FilterConfigDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('surname', 'Prénom'),
            TextField::new('name', 'Nom'),
            TextField::new('email'),
            TextField::new('password', 'Mot de passe')->onlyWhenCreating()->onlyWhenUpdating(),
            TextField::new('fonction'),
            ArrayField::new('roles'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')
//            ->setEntityPermission('ROLE_ADMIN')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setDateFormat('long')
            // ...
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('surname')
            ->add('name')
            ->add('email')
            ->add('fonction')
            ->add('roles')
            ;
    }
}
