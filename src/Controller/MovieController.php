<?php

namespace App\Controller;

use App\DataLoader;
use App\Omdb\OmdbClient;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MovieController extends AbstractController
{
    /**
     * @Route("/movie/top-rated")
     */
    public function topRated(MovieRepository $movieRepository): Response
    {
        //$dataLoader = new DataLoader();
        //$movies = $dataLoader->getMovies();

        $movies = $movieRepository->findAll();

        return $this->render('movie/top-rated.html.twig', [
            'movies' => $movies
        ]);
    }

    /**
     * @Route("/movie/genres")
     */
    public function genres(): Response
    {
        return $this->render('movie/genres.html.twig');
    }

    /**
     * @Route("/movie/latest")
     */
    public function latest(): Response
    {
        return $this->render('movie/latest.html.twig');
    }

    /**
     * @Route("/movie/{id}", name="movie_details", requirements={"id": "\d+"})
     */
    public function details($id, MovieRepository $movieRepository, OmdbClient $omdb): Response
    {
        $movie = $movieRepository->findOneBy(['id' => $id]);
        $movieFromOmdb = $omdb->requestByTitle($movie->getTitle());

        dump($movieFromOmdb);
        return $this->render('movie/details.html.twig', [
            'movie' => $movie,
            'movieFromOmdb' => $movieFromOmdb,
        ]);
    }


    /**
     * @Route("/api/movies", name="api_movies")
     */
    public function apiList(): Response
    {
        $movieCollection = [
            ['id' => 1, 'title' => 'The lord of the rings 1', 'duration' => 240],
            ['id' => 2, 'title' => 'The lord of the rings 2', 'duration' => 230],
            ['id' => 3, 'title' => 'Le flic de Beverly Hills 1', 'duration' => 100],
            ['id' => 4, 'title' => 'Le flic de Beverly Hills 2', 'duration' => 100],
        ];

        $response = new JsonResponse();
        $response->setData($movieCollection);

        return $response;
    }

    /**
     * @Route("/api/movies/{id}", name="api_movie_show", requirements={"id": "\d+"})
     */
    public function apiShow($id): Response
    {
        return new JsonResponse(["id" => $id]);
    }
}
