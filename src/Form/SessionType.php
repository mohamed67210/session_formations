<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formateur;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intituleSession',TextType::class,['label'=>'Intitulé ','attr' => ['class' => 'input']])
            ->add('nombrePlace',NumberType::class,['label'=>'Nombre de place','attr' => ['class' => 'input']])
            ->add('dateDebut', DateType::class, ['widget' => 'single_text', 'attr' => ['class' => 'input']])
            ->add('dateFin', DateType::class, ['widget' => 'single_text', 'attr' => ['class' => 'input']])
            ->add('formation', EntityType::class, ['class' => Formation::class, 'choice_label' => 'intituleFormation', 'attr' => ['class' => 'input']])
            ->add('formateur', EntityType::class, ['class' => Formateur::class, 'choice_label' => 'nomFormateur', 'attr' => ['class' => 'input']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'green']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
