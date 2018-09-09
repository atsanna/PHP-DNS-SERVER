<?php

require "vendor/autoload.php";

// JSON formatted DNS records file
$record_file = 'dns_record.json';
$jsonResolver = new yswery\DNS\JsonResolver($record_file);

// Recursive resolver acting as a fallback to the JsonResolver
$recursiveResolver = new yswery\DNS\RecursiveResolver;

$stackableResolver = new yswery\DNS\StackableResolver(array($jsonResolver, $recursiveResolver));

// Creating a new instance of our class
$dns = new yswery\DNS\Server($stackableResolver);

//You can set any PSR logger, the echo logger outputs to the console.
$dns->setLogger(new \yswery\DNS\EchoLogger());

// Starting our DNS server
$dns->start();
