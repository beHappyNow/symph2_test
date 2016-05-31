<?php

namespace AppBundle\Form;

use AppBundle\Form\CategoryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class,['label'=>'Title'])
            ->add('body',TextareaType::class)
            ->add('date',DateTimeType::class)
//          ->add('date',DateTimeType::class,['widget'=>'single_text'])
            ->add('published',RadioType::class)
            ->add('country', CountryType::class)
            ->add('category', CategoryType::class)
            ->add('save_Article',SubmitType::class,['label'=>'Submit'])
            ;
    }

    public function getName()
    {
        return 'artice';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            ['data_class' => 'AppBundle\Entity\Article',
             'validation_groups' => array('registration'),
            ]);
    }
}