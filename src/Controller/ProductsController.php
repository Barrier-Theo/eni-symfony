<?php

namespace App\Controller;


use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Representation\PaginatedProducts;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/products/page/{page}", name="listProductsPaginated", defaults={"page":1})
     * @param ProductRepository $repository
     * @param $page
     * @param Request $request
     * @return JsonResponse
     */
    public function listProducts(Request $request, ProductRepository $repository, $page)
    {
        $response = new JsonResponse();
        $search = $request->query->get("search");
        $filteredProducts = $repository->getFilteredProducts($search, $page);

        $productRepresentation = new PaginatedProducts($filteredProducts, $page);
        var_dump($productRepresentation);
        return $this->getJsonResponse($productRepresentation);
    }

    /**
     * @Route("/product", name="createProduct")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $product = $this->getUnserializedProduct($request);

        $em->persist($product);
        $em->flush();

        return new JsonResponse(null,  Response::HTTP_CREATED, ["location" => "/product/".$product->getid()]);
    }

    /**
     * @Route("/product/{id}", name="showProduct")
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product)
    {
        return  $this->getJsonResponse($product);
    }

    private function getUnserializedProduct (Request$request){
        return $this->serializer->deserialize($request->getContent(), Product::class, 'json');
    }

    private function getJsonResponse($data = null, int $status = 200, array $headers = [] ) : JsonResponse {
        $serializedData = $data;
        if(!is_null($data)){
            $serializedData = $this->serializer->serialize($data, 'json');
        }
        $response = new JsonResponse(null, $status, $headers);
        $response->setContent($serializedData);

        return $response;
    }




}
