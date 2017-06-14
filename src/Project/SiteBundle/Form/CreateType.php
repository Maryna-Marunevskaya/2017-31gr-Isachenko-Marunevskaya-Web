<?php

namespace Project\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Project\SiteBundle\Entity\Role;
use Project\SiteBundle\Entity\Repository\RoleRepository;

class CreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, array('label'=>'Логин'));
        $builder->add('originalPassword', TextType::class, array('label'=>'Пароль'));
        $builder->add('role', EntityType::class, array('label'=>'Роль','class' =>Role::class,'choice_label' => 'display','multiple' => false,'expanded' => false, 'query_builder'=>function(RoleRepository $rr){ return $rr->createQueryBuilder('r')->select('r')->addOrderBy('r.display','ASC');}));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'create';
    }
}
