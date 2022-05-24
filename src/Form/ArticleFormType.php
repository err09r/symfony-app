<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => array(
                    'class' => 'block my-8 p-4 border border-zinc-700 border-0 w-full text-3xl',
                    'placeholder' => 'Enter title',
                ),
                'label' => false,
                'required' => false
            ])
            ->add('description', TextareaType::class, [
                'attr' => array(
                    'class' => 'block my-8 p-4 border border-zinc-700 border-0 w-full text-3xl',
                    'placeholder' => 'Enter description'
                ),
                'label' => false,
                'required' => false,
            ])
            ->add('content', TextareaType::class, [
                'attr' => array(
                    'class' => 'block my-8 p-4 border border-zinc-700 border-0 w-full text-3xl',
                    'placeholder' => 'Enter content'
                ),
                'label' => false,
                'required' => false,
            ])
            ->add('imageSrc', FileType::class, array(
                'required' => false,
                'mapped' => false
            ))
            ->add('duration', IntegerType::class, array(
                'required' => false,
                'mapped' => false
            ))
            // ->add('actors')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // $resolver->setDefaults([
        //     'data_class' => Article::class,
        // ]);
    }
}
