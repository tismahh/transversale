<?php

namespace App\Tests\Controller;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class EventControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $eventRepository;
    private string $path = '/event/cotroller/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->eventRepository = $this->manager->getRepository(Event::class);

        foreach ($this->eventRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Event index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'event[title]' => 'Testing',
            'event[description]' => 'Testing',
            'event[startDate]' => 'Testing',
            'event[endDate]' => 'Testing',
            'event[capacity]' => 'Testing',
            'event[interestCount]' => 'Testing',
            'event[organizer]' => 'Testing',
            'event[bureau]' => 'Testing',
            'event[club]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->eventRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Event();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setStartDate('My Title');
        $fixture->setEndDate('My Title');
        $fixture->setCapacity('My Title');
        $fixture->setInterestCount('My Title');
        $fixture->setOrganizer('My Title');
        $fixture->setBureau('My Title');
        $fixture->setClub('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Event');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Event();
        $fixture->setTitle('Value');
        $fixture->setDescription('Value');
        $fixture->setStartDate('Value');
        $fixture->setEndDate('Value');
        $fixture->setCapacity('Value');
        $fixture->setInterestCount('Value');
        $fixture->setOrganizer('Value');
        $fixture->setBureau('Value');
        $fixture->setClub('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'event[title]' => 'Something New',
            'event[description]' => 'Something New',
            'event[startDate]' => 'Something New',
            'event[endDate]' => 'Something New',
            'event[capacity]' => 'Something New',
            'event[interestCount]' => 'Something New',
            'event[organizer]' => 'Something New',
            'event[bureau]' => 'Something New',
            'event[club]' => 'Something New',
        ]);

        self::assertResponseRedirects('/event/cotroller/');

        $fixture = $this->eventRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getStartDate());
        self::assertSame('Something New', $fixture[0]->getEndDate());
        self::assertSame('Something New', $fixture[0]->getCapacity());
        self::assertSame('Something New', $fixture[0]->getInterestCount());
        self::assertSame('Something New', $fixture[0]->getOrganizer());
        self::assertSame('Something New', $fixture[0]->getBureau());
        self::assertSame('Something New', $fixture[0]->getClub());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Event();
        $fixture->setTitle('Value');
        $fixture->setDescription('Value');
        $fixture->setStartDate('Value');
        $fixture->setEndDate('Value');
        $fixture->setCapacity('Value');
        $fixture->setInterestCount('Value');
        $fixture->setOrganizer('Value');
        $fixture->setBureau('Value');
        $fixture->setClub('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/event/cotroller/');
        self::assertSame(0, $this->eventRepository->count([]));
    }
}
