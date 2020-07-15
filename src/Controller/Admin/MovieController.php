<?php


namespace App\Controller\Admin;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MovieController  extends AbstractController
{
	public function list(Request $request,int $page,MovieRepository $movies){
		$local = $request->getLocale();
        $latestMovie = $movies->findLatest($page,$local);
        return $this->render('admin/movie/movie.html.twig', array('paginator' => $latestMovie));
	}
}
?>
