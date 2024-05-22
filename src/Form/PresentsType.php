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
            'expanded' => true, // Display as radio buttons
            'multiple' => false, // Allow only one selection
            'choice_attr' => function($choice, $key, $value) use ($choices) {
                // Define image paths for each choice
                $imagePaths = [
                    'sjaal_1' => 'Images/sjaal_1.jpg',
                    'sjaal_2' => 'Images/sjaal_2.jpg',
                    'pet' => 'Images/pet.jpg',
                    'vlag' => 'Images/vlag.jpg',
                ];

                    // Retrieve image path for the current choice
                    $imagePath = $imagePaths[$value] ?? '';

                    // Set data-image attribute with the image path
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
