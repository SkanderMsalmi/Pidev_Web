<?php

namespace App\Form;

use App\Entity\Faculte;
use App\Entity\Societe;
use App\Entity\User;
use App\Repository\FaculteRepository;
use App\Repository\SocieteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $builder->getData();

        $builder
            ->add('role',ChoiceType::class,[
                    'choices'=> [
                        'Etudiant'=>'Etudiant',
                        'Recruteur'=>'Recruteur',
                        'Formateur'=>'Formateur'
                    ],
                    'expanded'=>'true'
                ]
            )
            ->add('username')
            ->add('password',PasswordType::class)
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('cin')
            ->add('email')

            ->add('datenaissance',DateType::class,[
                'widget'=>'single_text',
                'html5'=>'false',
                'attr'=>['class'=>'js-datepicker']
            ])

            ->add('profil')
            ->add('infos',TextareaType::class)
            ->add('Inscip',SubmitType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
