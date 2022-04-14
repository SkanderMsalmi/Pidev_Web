<?php

namespace App\Form;

use App\Entity\Faculte;
use App\Entity\Societe;
use App\Entity\User;
use App\Repository\FaculteRepository;
use App\Repository\SocieteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('cin')
            ->add('email')
            ->add('role')
            ->add('pdp')
            ->add('datenaissance')
            ->add('profil')
            ->add('infos')
            ->add('note')
            ->add('idsociete',EntityType::class,[
                'class'=>Societe::class,
                'query_builder'=>function (SocieteRepository $er){
                return $er ->createQueryBuilder('u')
                        ->orderBy('u.nomsociete','ASC');
                },
                'choice_label'=>'nomsociete'
            ])
            ->add('idfaculte',EntityType::class,[
                'class'=> Faculte::class,
                'query_builder'=>function(FaculteRepository $er){
                return $er-> createQueryBuilder('u')
                        ->orderBy('u.nomfaculte','ASC');
                },
                'choice_label'=> 'nomfaculte'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
