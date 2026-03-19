<?php
/**
 * Dir.php
 * @author cdyun(121625706@qq.com)
 * @date 2026/3/20 02:53
 */

declare (strict_types=1);

namespace Cdyun\PhpTool;

/**
 * 文件目录处理类
 */
class Dir
{

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

}