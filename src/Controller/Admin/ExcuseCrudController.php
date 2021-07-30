<?php

namespace App\Controller\Admin;

use App\Entity\Excuse;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExcuseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Excuse::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextareaField::new('contenu'),
            DateTimeField::new('createdAt')->onlyOnIndex(),
            BooleanField::new('isActive')->onlyOnIndex(),
            TextField::new('auteur')
        ];
    }

    // On trie les infos avec created_at DESC
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['id' => 'DESC']);
    }

}
