<?php
namespace Project\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Project\SiteBundle\Entity\Country;
use Project\SiteBundle\Entity\Repository\CountryRepository;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label'=>'Название города'));
        $builder->add('shortdescription', TextType::class, array('label'=>'Краткое описание города'));
        $builder->add('description', TextareaType::class, array('label'=>'Описание города', 'attr'=>array('style'=>'style="height: auto;" rows="6"')));
        $builder->add('image', TextType::class, array('label'=>'Изображение города'));
        $builder->add('country', EntityType::class, array('label'=>'Страна','class' =>Country::class,'choice_label' => 'name','multiple' => false,'expanded' => false, 'query_builder'=>function(CountryRepository $cr){ return $cr->createQueryBuilder('c')->select('c')->addOrderBy('c.name','ASC');}));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'city';
    }
}
