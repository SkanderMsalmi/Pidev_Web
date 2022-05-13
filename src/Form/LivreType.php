<?php

namespace App\Form;

use App\Entity\Bibliotheque;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titrel')
            ->add('auteurl')
            ->add('descriptionl')
            ->add('pdfivre',FileType::class,
                ['mapped'=> false])
            ->add('image',FileType::class,
            ['mapped'=> false])

            ->add('intc',EntityType::class,[

                    'class'=> Bibliotheque::class,
                    'choice_label'=>'nomc'



                ]
            )
            ->add('ajouter', SubmitType::class);

    }

    public function search($term)
    {
        return $this->createQueryBuilder('livre')
            ->andWhere('livre.titrel = :titre')
            ->setParameter('titre', '%'.$term.'%')
            ->getQuery()
            ->getResult();
    }
}
