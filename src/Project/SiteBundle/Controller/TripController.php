<?php
namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Project\SiteBundle\Entity\Trip;
use Project\SiteBundle\Form\TripType;

use Symfony\Component\Form\FormError;

class TripController extends Controller
{
    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $trips = $em->getRepository('ProjectSiteBundle:Trip')->findAllOrderedByDate();

        return $this->render('ProjectSiteBundle:trip:trip.html.twig', array('trips' => $trips));
    }

    public function showOneAction($id){
        $em = $this->getDoctrine()->getManager();

        $trip = $em->getRepository('ProjectSiteBundle:Trip')->find($id);

        if($trip){
            return $this->render('ProjectSiteBundle:trip:details.html.twig', array('trip' => $trip));
        }
        else{
             return $this->redirectToRoute('ProjectSiteBundle_all_trips');
        }
    }

    public function createAction(Request $request)
    {
        $trip = new Trip();

        $form = $this->createForm(TripType::class, $trip);

        if($request->isMethod($request::METHOD_POST)){
             $form->handleRequest($request);

            if($form->isValid()){
                $now=new \DateTime();
                $route=$form['route']->getData();
                $startDate=$form['startDate']->getData();
                $finishDate=$form['finishDate']->getData();
                $maxNumOfTourists=$form['maxNumOfTourists']->getData();
                $shortdescription=$form['shortdescription']->getData();
                $description=$form['description']->getData();
                $image=$form['image']->getData();

                $before = date_diff($now, $startDate);
                $daysBefore=$before->format('%a');
                if( ($daysBefore>=14) && ($now<$startDate) ){
                    $duration=date_diff($startDate, $finishDate);
                    $hoursDuration=$duration->format('%h');
                    if( ($hoursDuration>=3) && ($startDate<$finishDate) ){
                       {
                            $trip->setRoute($route);
                            $trip->setStartDate($startDate);
                            $trip->setFinishDate($finishDate);
                            $trip->setMaxNumOfTourists($maxNumOfTourists);
                            $trip->setShortdescription($shortdescription);
                            $trip->setDescription($description);
                            $trip->setImage($image);
                            $em=$this->getDoctrine()->getManager();

                            $em->persist($trip);
                            $em->flush();
                            return $this->redirectToRoute('ProjectSiteBundle_all_trips');
                        }
                    }
                }
            }
        }

        return $this->render('ProjectSiteBundle:trip:create.html.twig', array('form'=>$form->createView()));
    }

    public function editAction($id, Request $request)
    {
        $trip=$this->getDoctrine()->getRepository('ProjectSiteBundle:Trip')->find($id);

        if($trip){
            if(sizeof($trip->getTouristsInTrip())==0){
                $form = $this->createForm(TripType::class, $trip);

                if($request->isMethod($request::METHOD_POST)){
                    $form->handleRequest($request);

                    if($form->isValid()){
                        $now=new \DateTime();
                        $route=$form['route']->getData();
                        $startDate=$form['startDate']->getData();
                        $finishDate=$form['finishDate']->getData();
                        $maxNumOfTourists=$form['maxNumOfTourists']->getData();
                        $shortdescription=$form['shortdescription']->getData();
                        $description=$form['description']->getData();
                        $image=$form['image']->getData();

                        $before = date_diff($now, $startDate);
                        $daysBefore=$before->format('%a');
                        if( ($daysBefore>=14) && ($now<$startDate) ){
                            $duration=date_diff($startDate, $finishDate);
                            $hoursDuration=$duration->format('%h');
                            if( ($hoursDuration>=3) && ($startDate<$finishDate) ){
                                $trip->setRoute($route);
                                $trip->setStartDate($startDate);
                                $trip->setFinishDate($finishDate);
                                $trip->setMaxNumOfTourists($maxNumOfTourists);
                                $trip->setShortdescription($shortdescription);
                                $trip->setDescription($description);
                                $trip->setImage($image);
                                $em=$this->getDoctrine()->getManager();

                                $em->persist($trip);
                                $em->flush();
                                return $this->redirectToRoute('ProjectSiteBundle_all_trips');
                            }
                        }
                    }
                }

                return $this->render('ProjectSiteBundle:trip:edit.html.twig', array('trip'=>$trip,'form'=>$form->createView()));
            }
            else{
                return $this->redirectToRoute('ProjectSiteBundle_all_trips');
            }
        }
        else{
            return $this->redirectToRoute('ProjectSiteBundle_trip_create');
        }
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $trip = $em->getRepository('ProjectSiteBundle:Trip')->find($id);

        if($trip)
        {
            if(sizeof($trip->getTouristsInTrip())==0){
                $em->remove($trip);
                $em->flush();
            }
            else{
                $now = new \DateTime();
                if($now>=$trip->getFinishDate()){
                    $em->remove($trip);
                    $em->flush();
                }
            }
        }

        return $this->redirectToRoute('ProjectSiteBundle_all_trips');
    }

    public function deleteAllFinishedAction(){
        $em = $this->getDoctrine()->getManager();

        $trips = $em->getRepository('ProjectSiteBundle:Trip')->findAll();

        $now = new \DateTime();
        foreach($trips as $trip){
            if($now>=$trip->getFinishDate()){
                $em->remove($trip);
            }
        }
        $em->flush();
        return $this->redirectToRoute('ProjectSiteBundle_all_trips');
    }
}
