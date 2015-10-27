<?php

namespace Hypersites\StockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hypersites\StockBundle\Entity\ProductAttribute;
use Hypersites\StockBundle\Form\ProductAttributeType;

/**
 * ProductAttribute controller.
 *
 * @Route("/stock/product/attribute")
 */
class ProductAttributeController extends Controller
{

    /**
     * Lists all ProductAttribute entities.
     *
     * @Route("/{product}", name="supplier_product_attribute")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($product)
    {
        $em = $this->getDoctrine()->getManager();
        
        $product = $em->getRepository('HypersitesStockBundle:Product')->findOneBy(array('id'=>$product));

        $entities = $em->getRepository('HypersitesStockBundle:ProductAttribute')->findBy(array('product'=>$product));

        return array(
            'entities' => $entities,
            'product'=> $product
        );
    }
    /**
     * Creates a new ProductAttribute entity.
     *
     * @Route("/", name="supplier_product_attribute_create")
     * @Method("POST")
     * @Template("HypersitesStockBundle:ProductAttribute:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ProductAttribute();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $values = explode(",", $entity->getAttributeValue());
            $entity->setAttributeValue($values);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $product = $entity->getProduct();
            return $this->redirect($this->generateUrl('supplier_product_attribute', array('product' => $product->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ProductAttribute entity.
     *
     * @param ProductAttribute $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProductAttribute $entity)
    {
        $form = $this->createForm(new ProductAttributeType(), $entity, array(
            'action' => $this->generateUrl('supplier_product_attribute_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProductAttribute entity.
     *
     * @Route("/{product}/new", name="supplier_product_attribute_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($product)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('HypersitesStockBundle:Product')->findOneBy(array('id'=>$product));
        
        $entity = new ProductAttribute();
        $entity->setProduct($product);
        $form   = $this->createCreateForm($entity);

        return array(
            'product' => $product,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ProductAttribute entity.
     *
     * @Route("/{id}", name="supplier_product_attribute_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HypersitesStockBundle:ProductAttribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductAttribute entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ProductAttribute entity.
     *
     * @Route("/{id}/edit", name="supplier_product_attribute_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HypersitesStockBundle:ProductAttribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductAttribute entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a ProductAttribute entity.
    *
    * @param ProductAttribute $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductAttribute $entity)
    {
        $form = $this->createForm(new ProductAttributeType(), $entity, array(
            'action' => $this->generateUrl('supplier_product_attribute_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductAttribute entity.
     *
     * @Route("/{id}", name="supplier_product_attribute_update")
     * @Method("PUT")
     * @Template("HypersitesStockBundle:ProductAttribute:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HypersitesStockBundle:ProductAttribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductAttribute entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('supplier_product_attribute_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ProductAttribute entity.
     *
     * @Route("/{id}", name="supplier_product_attribute_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HypersitesStockBundle:ProductAttribute')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductAttribute entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('supplier_product_attribute'));
    }

    /**
     * Creates a form to delete a ProductAttribute entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('supplier_product_attribute_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
