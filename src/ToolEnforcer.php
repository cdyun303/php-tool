<?php
/**
 * ToolEnforcer.php
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
     * 生成验证码
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
     * 身份证号码脱敏
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
     * 手机号脱敏
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
     * 验证URL格式
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
     * 对数组按照键名排序后生成签名
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
     * 按键名对数组进行排序
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
     * 按指定字段名对数组进行排序
     * @param array $array
     * @param string $field
     * @param string $direction
     * @return array
     * @author cdyun(121625706@qq.com)
     */
    public static function sortArrayByField(array $array, string $field = 'sort', string $direction = 'asc'): array
    {
        usort($array, function ($a, $b) use ($field, $direction) {
            $result = $a[$field] <=> $b[$field];
            return ($direction === 'desc') ? -$result : $result;
        });

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
     * 数组转树形结构
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
     * 菜单转Vben格式
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
     * 下划线命名转驼峰命名
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
            }, (string)$key);

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
     * 驼峰命名转下划线命名
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
            // 确保键名是字符串后再进行转换
            $stringKey = (string)$key;
            // 将驼峰命名的字段名转换为下划线分隔的字段名
            $snakeKey = strtolower(preg_replace('/([A-Z])/', '_$1', lcfirst($stringKey)));

            // 如果值是数组，递归处理
            if (is_array($value)) {
                $result[$snakeKey] = self::camelToSnake($value);
            } else {
                // 确保传递给 preg_replace_callback 的是字符串
                $result[$snakeKey] = $value;
            }
        }
        return $result;
    }

    /**
     * 清除指定文件夹下文件
     * @param $dir_name
     * @return bool
     * @author cdyun(121625706@qq.com)
     */
    public static function deleteDirFile($dir_name): bool
    {
        $result = false;
        if (is_dir($dir_name)) {
            if ($handle = opendir($dir_name)) {
                while (false !== ($item = readdir($handle))) {
                    if ($item != '.' && $item != '..') {
                        if (is_dir($dir_name . DIRECTORY_SEPARATOR . $item)) {
                            self::deleteDirFile($dir_name . DIRECTORY_SEPARATOR . $item);
                        } else {
                            unlink($dir_name . DIRECTORY_SEPARATOR . $item);
                        }
                    }
                }
                closedir($handle);
                if (rmdir($dir_name)) {
                    $result = true;
                }
            }
        }
        return $result;
    }

    /**
     * 搜索文件夹下全部文件，指定扩展名，暂时不支持中文文件名
     * @param string $path
     * @param array $ext
     * @return array
     * @author cdyun(121625706@qq.com)
     */
    public static function scanFile(string $path, array $ext = ['html']): array
    {
        if (!is_dir($path))
            return array();
        // 兼容各操作系统
        $path = rtrim(str_replace('\\', '/', $path), '/') . '/';
        $result = array();
        $files = scandir($path);
        foreach ($files as $vo) {
            if ($vo != '.' && $vo != '..') {
                $vo = iconv("GBK  ", "utf-8", $vo);
                if (is_dir($path . '/' . $vo)) {
                    $result = array_merge($result, self::scanFile($path . '/' . $vo, $ext));
                } else {
                    if (in_array(pathinfo($vo, PATHINFO_EXTENSION), $ext)) {
                        $result[] = basename($vo);
                    }
                }
            }
        }
        return $result;
    }

    /**
     * 搜索文件夹下全部文件返回树形结构，指定扩展名，暂时不支持中文文件名
     * @param string $path - 搜索绝对路径
     * @param string $prefix - 定义前缀路径
     * @param array $ext - 扩展名
     * @return array
     * @author cdyun(121625706@qq.com)
     */
    public static function scanFileTree(string $path, string $prefix = '', array $ext = ['html']): array
    {
        if (!is_dir($path))
            return [];
        // 兼容各操作系统
        $path = rtrim(str_replace('\\', '/', $path), '/');
        $result = [];
        $files = scandir($path);
        foreach ($files as $vo) {
            if ($vo != '.' && $vo != '..') {
                $vo = iconv("GBK  ", "utf-8", $vo);
                $value = $prefix ? $prefix . '/' . basename($vo) : basename($vo);
                if (is_dir($path . '/' . $vo)) {
                    $t = [
                        'name' => basename($vo),
                        'value' => $value,
                        'children' => self::scanFileTree($path . '/' . $vo, $value, $ext)
                    ];
                    $result[] = $t;
                } else {
                    if (in_array(pathinfo($vo, PATHINFO_EXTENSION), $ext)) {
                        $t = [
                            'name' => basename($vo),
                            'value' => $value,
                        ];
                        $result[] = $t;
                    }
                }
            }
        }
        return $result;
    }

    /**
     * 获取操作系统
     * @param string $user_agent
     * @return string
     * @author cdyun(121625706@qq.com)
     */
    public static function os(string $user_agent): string
    {
        if (empty($user_agent)) {
            return 'Unknown';
        }

        $osPatterns = [
            '/windows|winnt|win32|win64/i' => 'Windows',
            '/macintosh|mac os/i' => 'Mac',
            '/linux/i' => 'Linux'
        ];

        foreach ($osPatterns as $pattern => $osName) {
            if (preg_match($pattern, $user_agent)) {
                return $osName;
            }
        }

        return 'Other';
    }

    /**
     * 根据用户代理字符串识别浏览器类型
     *
     * @param string $user_agent 用户代理字符串
     * @return string 浏览器名称(MSIE/Firefox/Chrome/Safari/Opera/Other/Unknown)
     */
    public static function browse(string $user_agent): string
    {
        if (empty($user_agent)) {
            return 'Unknown';
        }

        // 通过正则表达式匹配不同的浏览器标识
        if (preg_match('/MSIE/i', $user_agent)) {
            $br = 'MSIE';
        } elseif (preg_match('/Firefox/i', $user_agent)) {
            $br = 'Firefox';
        } elseif (preg_match('/Chrome/i', $user_agent)) {
            $br = 'Chrome';
        } elseif (preg_match('/Safari/i', $user_agent)) {
            $br = 'Safari';
        } elseif (preg_match('/Opera/i', $user_agent)) {
            $br = 'Opera';
        } else {
            $br = 'Other';
        }
        return $br;
    }

    /**
     * 获取指定路径文件夹下所有直系文件夹中所有指定文件名的文件内容
     * @param $path - 文件路径
     * @param $fileName - 文件名，不含扩展名
     * @return array
     * @author cdyun(121625706@qq.com)
     */
    public static function listFileContent($path, $fileName): array
    {
        $result = [];
        if (empty($path) || empty($fileName)) {
            return $result;
        }
        $folders = self::scanFolder($path);
        foreach ($folders as $item) {
            // 防止路径遍历攻击，过滤特殊字符
            if (str_contains($item, '..') || str_contains($item, "\0")) {
                continue;
            }
            $fullPath = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . ltrim($item, DIRECTORY_SEPARATOR);
            $data = self::getFileContent($fullPath, $fileName);

            if (!empty($data)) {
                $result[$item] = $data;
            }

        }
        return $result;
    }

    /**
     * 搜索指定路径下的【直系】文件夹
     * @param string $path
     * @return array
     * @author cdyun(121625706@qq.com)
     */
    public static function scanFolder(string $path): array
    {
        if (!is_dir($path)) return [];
        // 兼容各操作系统
        $path = rtrim(str_replace('\\', '/', $path), '/') . '/';
        $result = [];
        $files = scandir($path);
        foreach ($files as $vo) {
            if ($vo != '.' && $vo != '..' && is_dir($path . '/' . $vo)) {
                $result[] = $vo;
            }
        }
        return $result;
    }

    /**
     * 获取文件内容
     * @param $path - 文件路径
     * @param $fileName - 文件名，不含扩展名
     * @return array|mixed
     * @author cdyun(121625706@qq.com)
     */
    public static function getFileContent($path, $fileName): mixed
    {
        // 验证输入参数
        if (empty($path) || empty($fileName)) {
            return [];
        }

        // 规范化文件名，防止路径遍历攻击
        $safeFileName = basename($fileName);
        $filePath = rtrim($path, '/\\') . DIRECTORY_SEPARATOR . $safeFileName . '.php';

        // 检查文件是否存在且为常规文件
        if (!file_exists($filePath) || !is_file($filePath)) {
            return [];
        }
        return include $filePath;
    }

}