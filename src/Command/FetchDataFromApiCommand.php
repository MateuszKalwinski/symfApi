<?php

namespace App\Command;

use App\Entity\Post;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class FetchDataFromApiCommand extends Command
{

    private $entityManager;
    private $client;


    public function __construct(EntityManagerInterface $entityManager, HttpClientInterface $client)
    {
        $this->entityManager = $entityManager;
        $this->client = $client;

        parent::__construct();
    }


    protected function configure(): void
    {
        $this->setName('fetch-data-from-api')
            ->setDescription('This command runs fetching data from API.')
            ->setHelp('Run this command to fetch data from API');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $postResponse = $this->client->request(
            'GET',
            'https://jsonplaceholder.typicode.com/posts'
        );


        if ($postResponse->getStatusCode() !== 200) return Command::FAILURE;

        $posts = json_decode($postResponse->getContent(), true);

        foreach ($posts as $item) {

            $userResponse = $this->client->request(
                'GET',
                'https://jsonplaceholder.typicode.com/users/' . $item['userId']
            );

            if ($userResponse->getStatusCode() !== 200) return Command::FAILURE;

            $user = json_decode($userResponse->getContent(), true);

            $post = new Post();
            $post->setUserName($user['name']);
            $post->setExternalUserId($user['id']);
            $post->setExternalId($item['id']);
            $post->setTitle($item['title']);
            $post->setBody($item['body']);

            $this->entityManager->persist($post);
            $this->entityManager->flush();
        }

        return Command::SUCCESS;
    }
}