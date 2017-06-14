<?php
namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Project\SiteBundle\Entity\User;
use Project\SiteBundle\Entity\Role;
use Project\SiteBundle\Form\RegistrationType;
use Project\SiteBundle\Form\CreateType;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class UserController extends Controller
{
    public function signupAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        if($request->isMethod($request::METHOD_POST)){
             $form->handleRequest($request);

            if($form->isValid()){
                $username=$form['username']->getData();
                $password=$form['password']->getData();

                $user->setUsername($username);
                $user->setSalt(md5(time()));

                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $encodedpassword = $encoder->encodePassword($password, $user->getSalt());
                $user->setOriginalPassword($password);
                $user->setPassword($encodedpassword);

                $em = $this->getDoctrine()->getManager();
                $role = $em->getRepository('ProjectSiteBundle:Role')->findbyRole('ROLE_TOURIST');

                $user->setRole($role);
                $user->addRole($role);

                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('ProjectSiteBundle_homepage');
            }
        }

        return $this->render('ProjectSiteBundle:common:registration.html.twig', array('form'=>$form->createView()));
    }

    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('ProjectSiteBundle:User')->findAllOrderedByName();

        return $this->render('ProjectSiteBundle:user:user.html.twig', array('users' => $users));
    }

    public function showOneAction($id){
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('ProjectSiteBundle:User')->find($id);

        if($user){
            return $this->render('ProjectSiteBundle:user:details.html.twig', array('user' => $user));
        }
        else{
             return $this->redirectToRoute('ProjectSiteBundle_all_users');
        }
    }

    public function createAction(Request $request){
        $user = new User();

        $form = $this->createForm(CreateType::class, $user);

        if($request->isMethod($request::METHOD_POST)){
             $form->handleRequest($request);

            if($form->isValid()){
                $username=$form['username']->getData();
                $password=$form['originalPassword']->getData();
                $role=$form['role']->getData();

                $user->setUsername($username);
                $user->setSalt(md5(time()));

                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $encodedpassword = $encoder->encodePassword($password, $user->getSalt());
                $user->setOriginalPassword($password);
                $user->setPassword($encodedpassword);

                $em = $this->getDoctrine()->getManager();

                $user->addRole($role);
                $user->setRole($role);

                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('ProjectSiteBundle_all_users');
            }
        }
        return $this->render('ProjectSiteBundle:user:create.html.twig', array('form'=>$form->createView()));
    }

    public function editAction($id, Request $request){
        $user = $this->getDoctrine()->getRepository('ProjectSiteBundle:User')->find($id);

        if($user){
            if($this->getUser()->getUsername()!=$user->getUsername()){
            $form = $this->createForm(CreateType::class, $user);

            if($request->isMethod($request::METHOD_POST)){
                $form->handleRequest($request);

                if($form->isValid()){
                    $username=$form['username']->getData();
                    $password=$form['originalPassword']->getData();
                    $role=$form['role']->getData();

                    $user->setUsername($username);

                    $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                    $encodedpassword = $encoder->encodePassword($password, $user->getSalt());
                    $user->setOriginalPassword($password);
                    $user->setPassword($encodedpassword);

                    $em = $this->getDoctrine()->getManager();

                    $roles=$user->getRoles();
                    foreach($roles as $r){
                        $user->removeRole($r);
                    }

                    $user->addRole($role);
                    $user->setRole($role);

                    $em->persist($user);
                    $em->flush();

                    return $this->redirectToRoute('ProjectSiteBundle_all_users');
                }
            }
            return $this->render('ProjectSiteBundle:user:edit.html.twig', array('user'=>$user, 'form'=>$form->createView()));
            }
            else{
               return $this->redirectToRoute('ProjectSiteBundle_all_users');
            }
        }
        else{
            return $this->redirectToRoute('ProjectSiteBundle_user_create');
        }
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('ProjectSiteBundle:User')->find($id);

        if($user){
            if($this->getUser()->getUsername()!=$user->getUsername()){
                if(sizeof($user->getTrips())==0){
                    $em->remove($user);
                    $em->flush();
                }
            }
        }
        return $this->redirectToRoute('ProjectSiteBundle_all_users');
    }
}
