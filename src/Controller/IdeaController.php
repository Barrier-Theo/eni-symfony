<?php

namespace App\Controller;

use App\Entity\Idea;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IdeaController extends AbstractController
{
    /**
     * @Route("/idea", name="idea_list")
     */
    public function list()
    {
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $ideas = $ideaRepo->findAll();
        dump($ideas);
        return $this->render('idea/list.html.twig', [
            "ideas" => $ideas
        ]);
    }

    /**
     * @Route("/idea/{id}", name="idea_detail", requirements={"id": "\d+"}, methods={"GET"})
     */
    public function detail($id, Request $request){
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $idea = $ideaRepo->find($id);
        return $this->render('idea/detail.html.twig', ['idea' => $idea]);
    }
    /**
     * @Route("/idea/add", name="idea_add")
     */
    public function add(){
        return $this->render('idea/add.html.twig');
    }


}
