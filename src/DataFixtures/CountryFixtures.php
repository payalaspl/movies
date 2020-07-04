<?php
namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tag1 = new Country();
        $tag1->setName("india");
        

        $tag2 = new Country();
        $tag2->setName("US");
        

        $manager->persist($tag1);
        $manager->persist($tag2);
        $this->addReference('country-1', $tag1);
        $this->addReference('country-2', $tag2);

        $manager->flush();
    }
}
?>