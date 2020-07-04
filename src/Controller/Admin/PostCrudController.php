<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            TextareaField::new('description', 'Description'),
            DateField::new('date_created', 'Date de création'),
//            DateField::new('date_end', 'Date de fin'),
            DateTimeField::new('dateMeeting', 'Rendez-vous'),
            TextField::new('Department.name', 'Département')->hideOnForm(),
            AssociationField::new('likes', 'Goutte d\'eau')->hideOnForm(),
            AssociationField::new('subscriptions', 'Participant')->hideOnForm(),
//            TextField::new('User.name', 'Créateur')->hideOnForm(),
            BooleanField::new('validated', 'Validé'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Initiative')
            ->setEntityLabelInPlural('Initiatives')
//            ->setEntityPermission('ROLE_ADMIN')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('date_created')
            ->add('date_end')
            ->add('dateMeeting')
            ->add('validated')
        ;
    }
}
