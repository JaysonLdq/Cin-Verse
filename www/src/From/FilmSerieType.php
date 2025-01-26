<?php

namespace App\Form;

use App\Entity\FilmSerie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FilmSerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('release_date', DateTimeType::class, [
                'label' => 'Date de sortie',
                'widget' => 'single_text',
            ])
            ->add('image', FileType::class, [
                'label' => 'Image du film',
                'mapped' => false,  // Cela signifie que ce champ ne sera pas directement lié à l'entité
                'required' => false,  // L'image est optionnelle
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/gif',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Merci de choisir un format d\'image valide'
                    ])
                ],
                'attr' => ['class' => 'form-control']
            ])
            
            ->add('duration', IntegerType::class, [
                'label' => 'Durée (en minutes)',
            ])
            ->add('language', TextType::class, [
                'label' => 'Langues disponibles',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilmSerie::class,
        ]);
    }
}
