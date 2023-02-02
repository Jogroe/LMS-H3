<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = new Category();
        $category
            ->setName('Viande')
            ->setSlug('viande');
        $manager->persist($category);

        for ($i = 1; $i < 51; $i++) {
            $product = new Product();
            $product
                ->setName('Saucisse ' . $i)
                ->setSlug('product-' . $i)
                ->setDescription('Description ' . $i)
                ->setPrice('10.00')
                ->setImage('saucisse.jpg')
                ->setCategory($category)
            ;
            $manager->persist($product);
        }

        $category = new Category();
        $category
            ->setName('Legume')
            ->setSlug('legume');
        $manager->persist($category);

        $category = new Category();
        $category
            ->setName('Fruit')
            ->setSlug('fruit');
        $manager->persist($category);

        $manager->flush();
    }
}
