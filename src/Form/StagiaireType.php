<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomStagiaire', TextType::class, ['attr' => ['class' => 'input']])
            ->add('prenomStagiaire', TextType::class, ['attr' => ['class' => 'input']])
            ->add('dateNaissanceStagiaire', DateTimeType::class, ['attr' => ['class' => 'input']])
            ->add('sexeStagiaire', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'homme',
                    'Femme' => 'femme',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('villeStagiaire', TextType::class, ['attr' => ['class' => 'input']])
            ->add('cpStagiaire', NumberType::class, ['attr' => ['class' => 'input']])
            ->add('adresseStagiaire', TextType::class, ['attr' => ['class' => 'input']])
            ->add('mailStagiaire', TextType::class, ['attr' => ['class' => 'input']])
            ->add('telephoneStagiaire', NumberType::class, ['attr' => ['class' => 'input']])
            // ->add('sessions', EntityType::class, [
            //     'class' => Session::class, 'attr' => ['class' => 'form-control']
            // ])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-success'], 'label' => 'ok']);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
