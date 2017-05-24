<?php

namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SightController extends Controller
{
    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $sights = $em->getRepository('ProjectSiteBundle:Sight')->findAll();

        return $this->render('ProjectSiteBundle:sight:sight.html.twig', array('sights' => $sights));
    }

    public function showOneAction($id){
        $em = $this->getDoctrine()->getManager();

        $sight = $em->getRepository('ProjectSiteBundle:Sight')->find($id);

        if($sight){
            return $this->render('ProjectSiteBundle:sight:details.html.twig', array('sight' => $sight));
        }
        else{
             return $this->redirectToRoute('ProjectSiteBundle_all_sights');
        }
    }
}
