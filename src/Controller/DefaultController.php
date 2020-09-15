<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController {

    /**
     * @Route("/", name="home")
     */
    public function home(){
      return $this->render("default/home.html.twig");
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(){
        $colors = ['red','blue', 'black'];
        return $this->render("default/test.html.twig", ["colors" => $colors]);
    }
}