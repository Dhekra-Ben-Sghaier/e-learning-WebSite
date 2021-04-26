<?php

namespace App\Form;

use App\Entity\OffreTravail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchOTType extends AbstractType
{
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
        $builder->add('datePub', ChoiceType::class,[
            'attr'=>['class'=>'btn btn-light dropdown-toggle'],
            'label' => 'Date publication : ',
            'choices' => [
                'Il y a une semaine' => new \DateTime('today - 7day'),
                'Il y a un mois' => new \DateTime('today - 30day'),
                'Il y a une année' => new \DateTime('today - 365day'),

            ]]);
        $builder ->add('Recherche', SubmitType::class, ['attr'=>['class'=>'btn btn-primary btn-lg px-5']]);
    }


}
