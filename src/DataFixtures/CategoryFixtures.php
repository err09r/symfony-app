<?php 
namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CategoryFixtures extends Fixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setTitle('Technologies');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setTitle('Health');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setTitle('Motorsport');
        $manager->persist($category3);

        $manager->flush();

        $this->addReference('category_1', $category1);
        $this->addReference('category_2', $category2);
        $this->addReference('category_3', $category3);
    }

    public function getOrder() {
        return 1;
    }
}