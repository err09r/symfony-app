<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
                    'class' => 'block mt-8 mb-8 p-4 border border-zinc-700 border-0 w-full text-3xl',
                    'placeholder' => 'Enter title',
                    'autocomplete' => 'off',
                ),
                'required' => false,
                'label' => false,
            ])
            ->add('description', TextareaType::class, [
                'attr' => array(
                    'class' => 'block mt-8 mb-8 p-4 border border-zinc-700 border-0 w-full text-3xl',
                    'placeholder' => 'Enter description',
                    'autocomplete' => 'off'
                ),
                'required' => false,
                'label' => false,
            ])
            ->add('content', TextareaType::class, [
                'attr' => array(
                    'class' => 'block mt-8 mb-8 p-4 border border-zinc-700 border-0 w-full text-3xl',
                    'placeholder' => 'Enter content',
                    'autocomplete' => 'off'
                ),
                'required' => false,
                'label' => false,
            ])
            ->add('imageSrc', FileType::class, array(
                'attr' => array(
                    'class' => 'mb-8',
                    'auto'
                ),
                'label' => 'Select image: ',
                'required' => false,
                'mapped' => false
            ))
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'expanded' => false,
                'attr' => array(
                    'class' => 'mb-8'
                ),
                'label' => 'Select category: '
            ])
            ->add('duration', IntegerType::class, array(
                'attr' => array(
                    'class' => 'mb-8'
                ),
                'label' => 'Duration, in minutes: ',
                'required' => false,
            ))
            ->add('isCommentable', CheckboxType::class, array(
                'attr' => array(
                    'class' => 'mb-8'
                ),
                'label' => 'Allow comments: ',
                'required' => false,
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // $resolver->setDefaults([
        //     'data_class' => Article::class,
        // ]);
    }
}
