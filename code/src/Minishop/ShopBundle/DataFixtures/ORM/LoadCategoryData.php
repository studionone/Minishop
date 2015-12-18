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
use Minishop\ShopBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $cooling = new Category();
        $cooling->setName('Cooling');

        $heating = new Category();
        $heating->setName('Heating');

        $laundry = new Category();
        $laundry->setName('Laundry');

        $lighting = new Category();
        $lighting->setName('Lighting');

        $em->persist($cooling);
        $em->persist($heating);
        $em->persist($laundry);
        $em->persist($lighting);
        $em->flush();

        $this->addReference('category-cooling', $cooling);
        $this->addReference('category-heating', $heating);
        $this->addReference('category-laundry', $laundry);
        $this->addReference('category-lighting', $lighting);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}