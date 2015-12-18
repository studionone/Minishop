<?php

namespace Minishop\ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Minishop\ShopBundle\Entity\Product;
use Minishop\ShopBundle\Form\ProductType;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{

    /**
     * Lists all Product entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MinishopShopBundle:Product')->findAll();
        $categories = $em->getRepository('MinishopShopBundle:Category')->findAll();

        return $this->render('MinishopShopBundle:Product:index.html.twig', array(
            'entities' => $entities,
            'categories' => $categories
        ));
    }

    /**
     * Finds and displays a Product entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MinishopShopBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }


//        return $this->render('MinishopShopBundle:Product:show.html.twig', array(
//            'entity'      => $entity
//        ));
        return new Response('<div class="product_detail">
<div class="product_images"><img src="default_image.png" /></div>
<div class="product_details"><ul>
<li>'.$entity->getBrand().'</li>
<li>'.$entity->getName().'</li>
<li>'.$entity->getPrice().'</li>
<li>'.$entity->getDescription().'</li>
</ul></div></div>');
    }

}
