<?php

namespace Project\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Project\SiteBundle\Entity\City;
use Project\SiteBundle\Entity\Repository\CityRepository;

class SightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label'=>'Название достопримечательности'));
        $builder->add('shortdescription', TextType::class, array('label'=>'Краткое описание достопримечательности'));
        $builder->add('description', TextareaType::class, array('label'=>'Описание достопримечательности', 'attr'=>array('style'=>'style="height: auto;" rows="6"')));
        $builder->add('image', TextType::class, array('label'=>'Изображение достопримечательности'));
        $builder->add('city', EntityType::class, array('label'=>'Город','class' =>City::class,'choice_label' =>'fullname','multiple' => false,'expanded' => false, 'query_builder'=>function(CityRepository $cr){return $cr->createQueryBuilder('c')->select('c')->innerJoin('c.country','Project\SiteBundle\Entity\Country')->addOrderBy('Project\SiteBundle\Entity\Country.name','ASC')->addOrderBy('c.name','ASC');}));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'sight';
    }
}
