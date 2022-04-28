<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Quiz;
use App\Repository\QuestionRepository;
use Doctrine\DBAL\Types\StringType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class QuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder->add("domaine", EntityType::class,[
            'class'=> Question::class,
            'query_builder' => function(QuestionRepository $qr){
                return $qr->createQueryBuilder('u')->groupBy("u.domaine");
            },
            'choice_label' => 'domaine',
        ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
