<?php

namespace App\Tests\Controller;

use App\Entity\Document;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DocumentControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    private EntityManagerInterface $manager;

    /** @var EntityRepository<Document> */
    private EntityRepository $documentRepository;

    private string $path = '/document/';

    protected function setUp(): void
    {
        $this->client = static::createClient();

        $this->manager = static::getContainer()
            ->get('doctrine')
            ->getManager();

        $this->documentRepository = $this->manager
            ->getRepository(Document::class);

        foreach ($this->documentRepository->findAll() as $document) {
            $this->manager->remove($document);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->request('GET', $this->path);

        self::assertResponseIsSuccessful();

        self::assertSelectorTextContains('h1', 'Document');
    }

    public function testNewPage(): void
    {
        $this->client->request('GET', $this->path . 'new');

        self::assertResponseIsSuccessful();
    }

    public function testShow(): void
    {
        $document = new Document();

        $document->setType('PDF');
        $document->setFilePath('/uploads/test.pdf');

        $this->manager->persist($document);
        $this->manager->flush();

        $this->client->request(
            'GET',
            $this->path . $document->getId()
        );

        self::assertResponseIsSuccessful();
    }

    public function testEditPage(): void
    {
        $document = new Document();

        $document->setType('PDF');
        $document->setFilePath('/uploads/test.pdf');

        $this->manager->persist($document);
        $this->manager->flush();

        $this->client->request(
            'GET',
            $this->path . $document->getId() . '/edit'
        );

        self::assertResponseIsSuccessful();
    }
}