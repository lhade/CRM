<?php

namespace App\Tests;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Assert;

class TestHomepageTest extends KernelTestCase
{
    private function setContact(){
        $contact = new Contact();
        $contact    ->setFirstname('Guigui')
                    ->setLastname('Jojo')
                    ->setEmail('coucoujetest@gmail.com')
                    ->setPhone('70.07.70.07.70');
    }


    public function testNotEmptyFirstname(): void{
            $goodFirstname = $this->$contact->firstname;
            $this->assertTrue($goodFirstname != "");
        }

}
