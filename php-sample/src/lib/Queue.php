<?php

namespace Lib;

defined('APP_ROOT') or exit('No direct script access allowed');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class Queue
 * @package Lib
 */
class Queue
{

  private $exchange;
  private $queue;
  private $config;
  private $consumerTag;
  private $connection;

  public function __construct()
  {
    $this->exchange = 'router';
    $this->queue = 'msgs';
    $this->config = Config::$value;
    $this->consumerTag = 'consumer';
    $this->connection = $this->getConnection();
  }

  private function getConnection(): AMQPStreamConnection
  {
    try {
      return new AMQPStreamConnection($this->config['rabbitmq']['host'],
        $this->config['rabbitmq']['port'],
        $this->config['rabbitmq']['username'],
        $this->config['rabbitmq']['password'],
        $this->config['rabbitmq']['vhost']
      );
    } catch (\Exception $exception) {
      $response = new Response();
      $response->send(array("message" => "rabbitMQ error.."));
    }
  }

  private function getChannel($queue = "msgs")
  {
    $channel = $this->connection->channel();
    $channel->queue_declare($queue, false, true, false, false);
    $channel->exchange_declare($this->exchange,
      AMQPExchangeType::DIRECT,
      false,
      true,
      false
    );
    return $channel->queue_bind($queue, $this->exchange);
  }

  public function publish($messageBody = "Demo text...", $queue = "msgs")
  {
    $channel = $this->getChannel($queue);
    $message = new AMQPMessage($messageBody,
      array(
        'content_type' => 'text/plain',
        'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
      )
    );
    $channel->basic_publish($message, $this->exchange);

    $channel->close();
    try {
      $this->connection->close();
    } catch (\Exception $e) {
    }
  }

  public function consume($queue = "msgs")
  {

    function process_message($message)
    {
      echo "\n--------\n";
      echo $message->body;
      echo "\n--------\n";

      $message->ack();

      // Send a message with the string "quit" to cancel the consumer.
      if ($message->body === 'quit') {
        $message->getChannel()->basic_cancel($message->getConsumerTag());
      }
    }

    $channel = $this->connection->channel();
    $channel->basic_consume($queue, $this->consumerTag,
      false,
      false,
      false,
      false,
      'process_message'
    );

    function shutdown($channel, $connection)
    {
      $channel->close();
      $connection->close();
    }

    register_shutdown_function('shutdown', $channel, $this->connection);

// Loop as long as the channel has callbacks registered
    while ($channel->is_consuming()) {
      try {
        $channel->wait();
      } catch (\ErrorException $e) {
      }
    }


  }

}
