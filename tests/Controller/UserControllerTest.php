<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class UserControllerTest extends WebTestCase
{
    private $client;
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();

        foreach ($this->manager->getRepository(User::class)->findAll() as $u) {
            $this->manager->remove($u);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->request('GET', '/user');

        self::assertResponseIsSuccessful();
    }

    public function testNewPage(): void
    {
        $this->client->request('GET', '/user/new');

        self::assertResponseIsSuccessful();
    }

    public function testCreateUser(): void
    {
        $this->client->request('GET', '/user/new');

        self::assertResponseIsSuccessful();

        $this->client->submitForm('Save', [
            'user[email]' => 'test@example.com',
            'user[firstName]' => 'John',
            'user[lastName]' => 'Doe',
            'user[password]' => 'password123',
        ]);

        self::assertSame(1, $this->manager->getRepository(User::class)->count([]));
    }

    public function testShowPage(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setRoles(['ROLE_MEMBER']);
        $user->setPassword('fake'); // ok pour test simple

        $this->manager->persist($user);
        $this->manager->flush();

        $this->client->request('/user/' . $user->getId());

        self::assertResponseIsSuccessful();
    }
}