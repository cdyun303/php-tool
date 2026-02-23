<?php
/**
 * RoundBlockSizeMode.php
 * @author cdyun(121625706@qq.com)
 * @date 2026/2/23 18:33
 */

declare (strict_types=1);

namespace Cdyun\PhpTool\Qrcode;

/**
 * QR码圆角样式枚举
 */
enum RoundBlockSizeMode: string
{
    case MINUS = 'minus';
    case NOMINAL = 'nominal';
    case PLUS = 'plus';
    case MURKY = 'murky';
}
