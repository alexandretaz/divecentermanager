<?php

namespace Hypersites\StockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hypersites\StockBundle\Entity\Supplier;
use Hypersites\StockBundle\Form\SupplierType;
use Hypersites\StockBundle\Model\Supplier as SupplierModel;

/**
 * Supplier controller.
 *
 * @Route("/stock/supplier")
 */
class SupplierController extends Controller
{
    
    /**
     * Lists all Supplier entities.
     *
     * @Route("/", name="stock_supplier")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->container->get('hypersites.EntityManagerService');
        $entities = SupplierModel::getFullList($em,
                array('id', 'name', 'alias', 'orderEmail', 'fiscalDocument' )
            );

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Supplier entity.
     *
     * @Route("/", name="stock_supplier_create")
     * @Method("POST")
     * @Template("HypersitesStockBundle:Supplier:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Supplier();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            

            return $this->redirect($this->generateUrl('stock_supplier_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Supplier entity.
     *
     * @param Supplier $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Supplier $entity)
    {
        $form = $this->createForm(new SupplierType(), $entity, array(
            'action' => $this->generateUrl('stock_supplier_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create New Supplier', 'attr'=>array(
            'class'=>'btn btn-primary btn-lg')));

        return $form;
    }

    /**
     * Displays a form to create a new Supplier entity.
     *
     * @Route("/new", name="stock_supplier_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Supplier();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Supplier entity.
     *
     * @Route("/{id}", name="stock_supplier_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HypersitesStockBundle:Supplier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Supplier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Supplier entity.
     *
     * @Route("/{id}/edit", name="stock_supplier_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HypersitesStockBundle:Supplier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Supplier entity.');
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
    * Creates a form to edit a Supplier entity.
    *
    * @param Supplier $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Supplier $entity)
    {
        $form = $this->createForm(new SupplierType(), $entity, array(
            'action' => $this->generateUrl('stock_supplier_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update This Supplier Info',
            'attr'=>array('class'=>'btn btn-lg btn-primary')));

        return $form;
    }
    /**
     * Edits an existing Supplier entity.
     *
     * @Route("/{id}", name="stock_supplier_update")
     * @Method("PUT")
     * @Template("HypersitesStockBundle:Supplier:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HypersitesStockBundle:Supplier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Supplier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('stock_supplier_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Supplier entity.
     *
     * @Route("/{id}", name="stock_supplier_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HypersitesStockBundle:Supplier')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Supplier entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stock_supplier'));
    }

    /**
     * Creates a form to delete a Supplier entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stock_supplier_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
