<?php
// src/Form/EmploiDuTempsType.php
namespace App\Form;

use App\Entity\EmploiDuTemps;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmploiDuTempsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('lieu')
            ->add('enseignant')
            ->add('jour', ChoiceType::class, [
                'choices' => [
                    'Lundi' => 'Lundi',
                    'Mardi' => 'Mardi',
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                    'Samedi' => 'Samedi',
                ],
                'placeholder' => 'Sélectionnez un jour',
            ])
            ->add('debut', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('fin', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('recurrence', ChoiceType::class, [
                'choices'  => [
                    'Aucune' => null,
                    'Quotidienne' => 'Quotidienne',
                    'Hebdomadaire' => 'Hebdomadaire',
                    'Mensuelle' => 'Mensuelle',
                ],
                'required' => false,
                'placeholder' => 'Sélectionner une récurrence',
            ])
            ->add('intervalle', IntegerType::class, [
                'required' => false,
                'attr' => ['min' => 1],
                'label' => 'Intervalle (ex : toutes les 2 semaines)',
            ])
            ->add('finRecurrence', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Date de fin de récurrence',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmploiDuTemps::class,
        ]);
    }
}
