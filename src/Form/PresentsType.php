<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PresentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $choices = [
            'Sjaal 1' => 'sjaal_1',
            'Sjaal 2' => 'sjaal_2',
            'Pet' => 'pet',
            'Vlag' => 'vlag',
        ];

        $builder 
        ->add('choiceField', ChoiceType::class, [
            'choices' => $choices,
            'expanded' => true,
            'multiple' => false,
            'choice_attr' => function($choice, $key, $value) use ($choices) {
                $imagePaths = [
                    'sjaal_1' => './public/Images/sjaal_1.jpg',
                    'sjaal_2' => './public/Images/sjaal_2.jpg',
                    'pet' => './public/Images/pet.jpg',
                    'vlag' => './public/Images/vlag.jpg',
                ];

                    $imagePath = $imagePaths[$value] ?? '';

                    return ['data-image' => $imagePath];
                },
                'required' => true,
                'label' => 'Kies hier je cadeau: ',
            ])
            ->add('submit', SubmitType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
