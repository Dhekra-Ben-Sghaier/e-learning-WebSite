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
        'label' => 'Niveau d etude : ',
        'choices' => [
            'Null' => null,
        'Secondaire' => 'Secondaire',
        'Bac' => 'Bac',
        'Bac+1' => 'Bac+1',
        'Bac+2' => 'Bac+2',
        'Bac+3' => 'Bac+3',
        'Bac+4' => 'Bac+4',
        'Bac+5' => 'Bac+5',
         ]]);
    $builder->add('certificat', ChoiceType::class,[
        'label' => 'Certificat : ',
    'choices' => [
        'Null' => null,
        'Anglais' => 'Anglais',
        'Français' => 'Français',
        'Mecanique' => 'Mecanique',
        'Electrique' => 'Electrique',
        'Informatique' => 'Informatique',
        'Office' => 'Office',
    ]]);
    $builder->add('dateDebut', ChoiceType::class,[
        'label' => 'Date debut : ',
        'choices' => [
            'Null' => null,
            'Dans une semaine' => new \DateTime('today + 7day'),
            'Dans un mois' => new \DateTime('today + 30day'),
            'Dans une Année' => new \DateTime('today + 365day'),

        ]]);
    $builder ->add('Recherche', SubmitType::class, ['attr'=>['class'=>'btn btn-primary btn-lg px-5']]);
}
}