<?php

namespace App\Tests\Controller;

use App\Entity\Fight;
use App\Repository\FightRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FightControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    /** @var EntityRepository<Fight> $fightRepository */
    private EntityRepository $fightRepository;
    private string $path = '/fight/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->fightRepository = $this->manager->getRepository(Fight::class);

        foreach ($this->fightRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Fight index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'fight[date]' => 'Testing',
            'fight[opponent1]' => 'Testing',
            'fight[opponent2]' => 'Testing',
            'fight[activity]' => 'Testing',
            'fight[users]' => 'Testing',
        ]);

        self::assertResponseRedirects('/fight');

        self::assertSame(1, $this->fightRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Fight();
        $fixture->setDate('My Title');
        $fixture->setOpponent1('My Title');
        $fixture->setOpponent2('My Title');
        $fixture->setActivity('My Title');
        $fixture->setUsers('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Fight');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Fight();
        $fixture->setDate('Value');
        $fixture->setOpponent1('Value');
        $fixture->setOpponent2('Value');
        $fixture->setActivity('Value');
        $fixture->setUsers('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'fight[date]' => 'Something New',
            'fight[opponent1]' => 'Something New',
            'fight[opponent2]' => 'Something New',
            'fight[activity]' => 'Something New',
            'fight[users]' => 'Something New',
        ]);

        self::assertResponseRedirects('/fight');

        $fixture = $this->fightRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getOpponent1());
        self::assertSame('Something New', $fixture[0]->getOpponent2());
        self::assertSame('Something New', $fixture[0]->getActivity());
        self::assertSame('Something New', $fixture[0]->getUsers());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Fight();
        $fixture->setDate('Value');
        $fixture->setOpponent1('Value');
        $fixture->setOpponent2('Value');
        $fixture->setActivity('Value');
        $fixture->setUsers('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/fight');
        self::assertSame(0, $this->fightRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}
