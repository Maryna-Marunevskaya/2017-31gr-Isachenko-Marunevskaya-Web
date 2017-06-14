<?php
namespace Project\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Project\SiteBundle\Entity\Route;
use Project\SiteBundle\Entity\Repository\RouteRepository;

class TripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('route', EntityType::class, array('label'=>'Маршрут','class' =>Route::class,'choice_label' => 'name','multiple' => false,'expanded' => false, 'query_builder'=>function(RouteRepository $rr){ return $rr->createQueryBuilder('r')->select('r')->addOrderBy('r.name','ASC');}));
       $builder->add('startDate', DateTimeType::class, array('label'=>'Дата и время начала', 'date_widget'=>'single_text', 'time_widget'=>'single_text'));
        $builder->add('finishDate', DateTimeType::class, array('label'=>'Дата и время окончания', 'date_widget'=>'single_text', 'time_widget'=>'single_text'));
       $builder->add('maxNumOfTourists', IntegerType::class, array('label'=>'Максимальное число туристов в поездке'));
       $builder->add('shortdescription', TextType::class, array('label'=>'Краткое описание поездки'));
        $builder->add('description', TextareaType::class, array('label'=>'Описание поездки', 'attr'=>array('style'=>'style="height: auto;" rows="6"')));
        $builder->add('image', TextType::class, array('label'=>'Изображение поездки'));
    }
   public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'trip';
    }
}
