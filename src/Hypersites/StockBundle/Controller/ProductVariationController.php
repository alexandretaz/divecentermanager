<?php

namespace Hypersites\StockBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hypersites\StockBundle\Entity\ProductVariation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Hypersites\StockBundle\Entity\Item;

class ProductVariationController extends Controller
{
    /**
     * @Route("/stock/api/variation/{id}")
     * @Method("GET")
     * @Template("HypersitesStockBundle:ProductVariation:internal_use_form.html.twig")
     */
    public function internalOperations($id){
        $em = $this->getDoctrine()->getManager();
        $variation = $em->getRepository('HypersitesStockBundle:ProductVariation')->find($id);
        $availableItems = $em->getRepository('HypersitesStockBundle:Item')->findBy(array(
           'productVariation'=>$id,
           'status' => Item::ON_STOCK
        ));
        return array('variation' => $variation,
                'availableItems' => $availableItems
        );
    }
    /**
     * @Route("/stock/api/variation/update/qty")
     * @Method("POST")
     */
    public function updateStockItemsByApiAction(Request $request)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        
        $id = (int) $request->get('id');
        $newQty = (int) $request->get('qtyStock');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('HypersitesStockBundle:ProductVariation')->find($id);
        if($entity===null) {
            $response->setStatusCode(204, "The requested variation did not exist");
            return $response;
        }
        $oldQtyStock = $entity->getQtyStock();
        if($oldQtyStock>$newQty) {
            $diference = $oldQtyStock - $newQty;
            $items = $entity->getItems();
        }
        else{
            $diference = $newQty - $oldQtyStock;
            for ($interations = 0; $interations<$diference; $interations++) {
                $item = new Item();
                $item->setProductVariation($entity);
                $em->persist($item);
            }
        }
        
        $entity->setQtyStock($newQty);
        $em->persist($entity);
        $em->flush();
        $response->setContent("New quantity is {$entity->getQtyStock()}");
        return $response;   
    }

}
