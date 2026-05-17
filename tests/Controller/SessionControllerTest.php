<?php

namespace App\Tests\Controller;

use App\Entity\Session;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SessionControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    /** @var EntityRepository<Session> $sessionRepository */
    private EntityRepository $sessionRepository;
    private string $path = '/session/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->sessionRepository = $this->manager->getRepository(Session::class);

        foreach ($this->sessionRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Session index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'session[startDate]' => 'Testing',
            'session[endDate]' => 'Testing',
            'session[location]' => 'Testing',
            'session[activity]' => 'Testing',
            'session[users]' => 'Testing',
        ]);

        self::assertResponseRedirects('/session');

        self::assertSame(1, $this->sessionRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Session();
        $fixture->setStartDate('My Title');
        $fixture->setEndDate('My Title');
        $fixture->setLocation('My Title');
        $fixture->setActivity('My Title');
        $fixture->setUsers('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Session');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Session();
        $fixture->setStartDate('Value');
        $fixture->setEndDate('Value');
        $fixture->setLocation('Value');
        $fixture->setActivity('Value');
        $fixture->setUsers('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'session[startDate]' => 'Something New',
            'session[endDate]' => 'Something New',
            'session[location]' => 'Something New',
            'session[activity]' => 'Something New',
            'session[users]' => 'Something New',
        ]);

        self::assertResponseRedirects('/session');

        $fixture = $this->sessionRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getStartDate());
        self::assertSame('Something New', $fixture[0]->getEndDate());
        self::assertSame('Something New', $fixture[0]->getLocation());
        self::assertSame('Something New', $fixture[0]->getActivity());
        self::assertSame('Something New', $fixture[0]->getUsers());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Session();
        $fixture->setStartDate('Value');
        $fixture->setEndDate('Value');
        $fixture->setLocation('Value');
        $fixture->setActivity('Value');
        $fixture->setUsers('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/session');
        self::assertSame(0, $this->sessionRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}
