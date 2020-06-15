<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController  extends AbstractController
{
    /**
     * @Route("/home")
      */
    public function index()
    {
        

        return $this->render('home/home.html.twig', [
            
        ]);
    }
    /**
     * @Route("/home/show/{slug}",name="home_show",requirements={"slug": "about|privacy"})
      */
    public function show($slug)
    {
        if ($slug == 'about') {
            return $this->render('home/about.html.twig', [
            
            ]);
        }else{
             return $this->render('home/privacy.html.twig', [
            
            ]);
        }
        
    }                                                                      
}

