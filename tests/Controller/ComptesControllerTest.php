<?php

namespace App\Test\Controller;

use App\Entity\Comptes;
use App\Repository\ComptesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ComptesControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ComptesRepository $repository;
    private string $path = '/comptes/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Comptes::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Compte index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'compte[creation_compte]' => 'Testing',
            'compte[email]' => 'Testing',
            'compte[envoi_email]' => 'Testing',
            'compte[token]' => 'Testing',
            'compte[email_verification]' => 'Testing',
        ]);

        self::assertResponseRedirects('/comptes/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Comptes();
        $fixture->setCreation_compte('My Title');
        $fixture->setEmail('My Title');
        $fixture->setEnvoi_email('My Title');
        $fixture->setToken('My Title');
        $fixture->setEmail_verification('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Compte');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Comptes();
        $fixture->setCreation_compte('My Title');
        $fixture->setEmail('My Title');
        $fixture->setEnvoi_email('My Title');
        $fixture->setToken('My Title');
        $fixture->setEmail_verification('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'compte[creation_compte]' => 'Something New',
            'compte[email]' => 'Something New',
            'compte[envoi_email]' => 'Something New',
            'compte[token]' => 'Something New',
            'compte[email_verification]' => 'Something New',
        ]);

        self::assertResponseRedirects('/comptes/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCreation_compte());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getEnvoi_email());
        self::assertSame('Something New', $fixture[0]->getToken());
        self::assertSame('Something New', $fixture[0]->getEmail_verification());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Comptes();
        $fixture->setCreation_compte('My Title');
        $fixture->setEmail('My Title');
        $fixture->setEnvoi_email('My Title');
        $fixture->setToken('My Title');
        $fixture->setEmail_verification('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/comptes/');
    }
}
