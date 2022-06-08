<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextareaType::class, [
            'attr' => array(
                'class' => 'block mt-8 mb-8 p-4 border border-zinc-700 border-0 w-full h-60 text-2xl',
                'placeholder' => 'Enter category title',
                'autocomplete' => 'off'
            ),
            'label' => false,
            'required' => false,
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
