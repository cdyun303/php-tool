<?php
/**
 * ClientException.php
 * @author cdyun(121625706@qq.com)
 * @date 2026/2/23 17:36
 */

declare (strict_types=1);

namespace Cdyun\PhpTool\Curl\Exception;

class ClientException extends CurlException
{
    public function __construct(string $message = '', int $statusCode = 400, int $errorCode = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $statusCode, $errorCode, $previous);
    }
}