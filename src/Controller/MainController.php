<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/about_us", name="main_about_us")
     */
    public function about()
    {
        return $this->render('main/about-us.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}