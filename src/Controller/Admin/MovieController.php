<?php


namespace App\Controller\Admin;

use App\Entity\Movie;
use App\Form\MovieType;
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



	public function new(Request $request){
		$movie = new Movie();
        
        if ($request->getMethod() == 'POST') {

        	$em = $this->getDoctrine()->getManager();

        	$repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        	$movie->setName($request->request->get('name'));
	        $movie->setDecription($request->request->get('description'));
            $repository->translate($movie, 'name', 'hi', $request->request->get('name_hi'));
            $repository->translate($movie, 'decription', 'hi',$request->request->get('description_hi'));

           
            $em->persist($movie);
            $em->flush();

            $this->addFlash('success', 'movie.created_successfully');
            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/movie/new.html.twig');
	}


	public function edit(Request $request,$id,MovieRepository $movies){

		$locale = $request->getLocale();

		$movie_data = $movies->getMovieById($id,$locale);
		
		$form = $this->createForm(MovieType::class, $movie_data[0]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
    		$data = $form->getData();

        	$em = $this->getDoctrine()->getManager();
        	$movie = $em->find('App\Entity\Movie', $id);
			$movie->setName($data->getName());
			$movie->setDecription($data->getDecription());
			$movie->setTranslatableLocale($locale); // change locale
			$em->persist($movie);
			$em->flush();

            $this->addFlash('success', 'movie.updated_successfully');

            return $this->redirectToRoute('editmovie', ['id' => $movie_data[0]->getId()]);
        }

        return $this->render('admin/movie/edit.html.twig', [
            'movie' => $movie_data[0],
            'form' => $form->createView(),
        ]);
	}


	public function delete(Request $request, Movie $movie){

        $em = $this->getDoctrine()->getManager();
        $em->remove($movie);
        $em->flush();

        $this->addFlash('success', 'movie.deleted_successfully');

        return $this->redirectToRoute('admin');
	}

}
?>
