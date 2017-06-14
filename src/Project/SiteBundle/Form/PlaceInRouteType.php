<?php
namespace Project\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Project\SiteBundle\Entity\Place;
use Project\SiteBundle\Entity\Route;
use Project\SiteBundle\Entity\Repository\RouteRepository;

class PlaceInRouteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('place', EntityType::class, array('label'=>'Место','class' =>Place::class,'choice_label' => 'fullname','multiple' => false,'expanded' => false));
        $builder->add('route', EntityType::class, array('label'=>'Маршрут','class' =>Route::class,'choice_label' => 'name','multiple' => false,'expanded' => false, 'query_builder'=>function(RouteRepository $rr){ return $rr->createQueryBuilder('r')->select('r')->addOrderBy('r.name','ASC');}));
    }

     public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'placeinroute';
    }
}
