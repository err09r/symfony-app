<?php 
namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CommentFixtures extends Fixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $comment1 = new Comment();
        $comment1->setContent("Nam suscipit porttitor aliquet. Sed at porta erat. Cras mattis accumsan mi quis cursus. Nam suscipit porttitor aliquet. Sed at porta erat. Cras mattis accumsan mi quis cursus.");
        $comment1->setCreationDate("28.05.2022");
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setContent("Cras mattis accumsan mi quis cursus. Nam suscipit porttitor aliquet. Sed at porta erat. Cras mattis accumsan mi quis cursus. Cras mattis accumsan mi quis cursus. Nam suscipit porttitor aliquet. Sed at porta erat. Cras mattis accumsan mi quis cursus. Cras mattis accumsan mi quis cursus. Nam suscipit porttitor aliquet. Sed at porta erat. Cras mattis accumsan mi quis cursus.");
        $comment2->setCreationDate("24.03.2022");
        $manager->persist($comment2);

        $manager->flush();

        $this->addReference('comment_1', $comment1);
        $this->addReference('comment_2', $comment2);
    }

    public function getOrder() {
        return 1;
    }
}