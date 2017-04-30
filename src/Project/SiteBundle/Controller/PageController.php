<?php

namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Project\SiteBundle\Entity\User;
use Project\SiteBundle\Form\TrainingUserForm;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjectSiteBundle:Page:index.html.twig');
    }
    public function addAction(Request $request)
    {
        $user = new User();

    $form = $this->createForm(TrainingUserForm::class, $user);

    if ($request->isMethod($request::METHOD_POST)) {
      $form->handleRequest($request);

        if ($form->isValid()) {
            // Perform some action, such as sending an email

            // Redirect - This is important to prevent users re-posting
            // the form if they refresh the page
            return $this->redirect($this->generateUrl('ProjectSiteBundle_add'));
        }
    }

    return $this->render('ProjectSiteBundle:Page:add.html.twig', array(
        'form' => $form->createView()
    ));
    }
}
