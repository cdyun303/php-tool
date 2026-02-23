<?php
/**
 * CurlException.php
 * @author cdyun(121625706@qq.com)
 * @date 2026/2/23 17:35
 */

declare (strict_types=1);

namespace Cdyun\PhpTool\Curl\Exception;

use RuntimeException;

class CurlException extends RuntimeException
{
    private int $statusCode;
    private int $errorCode;

    public function __construct(string $message = '', int $statusCode = 0, int $errorCode = 0, ?\Throwable $previous = null)
    {
        $this->statusCode = $statusCode;
        $this->errorCode = $errorCode;
        parent::__construct($message, $statusCode, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    public function isClientError(): bool
    {
        return $this->statusCode >= 400 && $this->statusCode < 500;
    }

    public function isServerError(): bool
    {
        return $this->statusCode >= 500;
    }
}