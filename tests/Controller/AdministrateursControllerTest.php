<?php

namespace App\Test\Controller;

use App\Entity\Administrateurs;
use App\Repository\AdministrateursRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdministrateursControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private AdministrateursRepository $repository;
    private string $path = '/administrateurs/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Administrateurs::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Administrateur index');

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
            'administrateur[identifiant]' => 'Testing',
            'administrateur[password]' => 'Testing',
            'administrateur[email]' => 'Testing',
            'administrateur[compte]' => 'Testing',
        ]);

        self::assertResponseRedirects('/administrateurs/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Administrateurs();
        $fixture->setIdentifiant('My Title');
        $fixture->setPassword('My Title');
        $fixture->setEmail('My Title');
        $fixture->setCompte('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Administrateur');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Administrateurs();
        $fixture->setIdentifiant('My Title');
        $fixture->setPassword('My Title');
        $fixture->setEmail('My Title');
        $fixture->setCompte('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'administrateur[identifiant]' => 'Something New',
            'administrateur[password]' => 'Something New',
            'administrateur[email]' => 'Something New',
            'administrateur[compte]' => 'Something New',
        ]);

        self::assertResponseRedirects('/administrateurs/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getIdentifiant());
        self::assertSame('Something New', $fixture[0]->getPassword());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getCompte());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Administrateurs();
        $fixture->setIdentifiant('My Title');
        $fixture->setPassword('My Title');
        $fixture->setEmail('My Title');
        $fixture->setCompte('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/administrateurs/');
    }
}
