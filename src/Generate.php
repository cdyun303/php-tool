<?php
/**
 * Generate.php
 * @author cdyun(121625706@qq.com)
 * @date 2026/2/26 23:22
 */

declare (strict_types=1);

namespace Cdyun\PhpTool;

/**
 * 代码生成工具类
 */
class Generate
{
    /**
     * 生成UUID
     * @return string UUID
     */
    public static function uuid(): string
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            random_int(0, 0xffff), random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0x0fff) | 0x4000,
            random_int(0, 0x3fff) | 0x8000,
            random_int(0, 0xffff), random_int(0, 0xffff), random_int(0, 0xffff)
        );
    }

    /**
     * 生成订单号
     * @param string $prefix 前缀
     * @return string 订单号
     */
    public static function orderNo(string $prefix = ''): string
    {
        $date = \date('YmdHis');
        $random = \random_int(1000, 9999);
        return $prefix . $date . $random;
    }

    /**
     * 生成邀请码
     * @param int $length 邀请码长度
     * @param string $chars 可选字符集
     * @return string 邀请码
     */
    public static function inviteCode(int $length = 6, string $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'): string
    {
        $inviteCode = '';
        $charsLength = \strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $inviteCode .= $chars[\random_int(0, $charsLength - 1)];
        }
        return $inviteCode;
    }

    /**
     * 生成URL安全码
     * @param int $length 安全码长度
     * @return string URL安全码
     */
    public static function urlSafeCode(int $length = 16): string
    {
        $bytes = \random_bytes($length);
        return \rtrim(\strtr(\base64_encode($bytes), '+/', '-_'), '=');
    }

    /**
     * 生成注册码
     * @param int $length 注册码长度
     * @param int $segmentLength 分段长度
     * @param string $separator 分隔符
     * @return string 注册码
     */
    public static function registerCode(int $length = 16, int $segmentLength = 4, string $separator = '-'): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $registrationCode = '';
        $charsLength = \strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $registrationCode .= $chars[\random_int(0, $charsLength - 1)];
            if (($i + 1) % $segmentLength === 0 && $i !== $length - 1) {
                $registrationCode .= $separator;
            }
        }
        return $registrationCode;
    }
}