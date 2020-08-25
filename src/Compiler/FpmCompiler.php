<?php

declare (strict_types = 1);

namespace Jderusse\Warmup\Compiler;

use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class FpmCompiler implements CompilerInterface
{
    private $port;

    public function __construct($port = 9000)
    {
        $this->port = $port;
    }

    public function compile(string $file)
    {
        require_once __DIR__.'/../../../../autoload.php';

        $fastcgi = new \Adoy\FastCGI\Client('127.0.0.1', $this->port);

        $fastcgi->request([
            'GATEWAY_INTERFACE' => 'FastCGI/1.0',
            'REQUEST_METHOD' => 'GET',
            'SCRIPT_FILENAME' => realpath(__DIR__.'/../Resource/server.php'),
            'QUERY_STRING' => "file={$file}",
        ], '');
    }
}
