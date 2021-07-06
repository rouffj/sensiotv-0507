<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use App\Entity\Review;
use App\Entity\User;
Use App\DataLoader;

class AppFixtures extends Fixture
{
    private $dataLoader;

    public function __construct(DataLoader $dataLoader)
    {
        $this->dataLoader = $dataLoader;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->dataLoader->getMovies() as $movie) {
            $m = new Movie();
            $m
                ->setTitle($movie['title'])
                ->setReleaseDate($movie['releaseDate'])
                ->setDuration($movie['duration'])
                ->setImage($movie['image'])
                ->setPlot($movie['plot'])
            ;
            $manager->persist($m);
        }

        foreach ($this->dataLoader->getUsers() as $user) {
            $u = new User();
            $u
                ->setFirstName($user[0])
                ->setLastName($user[1])
                ->setEmail($user[2])
                ->setPassword($user[3])
            ;
            $manager->persist($u);
        }

        $manager->flush();

        /*
        $movie1 = $manager->getRepository(Movie::class)->findOneBy(['title' => 'Memento']);
        $user1 = $manager->getRepository(User::class)->findOneBy(['email' => 'joseph@joseph.io']);
        $user2 = $manager->getRepository(User::class)->findOneBy(['email' => 'omar@sy.io']);

        $review = new Review();
        $review
            ->setRating(5)
            ->setContent("Ca me fait mal de dire ça car j'avais bien aimé le précédent mais pour moi c'est une totale déception! Ce film sous-exploite totalement les possibilitées d'Infinity War pour uniquement pour se concentrer sur de curieux égarements dont on se fiche royalement! C'est laborieux de bout en bout, car trop boursouflé (acteurs en roue libre) et l'humour je n'en parle même pas. Pour moi c'est niveau 'thor ragnarok' ...")
            ->setMovie($movie1)
            ->setUser($user1)
        ;
        $review2 = new Review();
        $review2
            ->setRating(2)
            ->setContent("Quisque sit amet enim augue. Pellentesque iaculis, enim at efficitur malesuada, elit odio ullamcorper ante, vel scelerisque nibh diam at elit. Donec eget purus arcu. Nam blandit, massa gravida vehicula sagittis, justo ex pretium nunc, et tempor nisi eros quis velit. Aliquam ullamcorper metus a ligula tristique eleifend. Phasellus id rutrum massa. Donec ullamcorper suscipit risus. Mauris nec odio elit. In quis ipsum at leo venenatis pharetra commodo nec diam. Aenean fringilla odio tortor, placerat rutrum orci gravida nec.")
            ->setMovie($movie1)
            ->setUser($user2)
        ;

        $manager->persist($review);
        $manager->persist($review2);

        $manager->flush();
        */
    }
}
