<?php

namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LetterController extends Controller
{
    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $letters = $em->getRepository('ProjectSiteBundle:Letter')->findAll();

        return $this->render('ProjectSiteBundle:letter:letter.html.twig', array('letters' => $letters));
    }

    public function showOneAction($id){
        $em = $this->getDoctrine()->getManager();

        $letter = $em->getRepository('ProjectSiteBundle:Letter')->find($id);

        if($letter){
            return $this->render('ProjectSiteBundle:letter:details.html.twig', array('letter' => $letter));
        }
        else{
             return $this->redirectToRoute('ProjectSiteBundle_all_letters');
        }
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $letter = $em->getRepository('ProjectSiteBundle:Letter')->find($id);

        if($letter){
            $em->remove($letter);
            $em->flush();
        }
        return $this->redirectToRoute('ProjectSiteBundle_all_letters');
    }
}
