<?php

namespace App\Form;

use App\Entity\Publicite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PubliciteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('domaine')
            ->add('affichage')
            ->add('image', FileType::class, [ 'label' => false,
                'multiple' => true,
                'mapped'   =>false,
                'required' =>false,

            ])
            ->add('prix')
            ->add('lien')
            ->add('Save',SubmitType::class,['label'=>'Publicité'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Publicite::class,
        ]);
    }
}
