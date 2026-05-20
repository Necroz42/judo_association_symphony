<?php

namespace App\Tests\Controller;

use App\Entity\TrainingSession;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class TrainingSessionControllerTest extends WebTestCase
{
    private $client;
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();

        foreach ($this->manager->getRepository(TrainingSession::class)->findAll() as $obj) {
            $this->manager->remove($obj);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->request('GET', '/training-session');

        self::assertResponseIsSuccessful();
    }

    public function testNewPage(): void
    {
        $this->client->request('GET', '/training-session/new');

        self::assertResponseIsSuccessful();
    }

    public function testCreateTrainingSession(): void
    {
        $this->client->request('GET', '/training-session/new');

        self::assertResponseIsSuccessful();
    }

    public function testShowAndEditPagesExist(): void
    {
        $session = new TrainingSession();

        $session->setLocation('Dojo');

        $this->manager->persist($session);
        $this->manager->flush();

        $this->client->request('/training-session/' . $session->getId());
        self::assertResponseIsSuccessful();

        $this->client->request('/training-session/' . $session->getId() . '/edit');
        self::assertResponseIsSuccessful();
    }
}