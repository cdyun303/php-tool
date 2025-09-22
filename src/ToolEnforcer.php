<?php
/**
 * @desc ToolEnforcer.php
 * @author cdyun(121625706@qq.com)
 * @date 2025/9/22 20:44
 */
declare(strict_types=1);

namespace Cdyun\PhpTool;

class ToolEnforcer
{
    /**
     * @param int $length
     * @return string
     * @author cdyun(121625706@qq.com)
     * @desc 生成验证码
     */
    public static function generateCaptcha(int $length = 6): string
    {
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= rand(0, 9);
        }
        return $code;
    }

    /**
     * @param string $idCard
     * @return string
     * @author cdyun(121625706@qq.com)
     * @desc 身份证号码脱敏
     */
    public static function idCardDesensitize(string $idCard): string
    {
        // 检查是否为空
        if (empty($idCard)) {
            return '';
        }
        // 保留前6位和后4位，中间用****代替
        return substr($idCard, 0, 6) . '********' . substr($idCard, -4);
    }

    /**
     * @param string $phone
     * @return string
     * @author cdyun(121625706@qq.com)
     * @desc 手机号脱敏
     */
    public static function phoneDesensitize(string $phone): string
    {
        // 检查是否为空
        if (empty($phone)) {
            return '';
        }
        return substr($phone, 0, 3) . '****' . substr($phone, -4);
    }

    /**
     * @param $url
     * @return bool
     * @author cdyun(121625706@qq.com)
     * @desc 验证URL格式
     */
    public static function isValidUrl($url): bool
    {
        if (!is_string($url)) return false;

        $pattern = '/^(https?|ftp):\/\/' // 协议
            . '(?:(?:[A-Z0-9][A-Z0-9-]{0,61}[A-Z0-9]\.)+[A-Z]{2,6}' // 域名
            . '|localhost|' // 或localhost
            . '\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})' // 或IP
            . '(?::\d+)?' // 端口
            . '(?:[\/?#][^\s]*)?' // 路径/查询/锚点
            . '$/i';

        return (bool)preg_match($pattern, $url);
    }

    /**
     * @param array $array - 待签名数组
     * @param string $pem - 签名密钥
     * @param string $direction - 排序方向，可选asc（升序）或desc（降序）
     * @return string
     * @author cdyun(121625706@qq.com)
     * @desc 对数组按照键名排序后生成签名
     */
    public static function signObjectWithPem(array $array, string $pem, string $direction = 'asc'): string
    {
        if (empty($array)) {
            return '';
        }

        $sortedArray = self::sortArrayByKey($array, $direction);

        $queryString = '';
        foreach ($sortedArray as $k => $v) {
            $queryString .= $k . '=' . $v . '&';
        }
        $queryString = rtrim($queryString, '&');

        return sha1($queryString . $pem);
    }

    /**
     * @param array $array - 数组
     * @param string $direction - 排序方向，可选asc（升序）或desc（降序）
     * @return array
     * @author cdyun(121625706@qq.com)
     * @desc 按键名对数组进行排序
     */
    public static function sortArrayByKey(array $array, string $direction = 'asc'): array
    {
        if (empty($array)) {
            return [];
        }
        if ($direction === 'desc') {
            krsort($array, SORT_REGULAR);
        } else {
            ksort($array, SORT_REGULAR);
        }

        return $array;
    }

    /**
     * @param array $list - 数据列表
     * @param int $rootId - 根节点ID，默认为0
     * @param string $pidField - 父级字段名，默认为'pid'
     * @param string $idField - 主键字段名，默认为'id'
     * @param string $childrenField - 子节点字段名，默认为'children'
     * @return array
     * @author cdyun(121625706@qq.com)
     * @desc 数组转树形结构
     */
    public static function arrayToTree(array $list, int $rootId = 0, string $pidField = 'pid', string $idField = 'id', string $childrenField = 'children'): array
    {
        if (empty($list)) {
            return [];
        }

        // 构建映射表
        $map = [];
        foreach ($list as $key => $item) {
            $map[$item[$idField]] = $item;
        }

        $tree = [];

        foreach ($list as $key => $item) {
            // 如果当前节点的父节点是根节点
            if ($item[$pidField] == $rootId) {
                $tree[] = &$map[$item[$idField]];
            } // 如果当前节点有父节点且父节点存在
            elseif (isset($map[$item[$pidField]])) {
                // 初始化父节点的children字段
                if (!isset($map[$item[$pidField]][$childrenField])) {
                    $map[$item[$pidField]][$childrenField] = [];
                }
                $map[$item[$pidField]][$childrenField][] = &$map[$item[$idField]];
            }
        }

        unset($map);
        return $tree;
    }

    /**
     * @param array $list
     * @return array
     * @author cdyun(121625706@qq.com)
     * @desc 菜单转Vben格式
     */
    public static function menuToVben(array $list): array
    {
        if (empty($list)) {
            return [];
        }

        // 字段映射配置：['字段名' => 是否放入 meta]
        $baseFields = [
            'id' => false,
            'pid' => false,
            'type' => false,
            'name' => false,
            'path' => false,
            'status' => false,
            'active_path' => false,
            'component' => false,
            'link' => false,
            'auth_code' => false,
            'title' => true,
            'order' => true,
            'icon' => true,
            'active_icon' => true,
            'badge_type' => true,
            'badge' => true,
            'badge_variants' => true,
            'keep_alive' => true,
            'affix_tab' => true,
            'hide_in_menu' => true,
            'hide_children_in_menu' => true,
            'hide_in_breadcrumb' => true,
            'hide_in_tab' => true,
        ];

        // 布尔字段列表
        $booleanFields = [
            'keep_alive',
            'affix_tab',
            'hide_in_menu',
            'hide_children_in_menu',
            'hide_in_breadcrumb',
            'hide_in_tab',
        ];

        $menu = [];

        foreach ($list as $key => $item) {
            if (!is_array($item)) {
                continue;
            }

            $menuItem = [
                'meta' => [],
            ];

            foreach ($item as $field => $value) {
                if (!isset($baseFields[$field])) {
                    continue; // 忽略未定义字段
                }

                // 布尔字段处理
                if (in_array($field, $booleanFields, true)) {
                    $value = ($value === 1 || $value === "1" || $value === true);
                }

                if (isset($item[$field])) { // 忽略值不存在的字段
                    if ($baseFields[$field]) {
                        $menuItem['meta'][$field] = $value;
                    } else {
                        $menuItem[$field] = $value;
                    }
                }
            }
            $menu[$key] = $menuItem;
        }
        return $menu;
    }

    /**
     * @param array|string $data - 待转换的数据，可以是数组或字符串
     * @return array|string
     * @author cdyun(121625706@qq.com)
     * @desc 下划线命名转驼峰命名
     */
    public static function snakeToCamel(array|string $data): array|string
    {
        // 如果是字符串，直接处理
        if (is_string($data)) {
            return preg_replace_callback('/_([a-z])/', function ($matches) {
                return strtoupper($matches[1]);
            }, $data);
        }

        // 如果是数组，递归处理
        $result = [];
        foreach ($data as $key => $value) {
            // 将下划线分隔的字段名转换为驼峰命名
            $camelKey = preg_replace_callback('/_([a-z])/', function ($matches) {
                return strtoupper($matches[1]);
            }, $key);

            // 如果值是数组，递归处理
            if (is_array($value)) {
                $result[$camelKey] = self::snakeToCamel($value);
            } else {
                $result[$camelKey] = $value;
            }
        }
        return $result;
    }

    /**
     * @param array|string $data - 待转换的数据，可以是数组或字符串
     * @return array|string
     * @author cdyun(121625706@qq.com)
     * @desc 驼峰命名转下划线命名
     */
    public static function camelToSnake(array|string $data): array|string
    {
        // 如果是字符串，直接处理
        if (is_string($data)) {
            return strtolower(preg_replace('/([A-Z])/', '_$1', lcfirst($data)));
        }

        // 如果是数组，递归处理
        $result = [];
        foreach ($data as $key => $value) {
            // 将驼峰命名的字段名转换为下划线分隔的字段名
            $snakeKey = strtolower(preg_replace('/([A-Z])/', '_$1', lcfirst($key)));

            // 如果值是数组，递归处理
            if (is_array($value)) {
                $result[$snakeKey] = self::camelToSnake($value);
            } else {
                $result[$snakeKey] = $value;
            }
        }
        return $result;
    }

}