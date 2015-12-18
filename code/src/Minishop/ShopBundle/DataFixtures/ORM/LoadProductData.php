<?php
/**
 * Created by PhpStorm.
 * User: raymond
 * Date: 7/12/15
 * Time: 1:01 AM
 */

namespace Minishop\ShopBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Minishop\ShopBundle\Entity\Product;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $productA = new Product();
//        $productA->setCategoryId(1);
        $productA->setName('Goldair Select GSDF120 Desk Fan 23cm');
        $productA->setBrand('Goldair');
        $productA->setPrice(25.99);
        $productA->setDescription('This Goldair Select Desk Fan has 2 speed settings allowing you to adjust the output of these powerful motors to cool any day, and with the oscillating feature on all models, you can cool that work space faster.

Diameter: 23cm
2 Speeds
Metal handle
Adjustable fan tilt
Osciallting function
White finish housing
White finish front and back radial frill
2,100 RPM fan speed
Plastic fan blades
Sturdy base
White power cord and plug
Colour control switches
Plastic constructed body
Straight-forward assembly
1 year warranty');
        $productB = new Product();
//        $productB->setCategoryId(1);
        $productB->setName('Goldair Select GSPF100 Pedestal Fan 40cm');
        $productB->setBrand('Goldair');
        $productB->setPrice(28.99);
        $productB->setDescription('This user friendly, candid fan has all the basics covered with 3 speed settings, osciallting function and height adjustable so you can cool any space with ease.

Diameter: 40cm
3 Speeds
Metal handle
Adjustable fan tilt
Osciallting function
White finish housing
White finish front and back radial frill
1,250 RPM fan speed
Plastic fan blades
Cross base
White power cord and plug
Colour control switches
Plastic constructed body
Straight-forward assembly
50 Watts
1 year warranty');
        $productC = new Product();
//        $productC->setCategoryId(2);
        $productC->setName('Delonghi DD30P Dehumidifier');
        $productC->setBrand('Goldair');
        $productC->setPrice(599.99);
        $productC->setDescription('The Delonghi DD30P Dehumidifier has a 30 litre dehumidifying capacity, 4.5litre water tank capacity and an electronics adjustable humidistat. The 24 hour timer is perfect for dehumidifying exactly when you want it to and features 2 fan speeds. It features a triple condensate draining system with continuous drain option.
Dust air filter
5 meter pump hose
35.5cm x 42cm x 69cm');
        $productD = new Product();
//        $productD->setCategoryId(3);
        $productD->setName('Philips GC506 Daily Touch Garment Steamer');
        $productD->setBrand('Philips');
        $productD->setPrice(149.99);
        $productD->setDescription('This Steamer is designed for easy crease removal every day. Just hang your clothes in the integrated hanger and see how quickly steam releases the creases.
Powerful continuous steam
2 steam levels
Extra-large steam plates for quick results
Includes garment hanger
Adjustable pole height
Large detachable water tank
PVC free silicone steam hose
Safe to use on delicate fabrics like silk
Includes glove for protection during steaming
1600 watts');
        $productE = new Product();
//        $productE->setCategoryId(4);
        $productE->setName('Elite BLM530 5 Watt MR16 LED bulb');
        $productE->setBrand('Elite');
        $productE->setPrice(10.99);
        $productE->setDescription('Designed with new LED technology this 5 Watt MR16 LED bulb has 400 lumens in a warm white. This bulb uses up to 80% less energy than a standard halogen bulb with a similar lumen output.
15,000 hours life
38 degree');

        $em->persist($productA);
        $em->persist($productB);
        $em->persist($productC);
        $em->persist($productD);
        $em->persist($productE);
        $em->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}