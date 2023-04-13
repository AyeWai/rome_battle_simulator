<?php

namespace App\Test\Controller;

use App\Entity\Centuria;
use App\Repository\CenturiaRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CenturiaControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private CenturiaRepository $repository;
    private string $path = '/centuria/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Centuria::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Centurium index');

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
            'centurium[health]' => 'Testing',
            'centurium[centurion]' => 'Testing',
            'centurium[cohort]' => 'Testing',
            'centurium[centuriatype]' => 'Testing',
        ]);

        self::assertResponseRedirects('/centuria/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Centuria();
        $fixture->setHealth('My Title');
        $fixture->setCenturion('My Title');
        $fixture->setCohort('My Title');
        $fixture->setCenturiatype('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Centurium');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Centuria();
        $fixture->setHealth('My Title');
        $fixture->setCenturion('My Title');
        $fixture->setCohort('My Title');
        $fixture->setCenturiatype('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'centurium[health]' => 'Something New',
            'centurium[centurion]' => 'Something New',
            'centurium[cohort]' => 'Something New',
            'centurium[centuriatype]' => 'Something New',
        ]);

        self::assertResponseRedirects('/centuria/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getHealth());
        self::assertSame('Something New', $fixture[0]->getCenturion());
        self::assertSame('Something New', $fixture[0]->getCohort());
        self::assertSame('Something New', $fixture[0]->getCenturiatype());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Centuria();
        $fixture->setHealth('My Title');
        $fixture->setCenturion('My Title');
        $fixture->setCohort('My Title');
        $fixture->setCenturiatype('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/centuria/');
    }
}
