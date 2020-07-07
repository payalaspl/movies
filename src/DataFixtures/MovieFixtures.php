<?php
namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{

	private function getMovieData(): array
    {
        return [
            ['Toy Story', 'Toy Story is a 1995 American computer-animated buddy comedy film produced by Pixar Animation Studios and released by Walt Disney Pictures. The feature film directorial debut of John Lasseter it was the first entirely computer-animated feature film as well as the first feature film from Pixar. The screenplay was written by Joss Whedon Andrew Stanton Joel Cohen and Alec Sokolow from a story by Lasseter Stanton Pete Docter and Joe Ranft. The film features music by Randy Newman was produced by Bonnie Arnold and Ralph Guggenheim and was executive-produced by Steve Jobs and Edwin Catmull. It features the voices of Tom Hanks Tim Allen Don Rickles Wallace Shawn John Ratzenberger Jim Varney Annie Potts R. Lee Ermey John Morris Laurie Metcalf and Erik von Detten. Taking place in a world where anthropomorphic toys come to life when humans are not present the plot focuses on the relationship between an old-fashioned pull-string cowboy doll named Woody and an astronaut action figure Buzz Lightyear as they evolve from rivals competing for the affections of their owner Andy Davis to friends who work together to be reunited with him after being separated from him.'],
            ['Jumanji', 'When Spencer goes missing the gang returns to Jumanji to travel unexplored territories and help their friend escape the worlds most dangerous game.'],
            ['Grumpier Old Men', 'Max and John who are obsessed with fishing attempt to save their favourite bait shop from turning into an Italian restaurant.'],
            ['Waiting to Exhale','Navigating through careers family and romance four friends bond over the shortcomings in their love lives -- namely the scarcity of good men. Both as the "other woman" Savannah (Whitney Houston) and Robin (Lela Rochon) carry on relationships with married men each believing their lovers will leave their wives for them. On the flip side Bernadine (Angela Bassett) ends up alone when her husband divorces her for his mistress. Meanwhile Gloria (Loretta Devine) finds love with a new neighbor.'],
            ['Father of the Bride Part II','George Banks lives with his wife and misses his daughter who is married. Soon he finds out that his daughter is pregnant but also gets another unexpected surprise along the way.'],
            ['Heat','Lieutenant Hanna a detective decides to catch a highly intelligent seasonal criminal who has vowed to pull off one last robbery before he retires for good.'],
        ];
    }
    public function load(ObjectManager $manager)
    {
    	foreach ($this->getMovieData() as [$name, $description]) {
            $movie = new Movie();
	        $movie->setName($name);
	        $movie->setDecription($description);
	        $manager->persist($movie);
        }

        $manager->flush();
    }
}
?>