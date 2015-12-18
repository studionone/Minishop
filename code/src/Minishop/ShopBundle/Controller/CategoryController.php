<?php

namespace Minishop\ShopBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Minishop\ShopBundle\Entity\Category;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{

    /**
     * Lists all Category entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MinishopShopBundle:Category')->findAll();

        return $this->render('MinishopShopBundle:Category:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Category entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MinishopShopBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        return $this->render('MinishopShopBundle:Category:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
