<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\GoalSection;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\InterestManager;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/edit", name="edit", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request): Response
    {
        $auth = $this->getUser();

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $auth->getUsername()]);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('main');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/interests", name="interests")
     * @return Response
     */
    public function editInterests(InterestManager $interestManager): Response
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $this->getUser()->getUsername()]);

        $interests = $this->getDoctrine()
            ->getRepository(GoalSection::class)
            ->findAll();

        $currentInterests = $interestManager->parseInterests($interests, $user, true);

        $interests = $interestManager->parseInterests($interests, $user, false);

        return $this->render('user/interests.html.twig', [
            'interests' => $interests,
            'currents' => $currentInterests,
        ]);
    }

    /**
     * @Route("/interests/remove/{id}", name="interests_remove")
     * @param GoalSection $goalSection
     * @return RedirectResponse
     */
    public function removeInterest(GoalSection $goalSection)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $this->getUser()->getUsername()]);

        $user->removeInterest($goalSection);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('user_interests');
    }

    /**
     * @Route("/interests/add/{id}", name="interests_add")
     * @param GoalSection $goalSection
     * @return RedirectResponse
     */
    public function addInterest(GoalSection $goalSection)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $this->getUser()->getUsername()]);

        $user->addInterest($goalSection);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('user_interests');
    }

    /**
     * @Route("/valid/{id}", name="validate")
     * @param Goal $goal
     * @return RedirectResponse
     */
    public function validateTask(Goal $goal)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $this->getUser()->getUsername()]);
        $user->setExperience($user->getExperience() + 500);
        $user->removeGoal($goal);
        if ($user->getExperience() >= 1000){
            $user->setLevel($user->getLevel() + 1);
            $user->setExperience(0);
            $this->addFlash(
                'success',
                'Vous avez gagné un niveau !'
            );
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('main');
    }
}
