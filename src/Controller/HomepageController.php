<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;

#[Route('homepage/', name: 'homepage_')]
class HomepageController extends AbstractController
{
    #[Route('index', name: 'display')]
    public function index(EntityManagerInterface $em): Response
    {
        $contact = $em->getRepository(Contact::class)
            ->findAll();

        return $this->render('homepage/index.html.twig', [
            'contacts' => $contact,
        ]);
    }

    #[Route('delete/{id}', name: 'delete')]
    public function deleteContact(Request $request, EntityManagerInterface $em, Contact $contact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $em ->remove($contact);
            $em->flush();
        }

        return $this->redirectToRoute('homepage_display', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('new', name: 'create', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($contact);
            $em->flush();


            return $this->redirectToRoute('homepage_display', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('form/create.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contact $contact, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('homepage_display', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('form/create.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }
}
