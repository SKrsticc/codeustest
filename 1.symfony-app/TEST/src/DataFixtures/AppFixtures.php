<?php

namespace App\DataFixtures;

use App\Entity\Products;
use App\Entity\DiscountTiers;
use App\Entity\Vouchers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PhpParser\Node\Expr\Array_;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $discount10 = new DiscountTiers();
        $discount10->setTier(0.1);
        $manager->persist($discount10);

        $discount15 = new DiscountTiers();
        $discount15->setTier(0.15);
        $manager->persist($discount15);

        $discount20 = new DiscountTiers();
        $discount20->setTier(0.20);
        $manager->persist($discount20);

        $discount25 = new DiscountTiers();
        $discount25->setTier(0.25);
        $manager->persist($discount25);

        $discount_tiers = array($discount10, $discount15, $discount20, $discount25);

        for($i=0;$i<10;$i++) {
            $product = new Products();
            $product->setName('Product ' . $i);
            $product->setPrice(1000);
            $manager->persist($product);

            $voucher = new Vouchers();
            $voucher->setStartDate(new \DateTime('2019-02-02 13:00:00'));
            $voucher->setEndDate(new \DateTime('2022-02-02 15:00:00'));
            $voucher->setDiscountTier($discount_tiers[$i%4]);
            $voucher->addProduct($product);
            $manager->persist($voucher);
      }

        $manager->flush();
    }
}
