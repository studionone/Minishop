<?php

namespace Minishop\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MinishopBackendBundle:Default:index.html.twig', array('name' => $name));
    }
}
