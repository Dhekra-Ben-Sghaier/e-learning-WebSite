<?php

namespace App\Form;

use App\Entity\OffreTravail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreTravailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomSoc')
            ->add('adrMailSoc')
            ->add('adrSoc')
            ->add('description')
            ->add('datePub')
            ->add('nivEtude')
            ->add('certificat')
            ->add('typeContrat')
            ->add('idSociete')
            ->add('titre')
            ->add('valide')
            ->add('logo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OffreTravail::class,
        ]);
    }
}
