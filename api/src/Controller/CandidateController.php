<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Candidate;
use App\Form\CandidateFormType;
use DateTimeImmutable;

class CandidateController extends AbstractController
{
    #[Route('/candidate/greetings/{id}', name: 'greetings')]
    public function greetings(int $id, ManagerRegistry $doctrine): Response
    {
        $candidate = $doctrine->getRepository(Candidate::class)->find($id);
        return $this->render('candidate/greetings.html.twig', [
            'candidate' => $candidate,
        ]);
    }

    #[Route('/candidate/new', name: 'candidate_new')]
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $candidate = new Candidate();
        $form = $this->createForm(CandidateFormType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $expSalary = $form->get('expectedSalary')->getData();
            // fill data from form
            $candidate->setFirstName($form->get('firstName')->getData());
            $candidate->setLastName($form->get('lastName')->getData());
            $candidate->setEmail($form->get('email')->getData());
            $candidate->setPhoneNumber($form->get('phoneNumber')->getData());
            $candidate->setExpectedSalary($expSalary);
            $candidate->setLevel(($expSalary < 5000 ? 'junior' : ($expSalary < 9999 ? 'regular' : 'senior')));
            $candidate->setPosition($form->get('position')->getData());
            $candidate->setCreated(new DateTimeImmutable());
            $candidate->setUpdated(new DateTimeImmutable());
            $doctrine->getRepository(Candidate::class)->save($candidate, true);

            return $this->redirectToRoute('greetings', ['id' => $candidate->getId()]);
        }

        return $this->render('candidate/new.html.twig', [
            'candidateForm' => $form->createView(),
        ]);
    }
}
