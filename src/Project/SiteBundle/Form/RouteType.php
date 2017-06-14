<?php

namespace Project\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RouteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label'=>'Название маршрута'));
        $builder->add('shortdescription', TextType::class, array('label'=>'Краткое описание маршрута'));
        $builder->add('description', TextareaType::class, array('label'=>'Описание маршрута', 'attr'=>array('style'=>'style="height: auto;" rows="6"')));
        $builder->add('image', TextType::class, array('label'=>'Изображение маршрута'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'route';
    }
}
