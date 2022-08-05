<?php

namespace App\Tests;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Assert;

class TestHomepageTest extends KernelTestCase
{
    public function testIndex(): void
    {
        $contact = new Contact();
        $contact    ->setFirstname('Guigui')
                    ->setLastname('Jojo')
                    ->setEmail('coucoujetest@gmail.com')
                    ->setPhone('70.07.70.07.70');
        $kernel = self::bootKernel();


        //$this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }
}
