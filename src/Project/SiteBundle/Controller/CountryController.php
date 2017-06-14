<?php

namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Project\SiteBundle\Entity\Country;
use Project\SiteBundle\Form\CountryType;

class CountryController extends Controller
{
    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $countries = $em->getRepository('ProjectSiteBundle:Country')->findAllOrderedByName();

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

    public function createAction(Request $request){
        $country = new Country();

        $form = $this->createForm(CountryType::class, $country);

        if($request->isMethod($request::METHOD_POST)){
             $form->handleRequest($request);

            if($form->isValid()){
                $name=$form['name']->getData();
                $shortdescription=$form['shortdescription']->getData();
                $description=$form['description']->getData();
                $image=$form['image']->getData();

                $country->setName($name);
                $country->setShortdescription($shortdescription);
                $country->setDescription($description);
                $country->setImage($image);

                $em=$this->getDoctrine()->getManager();

                $em->persist($country);
                $em->flush();

                return $this->redirectToRoute('ProjectSiteBundle_all_countries');
            }
        }

        return $this->render('ProjectSiteBundle:country:create.html.twig', array('form'=>$form->createView()));
    }

    public function editAction($id, Request $request){
        $country = $this->getDoctrine()->getRepository('ProjectSiteBundle:Country')->find($id);

        if($country){
            $form = $this->createForm(CountryType::class, $country);

            if($request->isMethod($request::METHOD_POST)){
                $form->handleRequest($request);

                if($form->isValid()){
                    $name=$form['name']->getData();
                    $shortdescription=$form['shortdescription']->getData();
                    $description=$form['description']->getData();
                    $image=$form['image']->getData();

                    $country->setName($name);
                    $country->setShortdescription($shortdescription);
                    $country->setDescription($description);
                    $country->setImage($image);

                    $em=$this->getDoctrine()->getManager();

                    $em->persist($country);
                    $em->flush();

                    return $this->redirectToRoute('ProjectSiteBundle_all_countries');
                }
            }
            return $this->render('ProjectSiteBundle:country:edit.html.twig', array('country' => $country,'form'=>$form->createView()));
        }
        else{
            return $this->redirectToRoute('ProjectSiteBundle_country_create');
        }
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $country = $em->getRepository('ProjectSiteBundle:Country')->find($id);

        if($country){
            if(sizeof($country->getCities())==0){
                $em->remove($country);
                $em->flush();
            }
        }
        return $this->redirectToRoute('ProjectSiteBundle_all_countries');
    }
}
