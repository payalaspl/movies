<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\ContactType;
use App\Form\SearchType;
use App\Entity\Contact;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController  extends AbstractController
{
    
    public function index(Request $request,int $page,MovieRepository $movies)
    {
        $search = null;

        if ($request->query->has('search')) {
             $search = $request->query->get('search');
        }

        $latestMovie = $movies->findLatest($page,$search);

        return $this->render('home/home.html.twig',array('paginator' => $latestMovie));
    }


    public function search(Request $request,MovieRepository $movies){

        if ($request->query->has('search')) {
            $search = $request->query->get('search');
            $latestMovie = $movies->findSearch($search);
            
            return $this->render('home/search.html.twig',array('movies' => $latestMovie));
        }
        
    }    

    public function show($slug)
    {
        if ($slug == 'about') {
            return $this->render('home/about.html.twig');
        }else{
             return $this->render('home/privacy.html.twig');
        }
    }


    public function show_contact(Request $request,\Swift_Mailer $mailer){
        $task = new Contact();
        $form = $this->createForm(ContactType::class, $task);
        $form->handleRequest($request);

        if ($request->isMethod('POST')){

            if ($form->isSubmitted() && $form->isValid()){
                $data = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($data);
                $entityManager->flush();

                $message = (new \Swift_Message('You Got Mail!'))
                    ->setFrom('payal@aum.bz')
                    ->setTo($data->getEmail())
                    ->setBody($data->getMessage(),'text/plain')
                ;
                $mailer->send($message);

                $this->addFlash('notice','Your changes were saved!');
                return $this->redirectToRoute('contact_success');
            }
        }

        return $this->render('home/contact.html.twig', [
             'form' => $form->createView(),
        ]);
    }


    public function contact_submit(){
        
        $contact = $this->getDoctrine()->getRepository(Contact::class)->findAll();
        return $this->render('home/msg.html.twig',array('contact'=>$contact));
    }
                                                                
}
?>