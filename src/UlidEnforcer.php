<?php
/**
 * @desc UlidEnforcer.php
 * @author cdyun(121625706@qq.com)
 * @date 2025/9/22 20:38
 */
declare(strict_types=1);

namespace Cdyun\PhpTool;

use Symfony\Component\Uid\Ulid;

class UlidEnforcer
{
    /**
     * @return Ulid
     * @author cdyun(121625706@qq.com)
     * @desc 生成ulid
     */
    public static function generate(): Ulid
    {
        return new Ulid();
    }

    /**
     * @param string $id
     * @return int
     * @author cdyun(121625706@qq.com)
     * @desc Ulid 转 时间戳
     */
    public static function toTimestamp(string $id): int
    {
        $Ulid = Ulid::isValid($id);
        if (!$Ulid) {
            return 0;
        }
        return Ulid::fromString($id)->getDateTime()->getTimestamp();
    }

    /**
     * @param string $id
     * @param string $format
     * @return string
     * @author cdyun(121625706@qq.com)
     * @desc Ulid 转 时间日期
     */
    public static function toDate(string $id, string $format = 'Y-m-d H:i:s'): string
    {
        $timestamp = self::toTimestamp($id);
        return date($format, $timestamp);
    }
}