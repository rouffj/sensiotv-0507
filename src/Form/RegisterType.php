<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', Type\TextType::class)
            ->add('last_name')
            ->add('email', Type\EmailType::class)
            ->add('phone', Type\TelType::class)
            ->add('password', Type\RepeatedType::class, [
                'type' => Type\PasswordType::class,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('terms', Type\CheckboxType::class, [
                'label' => 'Click here to indicate that you have read and agree to the terms presented in the Terms and Conditions agreement'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
