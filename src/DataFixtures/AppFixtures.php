<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
        
    }
    public function load(ObjectManager $manager): void
{
    // Create 20 sample products
    for ($i = 1; $i <= 20; $i++) {
        $product = new Product();
        $product->setName('Product ' . $i);
        $product->setPrice(mt_rand(10, 100));
        $product->setDescription('Description for product ' . $i);

        $manager->persist($product);
    }

    $manager->flush();
}
}

