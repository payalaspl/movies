<?php
namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $tag1 = new Country();
        // $tag1->setName("india");
        // $manager->persist($tag1);

        $tag1 = $manager->find('App\Entity\Country',24);
        $tag1->setName('india in hi');
        $tag1->setTranslatableLocale('hi'); // change locale
        $manager->persist($tag1);

        // $tag2 = new Country();
        // $tag2->setName("US");
        
       
        //$manager->persist($tag2);
        $this->addReference('country-1', $tag1);
        //$this->addReference('country-2', $tag2);

        $manager->flush();
    }
}
?>