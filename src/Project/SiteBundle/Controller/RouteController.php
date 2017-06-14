<?php
namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Project\SiteBundle\Entity\Route;
use Project\SiteBundle\Form\RouteType;

class RouteController extends Controller
{
    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $routes = $em->getRepository('ProjectSiteBundle:Route')->findAllOrderedByName();

        return $this->render('ProjectSiteBundle:route:route.html.twig', array('routes' => $routes));
    }

    public function showOneAction($id){
        $em = $this->getDoctrine()->getManager();

        $route = $em->getRepository('ProjectSiteBundle:Route')->find($id);

        if($route){
            return $this->render('ProjectSiteBundle:route:details.html.twig', array('route' => $route));
        }
        else{
             return $this->redirectToRoute('ProjectSiteBundle_all_routes');
        }
    }

    public function createAction(Request $request){
        $route = new Route();

        $form = $this->createForm(RouteType::class, $route);

        if($request->isMethod($request::METHOD_POST)){
             $form->handleRequest($request);

            if($form->isValid()){
                $name=$form['name']->getData();
                $shortdescription=$form['shortdescription']->getData();
                $description=$form['description']->getData();
                $image=$form['image']->getData();

                $route->setName($name);
                $route->setShortdescription($shortdescription);
                $route->setDescription($description);
                $route->setImage($image);

                $em=$this->getDoctrine()->getManager();

                $em->persist($route);
                $em->flush();

                return $this->redirectToRoute('ProjectSiteBundle_all_routes');
            }
        }

        return $this->render('ProjectSiteBundle:route:create.html.twig', array('form'=>$form->createView()));
    }

     public function editAction($id, Request $request){
        $route = $this->getDoctrine()->getRepository('ProjectSiteBundle:Route')->find($id);

        if($route){
            $form = $this->createForm(RouteType::class, $route);

            if($request->isMethod($request::METHOD_POST)){
				$form->handleRequest($request);

				if($form->isValid()){
				    $name=$form['name']->getData();
				    $shortdescription=$form['shortdescription']->getData();
				    $description=$form['description']->getData();
				    $image=$form['image']->getData();

				    $route->setName($name);
				    $route->setShortdescription($shortdescription);
				    $route->setDescription($description);
				    $route->setImage($image);

				    $em=$this->getDoctrine()->getManager();

				    $em->persist($route);
				    $em->flush();

				    return $this->redirectToRoute('ProjectSiteBundle_all_routes');
				}
            }
            return $this->render('ProjectSiteBundle:route:edit.html.twig', array('route' => $route,'form'=>$form->createView()));
		}
        else{
            return $this->redirectToRoute('ProjectSiteBundle_route_create');
        }
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $route = $em->getRepository('ProjectSiteBundle:Route')->find($id);

        if($route){
            $trips = $em->getRepository('ProjectSiteBundle:Trip')->findByRoute($id);
            if(sizeof($trips)==0){
                $em->remove($route);
                $em->flush();
            }
        }
        return $this->redirectToRoute('ProjectSiteBundle_all_routes');
    }
}
