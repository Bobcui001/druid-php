<?php
/**
 * @author    jhrncar
 * @copyright PIXEL FEDERATION
 * @license   Internal use only
 */

namespace Druid\Driver\Guzzle;

use Druid\Driver\DriverConnectionInterface;
use Druid\Driver\ResponseInterface;
use Druid\Query\QueryInterface;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

class Connection implements DriverConnectionInterface
{
    /**
     * @var Client
     */
    private $guzzle;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Connection constructor.
     * @param Client $guzzle
     * @param SerializerInterface $serializer
     */
    public function __construct(Client $guzzle, SerializerInterface $serializer)
    {
        $this->guzzle = $guzzle;
        $this->serializer = $serializer;
    }

    /**
     * @param QueryInterface $query
     * @return ResponseInterface
     */
    public function send(QueryInterface $query)
    {
        $body = $this->serializer->serialize($query, 'json');
        $response = $this->guzzle->post('', ['body' => $body]);
        return new Response($response);
    }
}