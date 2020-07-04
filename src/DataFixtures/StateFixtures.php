<?php
namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $state = new State();
        $state->setName("gujrat");
        $state->setCountry($this->getReference('country-1'));
        $manager->persist($state);
        $manager->flush();
    }
}
?>
