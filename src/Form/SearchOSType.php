<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;


class SearchOSType extends AbstractType{

   public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder->add('nivEtude', ChoiceType::class,[
        'attr'=>['class'=>'btn btn-light dropdown-toggle'],
        'label' => 'Niveau d etude : ',
        'choices' => [
        'Secondaire' => 'Secondaire',
        'Bac' => 'Bac',
        'Bac+1' => 'Bac+1',
        'Bac+2' => 'Bac+2',
        'Bac+3' => 'Bac+3',
        'Bac+4' => 'Bac+4',
        'Bac+5' => 'Bac+5',
         ]]);
    $builder->add('certificat', ChoiceType::class,[
        'attr'=>['class'=>'btn btn-light dropdown-toggle'],
        'label' => 'Certificat : ',
    'choices' => [
        'Anglais' => 'Anglais',
        'Français' => 'Français',
        'Mecanique' => 'Mecanique',
        'Electrique' => 'Electrique',
        'Informatique' => 'Informatique',
        'Office' => 'Office',
    ]]);
    $builder->add('dateDebut', ChoiceType::class,[
        'attr'=>['class'=>'btn btn-light dropdown-toggle'],
        'label' => 'Date debut : ',
        'choices' => [
            'Dans une semaine' => new \DateTime('today + 7day'),
            'Dans un mois' => new \DateTime('today + 30day'),
            'Dans une Année' => new \DateTime('today + 365day'),

        ]]);
    $builder ->add('Recherche', SubmitType::class, ['attr'=>['class'=>'btn btn-primary btn-lg px-5']]);
}
}