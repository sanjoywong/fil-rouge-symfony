<?php

namespace App\Test\Controller;

use App\Entity\Salles;
use App\Repository\SallesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SallesControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private SallesRepository $repository;
    private string $path = '/salles/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Salles::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Salle index');

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
            'salle[nom_salle]' => 'Testing',
            'salle[caracteristique]' => 'Testing',
            'salle[id_etablissement]' => 'Testing',
        ]);

        self::assertResponseRedirects('/salles/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Salles();
        $fixture->setNom_salle('My Title');
        $fixture->setCaracteristique('My Title');
        $fixture->setId_etablissement('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Salle');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Salles();
        $fixture->setNom_salle('My Title');
        $fixture->setCaracteristique('My Title');
        $fixture->setId_etablissement('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'salle[nom_salle]' => 'Something New',
            'salle[caracteristique]' => 'Something New',
            'salle[id_etablissement]' => 'Something New',
        ]);

        self::assertResponseRedirects('/salles/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom_salle());
        self::assertSame('Something New', $fixture[0]->getCaracteristique());
        self::assertSame('Something New', $fixture[0]->getId_etablissement());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Salles();
        $fixture->setNom_salle('My Title');
        $fixture->setCaracteristique('My Title');
        $fixture->setId_etablissement('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/salles/');
    }
}
