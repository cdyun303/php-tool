<?php
/**
 * LogoPosition.php
 * @author cdyun(121625706@qq.com)
 * @date 2026/2/23 18:33
 */

declare (strict_types=1);

namespace Cdyun\PhpTool\Qrcode;

/**
 * QR码Logo位置枚举
 */
enum LogoPosition: string
{
    case CENTER = 'center';
    case TOP = 'top';
    case BOTTOM = 'bottom';
}
