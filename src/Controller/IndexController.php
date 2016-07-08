<?php

namespace Potogan\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Potogan\TestBundle\Entity\User;

/**
 * Index controller
 */

class IndexController extends Controller
{
  /**
  * Index page
  *
  * @Route("/")
  * @Method({"POST", "GET"})
  * @Template
  */
  public function indexAction(Request $request)
  {
    $user = new User();
    $form = $this->createFormBuilder($user)
          ->add('nom', TextType::class)
          ->add('prenom', TextType::class)
          ->add('email', TextType::class)
          ->add('mobile', TextType::class)
          ->add('pseudo', TextType::class, ['required' => false])
          ->add('twitter', TextType::class, ['required' => false])
          ->add('facebook', TextType::class, ['required' => false])
          ->add('save', SubmitType::class)
          ->getForm();
    $form->handleRequest($request);
    $errors = $this->get('validator')->validate($user);
    if(count($errors) > 0)
      {
        echo '<p class="error">Something went wrong </p>';
      }
    else if (($form->get('nom')->getData()))
      {
        echo '<p class="success">User saved!</p>';
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
      }
    return array('form' => $form->createView());
  }
}
