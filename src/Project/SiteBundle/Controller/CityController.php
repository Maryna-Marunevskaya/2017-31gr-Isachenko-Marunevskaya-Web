<?php
namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Project\SiteBundle\Entity\City;
use Project\SiteBundle\Form\CityType;

class CityController extends Controller
{
    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $cities = $em->getRepository('ProjectSiteBundle:City')->findAllOrderedByFullname();

        return $this->render('ProjectSiteBundle:city:city.html.twig', array('cities' => $cities));
    }

    public function showOneAction($id){
        $em = $this->getDoctrine()->getManager();

        $city = $em->getRepository('ProjectSiteBundle:City')->find($id);

        if($city){
            return $this->render('ProjectSiteBundle:city:details.html.twig', array('city' => $city));
        }
        else{
             return $this->redirectToRoute('ProjectSiteBundle_all_cities');
        }
    }

    public function createAction(Request $request){
        $city = new City();

        $form = $this->createForm(CityType::class, $city);

        if($request->isMethod($request::METHOD_POST)){
             $form->handleRequest($request);

            if($form->isValid()){
                $name=$form['name']->getData();
                $shortdescription=$form['shortdescription']->getData();
                $description=$form['description']->getData();
                $image=$form['image']->getData();
				$country=$form['country']->getData();

                $city->setName($name);
                $city->setShortdescription($shortdescription);
                $city->setDescription($description);
                $city->setImage($image);
				$city->setCountry($country);

                $em=$this->getDoctrine()->getManager();

                $em->persist($city);
                $em->flush();

                return $this->redirectToRoute('ProjectSiteBundle_all_cities');
            }
        }

        return $this->render('ProjectSiteBundle:city:create.html.twig', array('form'=>$form->createView()));
    }

    public function editAction($id, Request $request){
        $city = $this->getDoctrine()->getRepository('ProjectSiteBundle:City')->find($id);

        if($city){
            $form = $this->createForm(CityType::class, $city);

            if($request->isMethod($request::METHOD_POST)){
                $form->handleRequest($request);

                if($form->isValid()){
                    $name=$form['name']->getData();
                    $shortdescription=$form['shortdescription']->getData();
                    $description=$form['description']->getData();
                    $image=$form['image']->getData();
				    $country=$form['country']->getData();

                    $city->setName($name);
                    $city->setShortdescription($shortdescription);
                    $city->setDescription($description);
                    $city->setImage($image);
				    $city->setCountry($country);

                    $em=$this->getDoctrine()->getManager();

                    $em->persist($city);
                    $em->flush();

                    return $this->redirectToRoute('ProjectSiteBundle_all_cities');
                }
            }
            return $this->render('ProjectSiteBundle:city:edit.html.twig', array('city' => $city,'form'=>$form->createView()));
        }
        else{
            return $this->redirectToRoute('ProjectSiteBundle_city_create');
        }
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $city = $em->getRepository('ProjectSiteBundle:City')->find($id);

        if($city){
            if(sizeof($city->getSights())==0){
                $placesInRoute=$em->getRepository('ProjectSiteBundle:PlaceInRoute')->findByPlace($id);
                if(sizeof($placesInRoute)==0){
                    $em->remove($city);
                    $em->flush();
                }
            }
        }
        return $this->redirectToRoute('ProjectSiteBundle_all_cities');
    }
}
