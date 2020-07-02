<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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
            DateField::new('date_created', 'Date de création'),
            DateField::new('date_end', 'Date de fin'),
            DateField::new('dateMeeting', 'Rendez-vous'),
            TextField::new('Department.name', 'Département')->onlyOnIndex(),
            AssociationField::new('likes', 'Goutte d\'eau')->onlyOnIndex(),
            AssociationField::new('subscriptions', 'Participant')->onlyOnIndex(),
            TextField::new('User.name', 'Créateur')->onlyOnIndex(),
        ];
    }
}
