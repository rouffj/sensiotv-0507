<?php


namespace App;


class DataLoader
{
    public function getMovies(): array
    {
        return [
            ['id' => 1, 'title' => 'Memento', 'releaseDate' => new \DateTime('2000-01-01'), 'plot' => 'Plot 1', 'image' => '/assets/images/movie-image-samples/memento.jpeg'],
            ['id' => 2, 'title' => 'Insomnia', 'releaseDate' => new \DateTime('2002-03-04'), 'plot' => 'Plot 2', 'image' => '/assets/images/movie-image-samples/insomnia.jpeg'],
            ['id' => 3, 'title' => 'The Dark Knight ', 'releaseDate' => new \DateTime('2008-05-01'), 'plot' => 'Plot 3', 'image' => '/assets/images/movie-image-samples/the-dark-knight.jpeg'],
            ['id' => 4, 'title' => 'Inception', 'releaseDate' => new \DateTime('2010-02-05'), 'plot' => 'Plot 4', 'image' => '/assets/images/movie-image-samples/inception.jpeg'],
            ['id' => 5, 'title' => 'Man Of Steel', 'releaseDate' => new \DateTime('2013-05-05'), 'plot' => 'Plot 5', 'image' => '/assets/images/movie-image-samples/man-of-steel.jpeg'],
            ['id' => 6, 'title' => 'Dunkirk', 'releaseDate' => new \DateTime('2017-06-07'), 'plot' => 'Plot 6', 'image' => '/assets/images/movie-image-samples/dunkirk.jpeg'],
        ];
    }

    public function getUsers(): array
    {
        return [
            ['joseph', 'ROUFF', 'joseph@joseph.io', '$2y$13$dEs4kcshNIsjFaGCjPEqZO3bSdtrG44gTLh94EON2Ez1cfJUuguAG'], #testtest
            ['omar', 'SY', 'omar@sy.io', '$2y$13$dEs4kcshNIsjFaGCjPEqZO3bSdtrG44gTLh94EON2Ez1cfJUuguAG'] #testtest
        ];
    }

    public function findMovie(int $id): array
    {
        foreach ($this->getMovies() as $movie) {
            if ($id === $movie['id']) {
                return $movie;
            }
        }
    }
}