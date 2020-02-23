<?php

namespace App\Controller\rest;

use App\Entity\DiscountTiers;
use App\Entity\Products;
use App\Entity\Vouchers;
use App\Form\ProductsType;
use App\Form\VouchersType;
use App\Repository\ProductsRepository;
use App\Repository\VouchersRepository;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VouchersController extends AbstractFOSRestController
{
    /**
     * @Rest\POST("/discounttiers/{id}/vouchers")
     * @param Request $request
     * @param $id
     * @return Response
     * @throws \Exception
     */
    public function newVoucherAction(Request $request, $id)
    {
        $discountTier=$this->getDoctrine()
            ->getRepository(DiscountTiers::class)
            ->find($id);

        if($discountTier === null)
            return new Response(null,Response::HTTP_NOT_FOUND);

        $voucher = new Vouchers();
        $form=$this->createForm(VouchersType::class,$voucher);

        $data = json_decode($request->getContent(),true);

        $form->submit($data);

        if($form->isValid() && $form->isSubmitted()) {
            $voucher = $form->getData();
            $voucher->setDiscountTier($discountTier);

            $em = $this->getDoctrine()->getManager();
            $em->persist($voucher);
            $em->flush();

            return new Response(null, Response::HTTP_CREATED);
        }

        $converted = (string)$form->getErrors(true,false);
        return new Response($converted, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Rest\POST("/products/{pid}/vouchers/{vid}")
     * @param $pid
     * @param $vid
     * @return Response
     * @throws \Exception
     */
    public function bindVoucherToProductAction($pid, $vid)
    {
        $em=$this->getDoctrine()->getManager();

        $product = $em
            ->getRepository(Products::class)
            ->find($pid);

        $voucher=$em
            ->getRepository(Vouchers::class)
            ->find($vid);

        if($voucher === null || $product === null)
            return new Response(null,Response::HTTP_NOT_FOUND);

        $product->addVoucher($voucher);
        $voucher->addProduct($product);

        $em->persist($product);
        $em->persist($voucher);
        $em->flush();

        return new Response(null,Response::HTTP_CREATED);
    }

    /**
     * @Rest\DELETE("/products/{pid}/vouchers/{vid}")
     * @param $pid
     * @param $vid
     * @return Response
     * @throws \Exception
     */
    public function removeVoucherBindToProductAction($pid, $vid)
    {
        $em=$this->getDoctrine()->getManager();

        $product = $em
            ->getRepository(Products::class)
            ->find($pid);

        $voucher=$em
            ->getRepository(Vouchers::class)
            ->find($vid);

        if($voucher === null || $product === null)
            return new Response(null,Response::HTTP_NOT_FOUND);

        $product->removeVoucher($voucher);
        $voucher->removeProduct($product);

        $em->persist($product);
        $em->persist($voucher);
        $em->flush();

        return new Response(null,Response::HTTP_OK);
    }
}
