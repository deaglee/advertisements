<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdvertisementsController extends Controller
{
   /**
    * @Route("/advertisements", name="advertisements")
    */
   public function showAction(Request $request)
   {
       $userId = $this->getUser()->getId();
       $advertisements = $this->getDoctrine()->getRepository('AppBundle:Advertisement')->findBy([
           'user' => [
               'id' => $userId
           ]
       ], ['dateCreated' => 'DESC']);

       return $this->render('inside/advertisements.html.twig',[
           'advertisements' => $advertisements
       ]);
   }
}