<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $john = new User();
        $john->setUsername('john')
            ->setPassword($this->passwordEncoder->encodePassword($john, '123'));
        $manager->persist($john);

        $henri = new User();
        $henri->setUsername('henri')
            ->setPassword($this->passwordEncoder->encodePassword($henri, '123'));
        $manager->persist($henri);

        $tomates = new Product();
        $tomates->setName('tomates')->setPrice(1);
        $manager->persist($tomates);
        $mozza = new Product();
        $mozza->setName('mozza')->setPrice(2);
        $manager->persist($mozza);
        $basilic = new Product();
        $basilic->setName('baz')->setPrice(3);
        $manager->persist($basilic);

        $order2 = new Order();
        $orderbag = [$basilic];
        $order2->setOwner($john);
        $order2->setProducts($orderbag);
        $manager->persist($order2);

        $order1 = new Order();
        $orderbag = [$tomates, $mozza];
        $order1->setOwner($henri);
        $order1->setProducts($orderbag);
        $manager->persist($order1);

        $manager->flush();
    }
}
