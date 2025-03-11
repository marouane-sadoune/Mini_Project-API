<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create categories
        $categories = [];
        for ($i = 1; $i <= 5; $i++) {
            $category = new Category();
            $category->setName('Category ' . $i);
            $manager->persist($category);
            $categories[] = $category; // Store the category for later use
        }

        // Create products and assign them to categories
        for ($i = 1; $i <= 20; $i++) {
            $product = new Product();
            $product->setName('Product ' . $i);
            $product->setPrice(mt_rand(10, 100));
            $product->setDescription('Description for product ' . $i);

            // Assign a random category to the product
            $product->setCategory($categories[array_rand($categories)]);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
