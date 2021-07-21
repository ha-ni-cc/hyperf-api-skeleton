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

use Hyperf\Server\Server;
use Hyperf\Server\Event;

return [
    'mode' => SWOOLE_BASE,
    'servers' => [
        [
            'name' => 'http',
            'type' => Server::SERVER_HTTP,
            'host' => '0.0.0.0',
            'port' => (int)env('HTTP_PORT', 9501),
            'sock_type' => SWOOLE_SOCK_TCP,
            'callbacks' => [
                Event::ON_REQUEST => [Hyperf\HttpServer\Server::class, 'onRequest'],
            ],
        ],
    ],
    'settings' => [
        'enable_coroutine' => true,
        'worker_num' => isDebug() ? 1 : (int)(env('WORKER_NUM', 'auto') == 'auto' ? swoole_cpu_num() : env('WORKER_NUM')),
        'pid_file' => BASE_PATH . '/runtime/hyperf.pid',
        'log_level' => SWOOLE_LOG_WARNING,
        'open_tcp_nodelay' => true,
        'max_coroutine' => 100000,
        'open_http2_protocol' => true,
        'open_websocket_protocol' => false,
        'max_request' => 100000,
        'socket_buffer_size' => 4 * 1024 * 1024,
        'buffer_output_size' => 4 * 1024 * 1024,
        'package_max_length' => 4 * 1024 * 1024,
        // 静态资源
        'enable_static_handler' => true,
        'document_root' => BASE_PATH . '/public',
        #'static_handler_locations' => ['/'],
    ],
    'callbacks' => [
        Event::ON_WORKER_START => [Hyperf\Framework\Bootstrap\WorkerStartCallback::class, 'onWorkerStart'],
        Event::ON_PIPE_MESSAGE => [Hyperf\Framework\Bootstrap\PipeMessageCallback::class, 'onPipeMessage'],
        Event::ON_WORKER_EXIT => [Hyperf\Framework\Bootstrap\WorkerExitCallback::class, 'onWorkerExit'],
    ],
];
