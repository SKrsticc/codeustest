<?php

namespace App\Controller\web;

use App\Entity\Products;
use App\Form\ProductsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function index()
    {
        $products = $this->getDoctrine()->getRepository(Products::class)->findAll();
        $dateNow = new \DateTime('@'.strtotime('now'));

        foreach($products as $product)
        {
            $discount = 0;
            $vouchers = $product->getVoucher();

            if(!$vouchers->isEmpty())
            {
                foreach($vouchers as $voucher)
                {
                    if($voucher->getStartDate() < $dateNow && $voucher->getEndDate() > $dateNow)
                        $discount += $voucher->getDiscountTier()->getTier();
                }


                if($discount > 0.60)
                    $discount = 0.60;

                $product->setPrice($product->getPrice()*(1-$discount));
            }
        }

        return $this->render('products/index.html.twig', [
            'products' => $products,
        ]);
    }

//    /**
//     * @Route("/delete/{id}", name="products.delete")
//     * @param $id
//     * @return RedirectResponse
//     */
//    public function deleteProductAction($id){
//        $em=$this->getDoctrine()
//            ->getManager();
//        $product = $em->getRepository(Products::class)
//            ->find($id);
//
//        $vouchers = $product->getVoucher();
//        if($vouchers !==null){
//            foreach($vouchers as $voucher)
//            {
//                $em->remove($voucher);
//            }
//        }
//
//        $em->remove($product);
//        $em->flush();
//
//        return $this->redirect($this->generateUrl('products.index'));
//    }

}
