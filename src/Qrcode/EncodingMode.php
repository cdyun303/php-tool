<?php
/**
 * EncodingMode.php
 * @author cdyun(121625706@qq.com)
 * @date 2026/2/23 18:32
 */

declare (strict_types=1);

namespace Cdyun\PhpTool\Qrcode;

/**
 * QR码编码模式枚举
 */
enum EncodingMode: string
{
    case AUTO = 'auto';
    case NUMERIC = 'numeric';
    case ALPHANUMERIC = 'alphanumeric';
    case BYTE = 'byte';
    case KANJI = 'kanji';
}
