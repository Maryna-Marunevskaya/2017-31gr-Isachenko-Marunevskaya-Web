<?php
namespace Project\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Project\SiteBundle\Entity\TouristInTrip;
class TouristInTripController extends Controller
{
    public function showAllAction(){
        $em = $this->getDoctrine()->getManager();

        $touristsInTrip = $em->getRepository('ProjectSiteBundle:TouristInTrip')->findAllOrderedByTrip();

        return $this->render('ProjectSiteBundle:touristintrip:touristintrip.html.twig', array('touristsInTrip' => $touristsInTrip));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $touristintrip = $em->getRepository('ProjectSiteBundle:TouristInTrip')->find($id);

        if($touristintrip)
        {
            $now=new \DateTime();
            $before = date_diff($now, $touristintrip->getTrip()->getStartDate());
            $daysBefore=$before->format('%a');
            if(( ($daysBefore>=7) && ($now<$touristintrip->getTrip()->getStartDate())) || ($now>=$touristintrip->getTrip()->getFinishDate())){
                $em->remove($touristintrip);
                $em->flush();
            }
        }

        return $this->redirectToRoute('ProjectSiteBundle_all_touristsintrip');
    }

    public function joinAction($id){
        $now=new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $trips=$user->getTrips();

        foreach($trips as $trip){
            if($trip->getTrip()->getId()==$id){
                return $this->redirectToRoute('ProjectSiteBundle_tourist_personal_panel');
            }
        }

        $trip = $em->getRepository('ProjectSiteBundle:Trip')->find($id);

        if($trip)
        {
            $before = date_diff($now, $trip->getStartDate());
            $daysBefore=$before->format('%a');

            if(($daysBefore>=7)&&($now<$trip->getStartDate())&&(sizeof($trip->getTouristsInTrip())<$trip->getMaxNumOfTourists())){
                $tourist=new TouristInTrip();
                $tourist->setTourist($user);
                $tourist->setTrip($trip);
                $em->persist($tourist);
                $em->flush();
            }
        }
        return $this->redirectToRoute('ProjectSiteBundle_tourist_personal_panel');
    }

    public function leaveAction($id){
        $now=new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $trips=$user->getTrips();

        foreach($trips as $trip){
            if($trip->getTrip()->getId()==$id){
                $before = date_diff($now, $trip->getTrip()->getStartDate());
                $daysBefore=$before->format('%a');
                if( (($daysBefore>=7) && ($now<$trip->getTrip()->getStartDate())) || ($now>=$trip->getTrip()->getFinishDate()) ) {
                    $em->remove($trip);
                    $em->flush();
                }
                break;
            }
        }
        return $this->redirectToRoute('ProjectSiteBundle_tourist_personal_panel');
    }
}
