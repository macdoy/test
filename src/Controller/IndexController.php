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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Potogan\TestBundle\Entity\User;
use Symfony\Component\Security\Acl\Exception\Exception;
use Potogan\TestBundle\FileUploader\FileUploader;

/**
 * Index controller
 */
class IndexController extends Controller
{
    /**
    * Index page
    * @Route("/")
    * @Method({"POST", "GET"})
    * @Template
    */
    public function indexAction(Request $request)
    {
        $user = new User;
        $dir = '/../../web/upload';
        $allowed = array('png', 'bmp', 'gif', 'jpg', 'jpeg');
        $uploader = $this->get('potogan_test.file_uploader.file_uploader');

        try {
            $uploader->upload($dir, $allowed, $user);
        } catch (Exception $e) {
            return new Response (__DIR__.$dir.' is in another castle!');
        }

        $form = $this->createFormBuilder($user)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', TextType::class)
            ->add('mobile', TextType::class)
            ->add('pseudo', TextType::class, ['required' => false])
            ->add('twitter', TextType::class, ['required' => false])
            ->add('facebook', TextType::class, ['required' => false])
            ->add('file', FileType::class, ['required' => false])
            ->add('save', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $uploader->upload($dir, $allowed, $user);
        }

        return array('form' => $form->createView(), 'error' => $form->isValid(), 'nom' => $user->getNom());
    }
}
