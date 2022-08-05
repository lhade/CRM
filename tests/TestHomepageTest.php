<?php

namespace App\Tests;

use App\Controller\HomepageController;
use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Boolean;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class TestHomepageTest extends TestCase
{

    private $contact;
    private $contactfalse;
    private $homepageController;

    /**
     * @return void
     */
    protected function setUp(): void{
        $contact = new Contact();
        $contact->setFirstname('Guigui')
                ->setLastname('Jojo')
                ->setEmail('coucoujetest@gmail.com')
                ->setPhone('0707070707');
        $this->contact= $contact;

        $contactfalse = new Contact();
        $contactfalse->setFirstname('')
                ->setLastname('')
                ->setEmail('coucoujetest@gmail')
                ->setPhone('70.07.70');
        $this->contactfalse= $contactfalse;

        $this->homepageController = new HomepageController;
    }

    /**
     * @return void
     */
    public function testNotEmptyFirstname(): void{
            $goodFirstname = $this->contact->getFirstname();
            $this->assertTrue($goodFirstname != "");
        }

        /**
        * @return void
        */
       public function testEmptyFirstname(): void{
               $falseFirstname = $this->contactfalse->getFirstname();
               $this->assertFalse($falseFirstname != "");
           }

           /**
     * @return void
     */
    public function testNotEmptyLastname(): void{
        $goodLastname = $this->contact->getLastname();
        $this->assertTrue($goodLastname != "");
    }

    /**
    * @return void
    */
   public function testEmptyLastname(): void{
           $falseLastname = $this->contactfalse->getLastname();
           $this->assertFalse($falseLastname != "");
       }

    /**
     * @return void
     */
    public function testMailValid(): void{
        $validMail = $this->homepageController->isValidMail($this->contact->getEmail());
        $this->assertTrue($validMail);
    }

    /**
     * @return void
     */
    public function testPhoneValid(): void{
        $falsePhone = $this->homepageController->isValidPhone($this->contactfalse->getPhone());
        $this->assertFalse($falsePhone);
    }
}
