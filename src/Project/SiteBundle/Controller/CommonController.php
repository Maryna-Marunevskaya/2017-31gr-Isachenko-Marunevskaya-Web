<?php
namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Project\SiteBundle\Entity\Letter;
use Project\SiteBundle\Form\LetterType;
use Project\SiteBundle\Entity\Comment;
use Project\SiteBundle\Form\CommentType;

class CommonController extends Controller
{
    public function mainAction()
    {
        return $this->render('ProjectSiteBundle:common:main.html.twig');
    }

    public function contactsAction(Request $request)
    {
        $letter = new Letter();

        $form = $this->createForm(LetterType::class, $letter);

        if($request->isMethod($request::METHOD_POST)){
             $form->handleRequest($request);

            if($form->isValid()){

                $fullname=$form['fullname']->getData();
                $phone=$form['phone']->getData();
                $email=$form['email']->getData();
                $theme=$form['theme']->getData();
                $content=$form['content']->getData();

                $letter->setCreated(new \DateTime());
                $letter->setFullname($fullname);
                $letter->setPhone($phone);
                $letter->setEmail($email);
                $letter->setTheme($theme);
                $letter->setContent($content);

                $em=$this->getDoctrine()->getManager();
                $em->persist($letter);
                $em->flush();

                return $this->redirectToRoute('ProjectSiteBundle_contacts');
            }
        }

        return $this->render('ProjectSiteBundle:common:contacts.html.twig', array('form'=>$form->createView()));
    }

    public function commentsAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('ProjectSiteBundle:Comment')->findAllOrderedByDate();

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        if($request->isMethod($request::METHOD_POST)){
             $form->handleRequest($request);

            if($form->isValid()){
                $text=$form['comment']->getData();
                $user=$this->getUser();
                $comment->setCreated(new \DateTime());
                $comment->setUser($user);
                $comment->setComment($text);
                $em->persist($comment);
                $em->flush();

                return $this->redirectToRoute('ProjectSiteBundle_comments');
            }
        }

        return $this->render('ProjectSiteBundle:common:comments.html.twig', array('comments'=>$comments,'form'=>$form->createView()));
    }
}
