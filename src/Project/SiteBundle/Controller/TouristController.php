<?php

namespace Project\SiteBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Project\SiteBundle\Form\EditType;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TouristController extends Controller
{
    public function personalAction(){
        return $this->render('ProjectSiteBundle:tourist:personal.html.twig');
    }

    public function panelAction(){
        return $this->render('ProjectSiteBundle:tourist:panel.html.twig');
    }

    public function accountAction(){
        return $this->render('ProjectSiteBundle:tourist:account.html.twig');
    }

    public function editAction(Request $request){
        $user = $this->getUser();

        $form = $this->createForm(EditType::class, $user);

        if($request->isMethod($request::METHOD_POST)){
            $form->handleRequest($request);

            if($form->isValid()){
                $username=$form['username']->getData();
                $password=$form['originalPassword']->getData();

                $user->setUsername($username);

                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $encodedpassword = $encoder->encodePassword($password, $user->getSalt());
                $user->setOriginalPassword($password);
                $user->setPassword($encodedpassword);

                $em = $this->getDoctrine()->getManager();

                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('ProjectSiteBundle_tourist_personal_account');
            }
        }
        return $this->render('ProjectSiteBundle:tourist:edit.html.twig', array('form'=>$form->createView()));

    }
}
