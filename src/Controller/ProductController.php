<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;

class ProductController extends AbstractController
{
    private HttpClientInterface $client;
    public function __construct(HttpClientInterface $client)
    {
        $client =$client;
    }
    #[Route('/products', name: 'products')]
    public function index()
    {
        $response = $this->client->request('GET', 'http://127.0.0.1:8000/api/products');
        $products = $response->toArray();
        return $this->render('products/index.html.twig',[
        'products' => $products,
        ]);
    }
    #[Route('/api/products', name: 'api_create_product', methods: ['POST'])]
    public function createProduct(Request $request, ProductRepository $productRepository): JsonResponse
    {
    $data = json_decode($request->getContent(), true);
    if (empty($data['name']) || empty($data['price'])) {
        return new JsonResponse(['error' => 'Invalid data'], JsonResponse::HTTP_BAD_REQUEST);
    }
        $product = new Product();
        $product->setName($data['name']);
        $product->setPrice((float)$data['price']);

        $productRepository->save($product, true);

        return new JsonResponse(['status' => 'Product created'], JsonResponse::HTTP_CREATED);
    }
    #[Route('/api/products/{id}', name: 'api_update_product', methods: ['PUT'])]
    public function updateProduct(int $id, Request $request, ProductRepository $productRepository): JsonResponse
    {
    $data = json_decode($request->getContent(), true);
    $product = $productRepository->find($id);
    if (!$product) {
        return new JsonResponse(['error' => 'Product not found'], JsonResponse::HTTP_NOT_FOUND);
    }
    if (!empty($data['name'])) {
        $product->setName($data['name']);
    }


    if (!empty($data['price'])) {
        $product->setPrice((float)$data['price']);
    }
        $productRepository->save($product, true);
        return new JsonResponse(['status' => 'Product updated']);
    }
    #[Route('/api/products/{id}', name: 'api_delete_product', methods: ['DELETE'])]
    public function deleteProduct(int $id, ProductRepository $productRepository): JsonResponse
    {
        $product = $productRepository->find($id);
    if (!$product) {
        return new JsonResponse(['error' => 'Product not found'], JsonResponse::HTTP_NOT_FOUND);
    }
    $productRepository->remove($product, true);
    return new JsonResponse(['status' => 'Product deleted']);
    }
    #[Route('/products/new', name: 'new_product')]
    public function newProduct(Request $request, ProductRepository $productRepository): Response
    {
    if ($request->isMethod('POST')) {
        $product = new Product();
        $product->setName($request->request->get('name'));
        $product->setPrice((float)$request->request->get('price'));
        $productRepository->save($product, true);
        return $this->redirectToRoute('products');
    }
    return $this->render('products/new.html.twig');
    }
    #[Route('/products/edit/{id}', name: 'edit_product')]
    public function editProduct(int $id, Request $request, ProductRepository $productRepository): Response
    {
    $product = $productRepository->find($id);
    if (!$product) {
        throw $this->createNotFoundException('Product not found');
    }
    if ($request->isMethod('POST')) {
    $product->setName($request->request->get('name'));
    $product->setPrice((float)$request->request->get('price'));
    $productRepository->save($product, true);
    return $this->redirectToRoute('products');
    }
    return $this->render('products/Edit.html.twig', ['product' => $product]);
    }
}
