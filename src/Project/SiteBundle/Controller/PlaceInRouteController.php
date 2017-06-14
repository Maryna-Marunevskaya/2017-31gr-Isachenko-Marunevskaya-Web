<?php
namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Project\SiteBundle\Entity\PlaceInRoute;
use Project\SiteBundle\Form\PlaceInRouteType;

class PlaceInRouteController extends Controller
{
    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $placesInRoute = $em->getRepository('ProjectSiteBundle:PlaceInRoute')->findAll();

        return $this->render('ProjectSiteBundle:placeinroute:placeinroute.html.twig', array('placesInRoute' => $placesInRoute));
    }

    public function showOneAction($id){
        $em = $this->getDoctrine()->getManager();

        $placeInRoute = $em->getRepository('ProjectSiteBundle:PlaceInRoute')->find($id);

        if($placeInRoute){
            return $this->render('ProjectSiteBundle:placeinroute:details.html.twig', array('placeInRoute' => $placeInRoute));
        }
        else{
             return $this->redirectToRoute('ProjectSiteBundle_all_placesinroute');
        }
    }

    public function createAction(Request $request)
    {
        $placeInRoute = new PlaceInRoute();

        $form = $this->createForm(PlaceInRouteType::class, $placeInRoute);

        if($request->isMethod($request::METHOD_POST)){
             $form->handleRequest($request);

            if($form->isValid()){
                $place=$form['place']->getData();
                $route=$form['route']->getData();

                $placeInRoute->setPlace($place);
                $placeInRoute->setRoute($route);

                $em=$this->getDoctrine()->getManager();

                $trips = $em->getRepository('ProjectSiteBundle:Trip')->findByRoute($route->getId());

                if(sizeof($trips)==0){
                    $em->persist($placeInRoute);
                    $em->flush();

                    return $this->redirectToRoute('ProjectSiteBundle_all_placesinroute');
                }
            }
        }

        return $this->render('ProjectSiteBundle:placeinroute:create.html.twig', array('form'=>$form->createView()));
    }

    public function editAction($id, Request $request){
        $placeInRoute = $this->getDoctrine()->getRepository('ProjectSiteBundle:PlaceInRoute')->find($id);

        if($placeInRoute){
            $em=$this->getDoctrine()->getManager();
            $oldtrips=$em->getRepository('ProjectSiteBundle:Trip')->findByRoute($placeInRoute->getRoute()->getId());

            if(sizeof($oldtrips)==0){
                $form = $this->createForm(PlaceInRouteType::class, $placeInRoute);

                if($request->isMethod($request::METHOD_POST)){
                    $form->handleRequest($request);

                    if($form->isValid()){
                        $place=$form['place']->getData();
                        $route=$form['route']->getData();

                        $newtrips = $em->getRepository('ProjectSiteBundle:Trip')->findByRoute($route->getId());

                        if(sizeof($newtrips)==0){
                            $placeInRoute->setPlace($place);
                            $placeInRoute->setRoute($route);
                            $em->persist($placeInRoute);
                            $em->flush();
                            return $this->redirectToRoute('ProjectSiteBundle_all_placesinroute');
                        }
                    }
                }
                return $this->render('ProjectSiteBundle:placeinroute:edit.html.twig', array('placeInRoute' => $placeInRoute,'form'=>$form->createView()));
            }
            else{
                return $this->redirectToRoute('ProjectSiteBundle_all_placesinroute');
            }
		}
        else{
            return $this->redirectToRoute('ProjectSiteBundle_placeinroute_create');
        }
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $placeInRoute=$em->getRepository('ProjectSiteBundle:PlaceInRoute')->find($id);

        if($placeInRoute){
            $trips = $em->getRepository('ProjectSiteBundle:Trip')->findByRoute($placeInRoute->getRoute()->getId());
            if(sizeof($trips)==0){
                $em->remove($placeInRoute);
                $em->flush();
            }
        }
        return $this->redirectToRoute('ProjectSiteBundle_all_placesinroute');
    }
}
