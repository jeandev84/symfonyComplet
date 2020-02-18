<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


/**
 * Class EmailsTest
 * @package App\Tests
*/
class EmailsTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $client->enableProfiler(); # we add this
        $crawler = $client->request('GET', '/home');

        $mailCollector = $client->getProfile()->getCollector('swiftmailer');

        $this->assertSame(1, $mailCollector->getMessageCount());

        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        $this->assertInstanceOf('Swift_Message', $message);
        $this->assertSame('Hello Email', $message->getSubject());
        $this->assertSame('send@example.com', key($message->getForm()));
        $this->assertContains('You dit it! You registred!', $message->getBody());



        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertContains('Hello world', $crawler->filter('h1')->text());
    }
}
