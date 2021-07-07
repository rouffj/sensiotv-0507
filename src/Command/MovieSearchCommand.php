<?php

namespace App\Command;

use App\Omdb\OmdbClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\Exception\TransportException;

class MovieSearchCommand extends Command
{
    protected static $defaultName = 'app:movie:search';
    protected static $defaultDescription = 'This command allows to search a movie among all IMDB movies.';

    /**
     * @var OmdbClient
     */
    private $omdb;

    public function __construct(OmdbClient $omdb, string $name = null)
    {
        parent::__construct($name);

        $this->omdb = $omdb;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('title', InputArgument::OPTIONAL, 'The title of the movie your are looking for. Incomplete title accepted.')
            ->addOption('type', 't', InputOption::VALUE_OPTIONAL, 'Which media to display: movie, game, series.', 'movie')
        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        if (!$title = $input->getArgument('title')) {
            $title = $io->ask('What is the title you are looking for?', 'Alien');
        }
        $io->progressStart(1);
        //sleep(2);

        try {
            $foundMovies = $this->omdb->requestBySearch($title, ['page' => 1, 'type' => $input->getOption('type')]);
            $rows = [];
            foreach ($foundMovies['Search'] as $movie) {
                $rows[] = [$movie['Title'], $movie['Year'], $movie['Type'], sprintf('https://www.imdb.com/title/%s/', $movie['imdbID'])];
            }

            $io->progressFinish();
            //dump($foundMovies);
            $io->table(['Title', 'Year', 'Type', 'URL'], $rows);
        } catch(TransportException $e) {
            $io->error('Movie "'. $title .'" not found!');
        }

        return 0;
    }
}
