<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Form\IdeaType;
use Doctrine\ORM\EntityManagerInterface;
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
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detail($id, Request $request){
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $idea = $ideaRepo->find($id);
        return $this->render('idea/detail.html.twig', ['idea' => $idea]);
    }

    /**
     * @Route("/idea/add", name="idea_add")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(EntityManagerInterface $em, Request $request){
        $idea = new Idea();
        $idea->setDateCreated(new \DateTime());
        $idea->setIsPublished(1);

        $ideaForm =  $this->createForm(IdeaType::class, $idea);

        $ideaForm-> handleRequest($request);
        if($ideaForm->isSubmitted() && $ideaForm->isValid()){
            $em->persist($idea);
            $em->flush();

            $this->addFlash("success", 'The idea has been saved !');
            return $this->redirectToRoute('idea_detail', ['id' => $idea->getId()] );
        }
        return $this->render('idea/add.html.twig',[
            "ideaForm" => $ideaForm->createView()
        ]);
    }


}
