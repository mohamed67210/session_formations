<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomStagiaire')
            ->add('prenomStagiaire')
            ->add('dateNaissanceStagiaire')
            ->add('sexeStagiaire')
            ->add('villeStagiaire')
            ->add('cpStagiaire')
            ->add('adresseStagiaire')
            ->add('mailStagiaire')
            ->add('telephoneStagiaire')
            // ->add('session', EntityType::class, ['class' => Session::class, 'choice_label' => 'intituleSession', 'attr' => ['class' => 'form-control']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-success']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
