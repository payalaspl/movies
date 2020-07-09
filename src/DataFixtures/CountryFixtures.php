<?php
namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');
        // it works for ODM also
        $country = new Country;
        $country->setName('india');
        $repository->translate($country, 'name', 'hi', 'भारत');
        $manager->persist($country);
        
        $country1 = new Country;
        $country1->setName('US');
        $repository->translate($country1, 'name', 'hi', 'अमेरिका');
        $manager->persist($country1);

        $this->addReference('country-1', $country);
        $this->addReference('country-2', $country1);
        
        $manager->flush();
    }
}
?>