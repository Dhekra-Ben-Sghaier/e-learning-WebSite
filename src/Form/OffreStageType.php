<?php

namespace App\Form;

use App\Entity\OffreStage;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class OffreStageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, ['attr'=>['class'=>'form-control form-control-lg']])
            ->add('nomSoc', TextType::class, ['attr'=>['class'=>'form-control form-control-lg']])
            ->add('adrMailSoc',EmailType::class, ['attr'=>['class'=>'form-control form-control-lg']])
            ->add('adrSoc',TextType::class, ['attr'=>['class'=>'form-control form-control-lg']])
            ->add('description',TextType::class, ['attr'=>['class'=>'form-control form-control-lg']])
            ->add('nivEtude', TextType::class, ['attr'=>['class'=>'form-control form-control-lg']])
            ->add('certificat', TextType::class, ['attr'=>['class'=>'form-control form-control-lg']])
            ->add('dateDebut')
            ->add('dateFin')
            ->add('duree', NumberType::class, ['attr'=>['class'=>'form-control form-control-lg']])
            //->add('logo', Filetype::class)
            ->add('Ajouter offre', SubmitType::class, ['attr'=>['class'=>'btn btn-primary btn-lg px-5']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OffreStage::class,
        ]);
    }
}
