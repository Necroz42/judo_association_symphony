<?php

namespace App\Tests\Controller;

use App\Entity\Fight;
use App\Entity\User;
use App\Entity\Activity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FightControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;

    private string $path = '/fight/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();

        foreach ($this->manager->getRepository(Fight::class)->findAll() as $obj) {
            $this->manager->remove($obj);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->request('GET', $this->path);

        self::assertResponseIsSuccessful();
    }

    public function testNewPage(): void
    {
        $this->client->request('GET', $this->path . 'new');

        self::assertResponseIsSuccessful();
    }

    public function testCreateFight(): void
    {
        $userRepo = $this->manager->getRepository(User::class);
        $activityRepo = $this->manager->getRepository(Activity::class);

        $user = $userRepo->findOneBy([]);
        $activity = $activityRepo->findOneBy([]);

        if (!$user || !$activity) {
            self::markTestSkipped('No User or Activity in database');
        }

        $this->client->request('GET', $this->path . 'new');

        $this->client->submitForm('Save', [
            'fight[date]' => '2026-01-01T10:00',
            'fight[opponent1]' => $user->getId(),
            'fight[opponent2]' => $user->getId(),
            'fight[activity]' => $activity->getId(),
        ]);

        self::assertResponseRedirects();
    }
}