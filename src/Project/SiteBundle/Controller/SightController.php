<?php
namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Project\SiteBundle\Entity\Sight;
use Project\SiteBundle\Form\SightType;

class SightController extends Controller
{
    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $sights = $em->getRepository('ProjectSiteBundle:Sight')->findAllOrderedByFullname();

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

    public function createAction(Request $request){
        $sight = new Sight();

        $form = $this->createForm(SightType::class, $sight);

        if($request->isMethod($request::METHOD_POST)){
             $form->handleRequest($request);

            if($form->isValid()){
                $name=$form['name']->getData();
                $shortdescription=$form['shortdescription']->getData();
                $description=$form['description']->getData();
                $image=$form['image']->getData();
				$city=$form['city']->getData();

                $sight->setName($name);
                $sight->setShortdescription($shortdescription);
                $sight->setDescription($description);
                $sight->setImage($image);
				$sight->setCity($city);

                $em=$this->getDoctrine()->getManager();

                $em->persist($sight);
                $em->flush();

                return $this->redirectToRoute('ProjectSiteBundle_all_sights');
            }
        }

        return $this->render('ProjectSiteBundle:sight:create.html.twig', array('form'=>$form->createView()));
    }

    public function editAction($id, Request $request){
        $sight = $this->getDoctrine()->getRepository('ProjectSiteBundle:Sight')->find($id);

        if($sight){
            $form = $this->createForm(SightType::class, $sight);

            if($request->isMethod($request::METHOD_POST)){
                $form->handleRequest($request);

                if($form->isValid()){
                    $name=$form['name']->getData();
                    $shortdescription=$form['shortdescription']->getData();
                    $description=$form['description']->getData();
                    $image=$form['image']->getData();
				    $city=$form['city']->getData();

                    $sight->setName($name);
                    $sight->setShortdescription($shortdescription);
                    $sight->setDescription($description);
                    $sight->setImage($image);
				    $sight->setCity($city);

                    $em=$this->getDoctrine()->getManager();

                    $em->persist($sight);
                    $em->flush();

                    return $this->redirectToRoute('ProjectSiteBundle_all_sights');
                }
            }
            return $this->render('ProjectSiteBundle:sight:edit.html.twig', array('sight' => $sight,'form'=>$form->createView()));
        }
        else{
            return $this->redirectToRoute('ProjectSiteBundle_sight_create');
        }
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $sight = $em->getRepository('ProjectSiteBundle:Sight')->find($id);

        if($sight){
            $placesInRoute=$em->getRepository('ProjectSiteBundle:PlaceInRoute')->findByPlace($id);
            if(sizeof($placesInRoute)==0){
                $em->remove($sight);
                $em->flush();
            }
        }
        return $this->redirectToRoute('ProjectSiteBundle_all_sights');
    }
}
