<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController  extends AbstractController
{
   
    public function index()
    {
        

        return $this->render('home/home.html.twig', [
            
        ]);
    }
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

