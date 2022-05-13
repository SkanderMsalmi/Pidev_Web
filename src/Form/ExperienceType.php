<?php

namespace App\Form;

use App\Entity\Experience;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotEqualTo;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('poste')
            ->add('societe')
            ->add('competanmiseenouvre')
            ->add('datedebut',DateType::class,[
                'widget'=>'single_text',
                'html5'=>'false',
                'attr'=>['class'=>'js-datepicker']
            ])
            ->add('datefin',DateType::class,[
                'widget'=>'single_text',
                'html5'=>'false',
                'attr'=>['class'=>'js-datepicker'],

            ])
            ->add('description')
            ->add('Enregistrer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
