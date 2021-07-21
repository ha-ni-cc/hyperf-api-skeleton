<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'generator' => [
        'amqp' => [
            'consumer' => [
                'namespace' => 'AppConfig\\Amqp\\Consumer',
            ],
            'producer' => [
                'namespace' => 'AppConfig\\Amqp\\Producer',
            ],
        ],
        'aspect' => [
            'namespace' => 'AppConfig\\Aspect',
        ],
        'command' => [
            'namespace' => 'AppConfig\\Command',
        ],
        'controller' => [
            'namespace' => 'AppConfig\\Controller',
        ],
        'job' => [
            'namespace' => 'AppConfig\\Job',
        ],
        'listener' => [
            'namespace' => 'AppConfig\\Listener',
        ],
        'middleware' => [
            'namespace' => 'AppConfig\\Middleware',
        ],
        'Process' => [
            'namespace' => 'AppConfig\\Processes',
        ],
    ],
];
