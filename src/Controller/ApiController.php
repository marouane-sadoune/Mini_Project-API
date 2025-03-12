<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends AbstractController
{
    private $entityManager;
    private $validator;
    private $serializer;

    public function __construct(
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        SerializerInterface $serializer
    ) {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    #[Route('/api/products', name: 'api_products', methods: ['GET'])]
    public function getProducts(ProductRepository $productRepository): JsonResponse
    {
        $products = $productRepository->findAll();
        $data = $this->serializer->serialize($products, 'json', ['groups' => 'product']);
        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    #[Route('/api/products', name: 'api_create_product', methods: ['POST'])]
    public function createProduct(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $product = new Product();
        $product->setName($data['name'] ?? '');
        $product->setPrice((float)($data['price'] ?? 0));

        $errors = $this->validator->validate($product);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return new JsonResponse(['status' => 'Product created'], JsonResponse::HTTP_CREATED);
    }

    #[Route('/api/products/{id}', name: 'api_update_product', methods: ['PUT'])]
    public function updateProduct(int $id, Request $request, ProductRepository $productRepository): JsonResponse
    {
        $product = $productRepository->find($id);
        if (!$product) {
            throw new NotFoundHttpException('Product not found');
        }

        $data = json_decode($request->getContent(), true);
        if (!empty($data['name'])) {
            $product->setName($data['name']);
        }
        if (!empty($data['price'])) {
            $product->setPrice((float)$data['price']);
        }

        $this->entityManager->flush();

        return new JsonResponse(['status' => 'Product updated']);
    }

    #[Route('/api/products/{id}', name: 'api_delete_product', methods: ['DELETE'])]
    public function deleteProduct(int $id, ProductRepository $productRepository): JsonResponse
    {
        $product = $productRepository->find($id);
        if (!$product) {
            throw new NotFoundHttpException('Product not found');
        }

        $this->entityManager->remove($product);
        $this->entityManager->flush();

        return new JsonResponse(['status' => 'Product deleted']);
    }
    #[Route('/api/products/{id}', name: 'api_update_product', methods: ['PUT'])]
public function updateProduct(int $id, Request $request, ProductRepository $productRepository): JsonResponse
{
    $product = $productRepository->find($id);
    if (!$product) {
        throw new NotFoundHttpException('Product not found');
    }

    $data = json_decode($request->getContent(), true);
    if (!empty($data['name'])) {
        $product->setName($data['name']);
    }
    if (!empty($data['price'])) {
        $product->setPrice((float)$data['price']);
    }

    $errors = $this->validator->validate($product);
    if (count($errors) > 0) {
        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = $error->getMessage();
        }
        return new JsonResponse(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
    }

    $this->entityManager->flush();

    return new JsonResponse(['status' => 'Product updated']);
}
}
