<?php

namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CountryController extends Controller
{
    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $countries = $em->getRepository('ProjectSiteBundle:Country')->findAll();

        return $this->render('ProjectSiteBundle:country:country.html.twig', array('countries' => $countries));
    }

    public function showOneAction($id){
        $em = $this->getDoctrine()->getManager();

        $country = $em->getRepository('ProjectSiteBundle:Country')->find($id);

        if($country){
            return $this->render('ProjectSiteBundle:country:details.html.twig', array('country' => $country));
        }
        else{
             return $this->redirectToRoute('ProjectSiteBundle_all_countries');
        }
    }
}
