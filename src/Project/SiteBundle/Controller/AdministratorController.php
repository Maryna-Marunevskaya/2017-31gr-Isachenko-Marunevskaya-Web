<?php

namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Project\SiteBundle\Form\EditType;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class AdministratorController extends Controller
{
    public function personalAction(){
        return $this->render('ProjectSiteBundle:administrator:personal.html.twig');
    }

    public function panelAction(){
        return $this->render('ProjectSiteBundle:administrator:panel.html.twig');
    }

    public function accountAction(){
        return $this->render('ProjectSiteBundle:administrator:account.html.twig');
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

                return $this->redirectToRoute('ProjectSiteBundle_administrator_personal_account');
            }
        }
        return $this->render('ProjectSiteBundle:administrator:edit.html.twig', array('form'=>$form->createView()));

    }
}
