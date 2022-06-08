<?php

namespace App\Form;

use App\Entity\Poll;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PollFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('option1_title', TextareaType::class, array(
                "mapped" => false,
                
            ))
            ->add('option2_title', TextareaType::class, array(
                "mapped" => false,
                
            ))
            ->add('option3_title', TextareaType::class, array(
                "mapped" => false,
                
            ))
            ->add('option4_title', TextareaType::class, array(
                "mapped" => false,
                
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // $resolver->setDefaults([
        //     'data_class' => Poll::class,
        // ]);
    }
}
