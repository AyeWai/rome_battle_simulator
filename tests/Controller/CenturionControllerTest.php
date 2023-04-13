<?php

namespace App\Test\Controller;

use App\Entity\Centurion;
use App\Repository\CenturionRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CenturionControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private CenturionRepository $repository;
    private string $path = '/centurion/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Centurion::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Centurion index');

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
            'centurion[name]' => 'Testing',
            'centurion[age]' => 'Testing',
            'centurion[time_served]' => 'Testing',
            'centurion[centuria]' => 'Testing',
        ]);

        self::assertResponseRedirects('/centurion/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Centurion();
        $fixture->setName('My Title');
        $fixture->setAge('My Title');
        $fixture->setTime_served('My Title');
        $fixture->setCenturia('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Centurion');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Centurion();
        $fixture->setName('My Title');
        $fixture->setAge('My Title');
        $fixture->setTime_served('My Title');
        $fixture->setCenturia('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'centurion[name]' => 'Something New',
            'centurion[age]' => 'Something New',
            'centurion[time_served]' => 'Something New',
            'centurion[centuria]' => 'Something New',
        ]);

        self::assertResponseRedirects('/centurion/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getAge());
        self::assertSame('Something New', $fixture[0]->getTime_served());
        self::assertSame('Something New', $fixture[0]->getCenturia());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Centurion();
        $fixture->setName('My Title');
        $fixture->setAge('My Title');
        $fixture->setTime_served('My Title');
        $fixture->setCenturia('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/centurion/');
    }
}
