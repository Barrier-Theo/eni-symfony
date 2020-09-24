<?php

namespace App\Controller;


use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $params= json_decode($request->getContent());
        dump($request->getContent());

        $product = $serializer->deserialize(
            $request->getContent(),
            Product::class,
            'json'
        );

        $em->persist($product);
        $em->flush();

        return new JsonResponse(null,  Response::HTTP_CREATED, ["location" => "/products/".$product->getid()]);
    }

    /**
     * @Route("/products/{id}", name="showProduct")
     * @param Product $product
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function show(Product $product, SerializerInterface $serializer)
    {
        $response = new JsonResponse();

        return $response->setContent($serializer->serialize($product, 'json'));
    }


}
