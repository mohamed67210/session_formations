<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formateur;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intituleSession')
            ->add('nombrePlace')
            ->add('dateDebut', DateType::class, ['widget' => 'single_text', 'attr' => ['class' => 'form-control']])
            ->add('dateFin', DateType::class, ['widget' => 'single_text', 'attr' => ['class' => 'form-control']])
            ->add('formation', EntityType::class, ['class' => Formation::class, 'choice_label' => 'intituleFormation', 'attr' => ['class' => 'form-control']])
            ->add('formateur', EntityType::class, ['class' => Formateur::class, 'choice_label' => 'nomFormateur', 'attr' => ['class' => 'form-control']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-success']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
