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
    private function getMovieData_hi(): array
    {
        return [
            ['खिलौनों की कहानी', 'टॉय स्टोरी एक 1995 अमेरिकी कंप्यूटर-एनिमेटेड ब्वॉय कॉमेडी फिल्म है, जो पिक्सर एनिमेशन स्टूडियो द्वारा निर्मित और वॉल्ट डिज़नी पिक्चर्स द्वारा रिलीज़ की गई है। जॉन लैसेटर की फीचर फिल्म निर्देशन पहली फिल्म थी जो पूरी तरह से कंप्यूटर-एनिमेटेड फीचर फिल्म थी और साथ ही पिक्सर की पहली फीचर फिल्म थी। पटकथा को जॉस व्हेडन एंड्रयू स्टैंटन जोएल कोहेन और एलेक सोकोलो ने लैसेटर स्टैंटन पीट डॉकर और जो रानाफ्ट की एक कहानी से लिखा था। फिल्म में रैंडी न्यूमैन का संगीत बोनी अर्नोल्ड और राल्फ गुगेनहाइम द्वारा निर्मित किया गया था और स्टीव जॉब्स और एडविन कैटमुल द्वारा कार्यकारी-निर्मित किया गया था। इसमें टॉम हैंक्स टिम एलन डॉन रिकल्स वालेस शॉन जॉन रत्ज़ेंबर्गर जिम वर्नी एनी पॉट्स आर। ली एर्मे जॉन मॉरिस लॉरी मेटकाफ और एरिक वॉन डेटन की आवाज़ें हैं। एक ऐसी दुनिया में जगह बनाना जहां मानव शरीर के खिलौने जीवन में आते हैं, जब मनुष्य मौजूद नहीं होते हैं, प्लॉडी नाम के एक पुराने जमाने की पुल-स्ट्रिंग काउबॉय गुड़िया और एक अंतरिक्ष यात्री एक्शन फिगर बज़ लाइटेयर के बीच संबंधों पर केंद्रित है, जैसा कि प्रतिद्वंद्वियों के लिए प्रतिस्पर्धा से विकसित होता है। उनके मालिक एंडी डेविस उन दोस्तों के लिए जो उनसे अलग होने के बाद उनके साथ फिर से जुड़ने का काम करते हैं।'],
            ['जुमांजी', 'जब स्पेंसर गैर-संगठित प्रदेशों की यात्रा करने के लिए जुमांजी के लिए गैंग रिटर्न गुम हो जाता है और अपने दोस्त को दुनिया के सबसे खतरनाक खेल से बचने में मदद करता है।'],
            ['क्रोधी बूढ़े आदमी', 'मैक्स और जॉन जो अपने पसंदीदा चारा की दुकान को इतालवी रेस्तरां में बदलने से बचाने के लिए मछली पकड़ने के प्रयास से ग्रस्त हैं।'],
            ['सांस छोड़ने की प्रतीक्षा करना','करियर परिवार और रोमांस के माध्यम से नेविगेट करना चार दोस्तों को उनके प्रेम जीवन में कमियों पर बंधन - अर्थात् अच्छे पुरुषों की कमी। "अन्य महिला" सवाना (व्हिटनी ह्यूस्टन) और रॉबिन (लीला रोचोन) दोनों विवाहित पुरुषों के साथ रिश्तों को निभाते हैं, प्रत्येक प्रेमी अपने विश्वासियों को उनके लिए छोड़ देगा। फ्लिप की ओर से बर्नडाइन (एंजेला बैसेट) अकेले ही समाप्त हो जाती है जब उसका पति उसे उसकी मालकिन के लिए तलाक दे देता है। इस बीच ग्लोरिया (लोरेटा डिवाइन) को एक नए पड़ोसी के साथ प्यार हो जाता है।'],
            ['दुल्हन भाग II के पिता','जॉर्ज बैंक्स अपनी पत्नी के साथ रहते हैं और अपनी बेटी की शादी करते हैं। जल्द ही उसे पता चलता है कि उसकी बेटी गर्भवती है, लेकिन रास्ते में उसे एक और अप्रत्याशित आश्चर्य भी हुआ।'],
            ['तपिश','लेफ्टिनेंट हैना एक जासूस एक उच्च बुद्धिमान मौसमी अपराधी को पकड़ने का फैसला करता है जिसने अच्छे के लिए रिटायर होने से पहले एक आखिरी डकैती को खींचने की कसम खाई है।'],
        ];
    }
    public function load(ObjectManager $manager)
    {
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');
        $movie_en = $this->getMovieData();
        $movie_hi = $this->getMovieData_hi();
    	for($i=0; $i < count($this->getMovieData());$i++) {
            $movie = new Movie();
	        $movie->setName($movie_en[$i][0]);
	        $movie->setDecription($movie_en[$i][1]);
            $repository->translate($movie, 'name', 'hi', $movie_hi[$i][0]);
            $repository->translate($movie, 'decription', 'hi', $movie_hi[$i][1]);
	        $manager->persist($movie);
        }

        $manager->flush();
    }
}
?>