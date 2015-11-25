<?php

namespace Hypersites\StockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hypersites\StockBundle\Entity\StockMovement;
use Hypersites\StockBundle\Form\StockMovementType;
use Hypersites\StockBundle\Entity\ProductVariation;
use Hypersites\StockBundle\Model\StockMovement as StockMovementModel;

/**
 * StockMovement controller.
 *
 * @Route("/stock/movement")
 */
class StockMovementController extends Controller
{

    /**
     * Lists all StockMovement entities.
     *
     * @Route("/", name="stock_movement")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HypersitesStockBundle:StockMovement')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new StockMovement entity.
     *
     * @Route("/", name="stock_movement_create")
     * @Method("POST")
     * @Template("HypersitesStockBundle:StockMovement:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new StockMovement();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stock_movement_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a StockMovement entity.
     *
     * @param StockMovement $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(StockMovement $entity)
    {
        $form = $this->createForm(new StockMovementType(), $entity, array(
            'action' => $this->generateUrl('stock_movement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new StockMovement entity.
     *
     * @Route("/new", name="stock_movement_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new StockMovement();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a StockMovement entity.
     *
     * @Route("/{id}", name="stock_movement_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HypersitesStockBundle:StockMovement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StockMovement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing StockMovement entity.
     *
     * @Route("/{id}/edit", name="stock_movement_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HypersitesStockBundle:StockMovement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StockMovement entity.');
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
    * Creates a form to edit a StockMovement entity.
    *
    * @param StockMovement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(StockMovement $entity)
    {
        $form = $this->createForm(new StockMovementType(), $entity, array(
            'action' => $this->generateUrl('stock_movement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing StockMovement entity.
     *
     * @Route("/{id}", name="stock_movement_update")
     * @Method("PUT")
     * @Template("HypersitesStockBundle:StockMovement:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HypersitesStockBundle:StockMovement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StockMovement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('stock_movement_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a StockMovement entity.
     *
     * @Route("/{id}", name="stock_movement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HypersitesStockBundle:StockMovement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find StockMovement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stock_movement'));
    }
    /**
     * Get the internal Moviment Form  
     *
     * @Route("/internal/new/{id}", name="stock_movement_delete")
     * @Method("GET")
     * @Template("HypersitesStockBundle:ProductVariation:internal_use_form.html.twig")
     */
    public function getInternalMovementFormAction( $id ) 
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new StockMovement();
        $form = $this->createCreateForm($entity);
        $productVariation = $em->getRepository("HypersitesStockBundle:ProductVariation")->find($id);
        $items = $this->getModel()->getItemsForInternalOperations( $productVariation );
        $kindMovement = $form->get('kindMovement')->setData(\Hypersites\StockBundle\Entity\Item::ON_INTERNAL_USE);
        return array('variation'=>$productVariation, 'availableItems' => $items, 'form'=>$form->createView());
        
    }
    
    private function getModel()
    {
        return $this->model = new StockMovementModel($this->getDoctrine()->getManager());
    }

    /**
     * Creates a form to delete a StockMovement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stock_movement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
