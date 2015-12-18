<?php

namespace Minishop\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Minishop\ShopBundle\Entity\Product;
use Minishop\ShopBundle\Entity\Category;
use Minishop\ShopBundle\Form\ProductType;
use Symfony\Component\Form\Form;

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
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager()
        ->createQuery(
            'SELECT p, c FROM MinishopShopBundle:Product p
                 JOIN p.category c ORDER BY p.category ASC, p.id'
        );
    $entities = $em->getResult();

    $cate = $this->getDoctrine()->getManager()
        ->createQuery(
            'SELECT c FROM MinishopShopBundle:Category c'
        );

    $category_entities = $cate->getResult();

    $product = new Product();
    $form = $this->createCreateForm($product);

    if ($request) {
      $form->handleRequest($request);

      if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_product_show', array('id' => $product->getId())));
      }
    }
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('admin_product_show', array('id' => $entity->getId())));
//        }

    return $this->render('MinishopBackendBundle:Product:index.html.twig', array(
        'entities' => $entities,
        'category_entities' => $category_entities,
        'entity' => $product,
        'form'   => $form->createView(),
    ));
  }
  /**
   * Creates a new Product entity.
   *
   */
  public function createAction(Request $request)
  {
    $category_id = $request->request->get('minishop_shopbundle_product')['category'];
    $category = $this->getCategory($category_id);
    $product = new Product();
    $product->setCategory($category);

    $form = $this->createForm(new ProductType(), $product);
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($product);
      $em->flush();

      $response = new Response(json_encode(array(
          'id' => $product->getId(),
          'name' => $product->getName(),
          'brand' => $product->getBrand(),
          'description' => $product->getDescription(),
          'price' => $product->getPrice(),
          'category' => $product->getCategory()->getName(),
          'product_link' => $this->generateUrl('admin_product_show', array('id' => $product->getId())),
          'product_edit_link' => "'".$this->generateUrl('admin_product_edit', array('id' => $product->getId()))."'"
      )));
      $response->headers->set('Content-Type', 'application/json');
      return $response;
//      if($request->isXmlHttpRequest()) {
//      } else {
//        return $this->redirect($this->generateUrl('admin_product_show', array('id' => $product->getId())));
//      }

    }
    return $this->render('MinishopBackendBundle:Product:new.html.twig', array(
        'entity' => $product,
        'form'   => $form->createView(),
    ));
  }

  /**
   * Creates a form to create a Product entity.
   *
   * @param Product $entity The entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createCreateForm(Product $entity)
  {
    $form = $this->createForm(new ProductType(), $entity, array(
        'action' => $this->generateUrl('admin_product_create'),
        'method' => 'POST',
    ));

    $form->add('submit', 'submit', array('label' => 'Create'));

    return $form;
  }

  /**
   * Displays a form to create a new Product entity.
   *
   */
  public function newAction()
  {
    $entity = new Product();
    $form   = $this->createCreateForm($entity);

    return $this->render('MinishopBackendBundle:Product:new.html.twig', array(
        'entity' => $entity,
        'form'   => $form->createView(),
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

    $deleteForm = $this->createDeleteForm($id);

    return $this->render('MinishopBackendBundle:Product:show.html.twig', array(
        'entity'      => $entity,
        'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
   * Displays a form to edit an existing Product entity.
   *
   */
  public function editAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('MinishopShopBundle:Product')->find($id);
    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Product entity.');
    }

    $editForm = $this->createEditForm($entity);
    $deleteForm = $this->createDeleteForm($id);

    return $this->render('MinishopBackendBundle:Product:edit.html.twig', array(
        'entity'      => $entity,
        'form'   => $editForm->createView(),
        'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
   * Creates a form to edit a Product entity.
   *
   * @param Product $entity The entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createEditForm(Product $entity)
  {
    $form = $this->createForm(new ProductType(), $entity, array(
        'action' => $this->generateUrl('admin_product_update', array('id' => $entity->getId())),
        'method' => 'PUT',
    ));

    $form->add('submit', 'submit', array('label' => 'Update'));

    return $form;
  }
  /**
   * Edits an existing Product entity.
   *
   */
  public function updateAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('MinishopShopBundle:Product')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Product entity.');
    }

    $deleteForm = $this->createDeleteForm($id);
    $editForm = $this->createEditForm($entity);
    $editForm->handleRequest($request);
    if ($editForm->isValid()) {
      $em->flush();

//      return $this->redirect($this->generateUrl('admin_product_edit', array('id' => $id)));

      if($request->isXmlHttpRequest()) {
        $response = new Response(json_encode(array(
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'brand' => $entity->getBrand(),
            'description' => $entity->getDescription(),
            'price' => $entity->getPrice(),
            'category' => $entity->getCategory()->getName(),
            'product_link' => $this->generateUrl('admin_product_show', array('id' => $entity->getId())),
            'product_edit_link' => "'".$this->generateUrl('admin_product_edit', array('id' => $entity->getId()))."'"
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      } else {
        return $this->redirect($this->generateUrl('admin_product_show', array('id' => $product->getId())));
      }
    }

    return $this->render('MinishopBackendBundle:Product:edit.html.twig', array(
        'entity'      => $entity,
        'form'   => $editForm->createView(),
        'delete_form' => $deleteForm->createView(),
    ));
  }
  /**
   * Deletes a Product entity.
   *
   */
  public function deleteAction(Request $request, $id)
  {
//    $form = $this->createDeleteForm($id);
//    $form->handleRequest($request);
//    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('MinishopShopBundle:Product')->find($id);

//    var_dump($entity);exit;
      if (!$entity) {
        throw $this->createNotFoundException('Unable to find Product entity.');
      }

      $em->remove($entity);
      $em->flush();

      if($request->isXmlHttpRequest()) {
        $response = new Response(json_encode(array(
            'id' => $id,
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      } else {
        return $this->redirect($this->generateUrl('admin_product'));
      }

//    }
//
//    return $this->redirect($this->generateUrl('admin_product'));
  }

  /**
   * Creates a form to delete a Product entity by id.
   *
   * @param mixed $id The entity id
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm($id)
  {
    return $this->createFormBuilder()
        ->setAction($this->generateUrl('admin_product_delete', array('id' => $id)))
        ->setMethod('DELETE')
        ->add('submit', 'submit', array('label' => 'Delete'))
        ->getForm()
        ;
  }

  protected function getCategory($categoryId)
  {
    $em = $this->getDoctrine()->getEntityManager();

    $category = $em->getRepository('MinishopShopBundle:Category')->find($categoryId);

    if (!$category) {
      throw $this->createNotFoundException('Unable to find Product post.');
    }

    return $category;
  }
}
