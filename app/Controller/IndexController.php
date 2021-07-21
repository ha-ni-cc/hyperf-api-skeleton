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

namespace App\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

/**
 * Class IndexController
 * @package AppConfig\Controller
 * @Controller ()
 */
class IndexController extends AbstractController
{
    /**
     * @RequestMapping(path="/",methods="get,post")
     * @return int
     */
    public function index()
    {
        return 200;
    }
}
