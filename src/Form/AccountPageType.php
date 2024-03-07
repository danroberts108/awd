<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AccountPageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('api', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Enable API Access',
                'row_attr' => ['class' => 'form-switch']
            ])
            ->add('fname', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'First name cannot be blank'
                    ])
                ],
                'label' => 'First name'
            ])
            ->add('lname', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Last name cannot be blank'
                    ])
                ],
                'label' => 'Last name'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Save'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
