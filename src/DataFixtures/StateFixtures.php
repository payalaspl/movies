<?php
namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');
        // it works for ODM also
        $state = new State;
        $state->setName("gujrat");
        $state->setCountry($this->getReference('country-1'));
        $repository->translate($state, 'name', 'hi', 'गुजरात');
        $manager->persist($state);

        $state1 = new State;
        $state1->setName("California");
        $state1->setCountry($this->getReference('country-2'));
        $repository->translate($state1, 'name', 'hi', 'कैलिफोर्निया');
        $manager->persist($state1);
        

        $manager->flush();
    }
}
?>
