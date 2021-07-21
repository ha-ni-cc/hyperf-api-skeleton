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

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 * @method string getMessage(int $code)
 */
class ErrorCode extends AbstractConstants
{

    /**
     * 操作失败
     * @Message("操作失败")
     */
    const OPERATION_FAILED = -200;

    /**
     * 系统错误
     * @Message("系统错误")
     */
    const SERVER_ERROR = 500;

}
