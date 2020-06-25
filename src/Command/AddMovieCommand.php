<?php

namespace App\Command;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class AddMovieCommand extends Command
{
	protected static $defaultName = 'app:add-movie';

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }
   
    protected function configure()
    {
        $this->setDescription('Imports the mock CSV data file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $file = fopen('%kernel.root_dir%/../src/movies.csv', 'r');

        while (($line = fgetcsv($file)) !== FALSE) {
		 	$movie = new Movie();
            $movie->setName($line[1]);
            $movie->setDecription($line[2]);
            $this->em->persist($movie);
		}

		$this->em->flush();
		fclose($file);

        $io->success('Command exited cleanly!');
    }
}
?>