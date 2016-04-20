<?php

namespace Potogan\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Index controller
 */
class IndexController extends Controller
{
    /**
     * Index page
     *
     * @Route("/")
     * @Method({"GET"})
     * @Template
     */
    public function indexAction()
    {
        return array();
    }
}
