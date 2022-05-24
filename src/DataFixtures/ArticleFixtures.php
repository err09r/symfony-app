<?php 
namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ArticleFixtures extends Fixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $article1 = new Article();
        $article1->setTitle('Test Article 1');
        $article1->setCreationDate('28.04.2022');
        $article1->setImageSrc('https://cdn.pixabay.com/photo/2022/03/12/07/47/lotus-7063576_1280.jpg');
        $article1->setDuration(3);
        $article1->setCategory($this->getReference('category_1'));
        $manager->persist($article1);

        $article2 = new Article();
        $article2->setTitle('Test Article 2');
        $article2->setCreationDate('01.05.2022');
        $article2->setImageSrc('https://cdn.pixabay.com/photo/2022/04/05/19/34/motherhood-7114294_1280.jpg');
        $article2->setDuration(8);
        $article2->setCategory($this->getReference('category_2'));
        $manager->persist($article2);

        $article3 = new Article();
        $article3->setTitle('Test Article 3');
        $article3->setCreationDate('31.12.2021');
        $article3->setImageSrc('https://cdn.pixabay.com/photo/2019/06/16/15/41/girona-4278090_1280.jpg');
        $article3->setDuration(5);
        $article3->setCategory($this->getReference('category_3'));
        $manager->persist($article3);

        $article4 = new Article();
        $article4->setTitle('Test Article 4');
        $article4->setCreationDate('11.11.2018');
        $article4->setImageSrc('https://cdn.pixabay.com/photo/2019/06/16/15/41/girona-4278090_1280.jpg');
        $article4->setDuration(4);
        $article4->setCategory($this->getReference('category_3'));
        $manager->persist($article4);

        $manager->flush();
    }

    public function getOrder() {
        return 2;
    }
}