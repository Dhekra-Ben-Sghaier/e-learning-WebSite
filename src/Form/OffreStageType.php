<?php

namespace App\Form;

use App\Entity\OffreStage;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Choice;


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
            ->add('nivEtude', ChoiceType::class,[
                'label' => 'Niveau d etude : ',
                'attr'=>['class'=>'btn btn-light dropdown-toggle'],
                'choices' => [
                'Secondaire' => 'Secondaire',
                'Bac' => 'Bac',
                'Bac+1' => 'Bac+1',
                'Bac+2' => 'Bac+2',
                'Bac+3' => 'Bac+3',
                'Bac+4' => 'Bac+4',
                'Bac+5' => 'Bac+5',
                 ]])
            ->add('certificat', ChoiceType::class,[
                'attr'=>['class'=>'btn btn-light dropdown-toggle'],
                'label' => 'Certificat : ',
                'choices' => [
                    'Anglais' => 'Anglais',
                    'Français' => 'Français',
                    'Mecanique' => 'Mecanique',
                    'Electrique' => 'Electrique',
                    'Informatique' => 'Informatique',
                    'Office' => 'Office',
                ]])
            ->add('dateDebut')
            ->add('dateFin')
            ->add('logo', Filetype::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
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
