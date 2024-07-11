<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Book1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // $builder
        //     ->add('titre')
        //     ->add('auteur')
        //     ->add('description')
        //     ->add('prix')
        //     ->add('categorie')
        //     ->add('image')
        // ;
        $builder
        ->add('titre', null, [
            'attr' => ['class' => 'custom-form'],
        ])
        ->add('auteur', null, [
            'attr' => ['class' => 'custom-form'],
        ])
        ->add('description', null, [
            'attr' => ['class' => 'custom-form'],
        ])
        ->add('prix', null, [
            'attr' => ['class' => 'custom-form'],
        ])
        ->add('categorie', null, [
            'attr' => ['class' => 'custom-form'],
        ])
        ->add('image', null, [
            'attr' => ['class' => 'custom-form'],
        ]);





    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);

        // $resolver->setDefaults([
        //     'data_class' => Book::class,
        //     'attr' => ['class' => 'custom-form'], // Ajoutez la classe CSS globale ici
        // ]);

         
       
    }
}
