<?php

namespace Minishop\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MinishopShopBundle:Default:index.html.twig', array('name' => $name));
    }
}
