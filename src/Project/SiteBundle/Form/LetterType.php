<?php

namespace Project\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LetterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fullname', TextType::class, array('label'=>'Полное имя'));
        $builder->add('phone', TextType::class, array('label'=>'Телефон(оставьте -, если не хотите указывать номер телефона)'));
        $builder->add('email', EmailType::class, array('label'=>'Email'));
        $builder->add('theme', TextType::class, array('label'=>'Тема'));
        $builder->add('content', TextareaType::class, array('label'=>'Текст письма', 'attr'=>array('style'=>'style="height: auto;" rows="6"')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }

    public function getBlockPrefix()
    {
        return 'letter';
    }
}
