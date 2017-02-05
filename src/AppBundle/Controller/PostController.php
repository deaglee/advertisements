<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Advertisement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * @Route("/post")
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request) {
        $notice = new Advertisement();

        /** @var FormBuilder $form */
        $form = $this->createFormBuilder($notice)
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('save', SubmitType::class);
        $form = $form->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advertisement = $form->getData();
            $advertisement->setUser($this->getUser());
            $advertisement->setDateCreated(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($notice);
            $em->flush();

            return $this->redirectToRoute("homepage");
        }

        return $this->render('inside/post.html.twig', [
            'form' => $form->createView()
        ]);
    }
}