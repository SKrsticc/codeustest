<?php

namespace App\Controller\rest;

use App\Entity\Products;
use App\Form\ProductsType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractFOSRestController{//AbstractController {

    /**
     * @Rest\Post("/products")
     * @param Request $request
     * @return Response
     */
    public function newProductsAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $product = new Products();
        $form = $this->createForm(ProductsType::class,$product);

        $form->submit($data);

        if($form->isSubmitted() && $form->isValid())
        {
            $product = $form->getData();

            $em= $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return new Response(null,Response::HTTP_CREATED);
        }

        $converted = (string)$form->getErrors(true,false);
        return new Response($converted, Response::HTTP_BAD_REQUEST);
    }


    /**
     * @Rest\Delete("/products/{id}")
     * @param $id
     * @return Response
     */
    public function deleteProductAction($id)
    {
        $em=$this->getDoctrine()
            ->getManager();
        $product = $em->getRepository(Products::class)
            ->find($id);

        if($product === null) return new Response(null,Response::HTTP_NOT_FOUND);

        $vouchers = $product->getVoucher();
        if($vouchers !==null){
            foreach($vouchers as $voucher)
            {
                $em->remove($voucher);
            }
        }


        $em->remove($product);
        $em->flush();

        return new Response('aaaaa',Response::HTTP_OK);
    }
}