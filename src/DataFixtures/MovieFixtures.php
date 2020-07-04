<?php
namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $movie = new Movie();
        $movie->setName("Mr. india");
        $movie->setDecription('bun77 yg');
        $manager->persist($movie);
        $manager->flush();
    }
}
?>

