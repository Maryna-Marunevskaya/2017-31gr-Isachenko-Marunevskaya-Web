<?php

namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CityController extends Controller
{
    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $cities = $em->getRepository('ProjectSiteBundle:City')->findAll();

        return $this->render('ProjectSiteBundle:city:city.html.twig', array('cities' => $cities));
    }

    public function showOneAction($id){
        $em = $this->getDoctrine()->getManager();

        $city = $em->getRepository('ProjectSiteBundle:City')->find($id);

        if($city){
            return $this->render('ProjectSiteBundle:city:details.html.twig', array('city' => $city));
        }
        else{
             return $this->redirectToRoute('ProjectSiteBundle_all_cities');
        }
    }
}
