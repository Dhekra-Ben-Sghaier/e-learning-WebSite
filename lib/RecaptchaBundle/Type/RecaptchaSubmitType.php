<?php

namespace App\RecaptchaBundle\Type;



use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecaptchaSubmitType extends AbstractType{


    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
           'mapped'=>false

       ]);
    }

    public function getBlockPrefix()
    {
        return 'recaptchasubmit';
    }

    public function getParent()
    {
        return TextType::class;
    }
}