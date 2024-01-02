<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ConferenceController extends AbstractController
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */

    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, ConferenceRepository $conferenceRepository): Response
    {
        return new Response($twig->render('conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]));
    }

    #[Route('/conference/{id}', name: 'conference')]
    public function show(Environment $twig, Conference $conference, CommentRepository $commentRepository): Response
    {
      return new Response($twig->render('conference/show.html.twig', [
          'conference' => $conference,
          'comments' => $commentRepository->findBy(['conference' => $conference], ['createdAt' => 'DESC']),
      ]));
    }




}
