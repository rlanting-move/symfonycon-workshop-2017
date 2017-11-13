<?php
declare(strict_types = 1);

namespace SymfonyCon\Mastermind\Adapters\Web;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group integration
 */
class WebIntegrationTest extends WebTestCase
{
    protected static $class = Kernel::class;

    /**
     * @var Client
     */
    private $client;

    protected function setUp()
    {
        $this->client = self::createClient();
        $this->client->followRedirects();
    }

    public function test_it_returns_404()
    {
        $this->client->request('GET', '/');

        $this->assertSame(404, $this->client->getResponse()->getStatusCode(), $this->extractLastResponseTitle());
    }

    private function extractLastResponseTitle(): string
    {
        return html_entity_decode(
            (string) preg_replace(
                '#.*?<title>(.*?)</title>.*#smi',
                '$1',
                $this->client->getResponse()->getContent()
            )
        );
    }
}
