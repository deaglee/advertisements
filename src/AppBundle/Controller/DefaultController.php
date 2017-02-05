<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $advertisements = $this->getDoctrine()->getRepository('AppBundle:Advertisement')->findBy([], [
            'dateCreated' => 'DESC'
        ]);
        return $this->render('outside/index.html.twig', [
            'advertisements' => $advertisements,
        ]);
    }
}
