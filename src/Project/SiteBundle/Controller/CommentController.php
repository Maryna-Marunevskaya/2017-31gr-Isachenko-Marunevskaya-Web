<?php

namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentController extends Controller
{
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $comment = $em->getRepository('ProjectSiteBundle:Comment')->find($id);

        if($comment){
            $em->remove($comment);
            $em->flush();
        }
        return $this->redirectToRoute('ProjectSiteBundle_comments');
    }
}
