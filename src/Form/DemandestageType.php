<?php

namespace App\Form;

use App\Entity\Demandestage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class DemandestageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etat',ChoiceType::class, array(
                'choices'=>array(
                    'En_attente'=>1, 'Accepte'=>2 , 'Refuse'=>3
                )
            ))
            ->add('idpersonne')
            ->add('idstage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demandestage::class,
        ]);
    }
}
