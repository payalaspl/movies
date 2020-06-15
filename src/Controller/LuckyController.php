<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController  extends AbstractController
{
    public function number($max)
    {
        $number = random_int(0, $max);

        return $this->render('number.html.twig', [
            'number' => $number,
        ]);
    }
    /**
     * @Route("/lucky/maxnumber")
      */
    public function maxnumber()
    {
        $number = random_int(0, 100);

        return $this->render('number.html.twig', [
            'number' => $number,
        ]);
    }                                                                      
}
