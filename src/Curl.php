<?php
/**
 * Curl.php
 * @author cdyun(121625706@qq.com)
 * @date 2026/2/25 01:08
 */

declare (strict_types=1);

namespace Cdyun\PhpTool;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * HTTP请求工具类
 * 提供便捷的HTTP客户端方法，支持GET、POST、PUT、DELETE等请求
 */
class Curl
{
    /**
     * HTTP 客户端实例
     */
    private static ?Client $instance = null;

    /**
     * 默认配置选项
     */
    private static array $defaultOptions = [
        'timeout' => 30,
        'connect_timeout' => 10,
        'verify' => true,
    ];

    /**
     * 获取 HTTP 客户端实例
     * @param array $config 客户端配置
     * @return Client
     */
    private static function handler(array $config = []): Client
    {
        if (self::$instance === null) {
            $options = array_merge(self::$defaultOptions, $config);
            self::$instance = new Client($options);
        }
        return self::$instance;
    }
    /**
     * @param string $method - 请求方法 (GET, POST, PUT, DELETE 等)
     * @param string $url - 请求的 URL
     * @param array $options - 请求选项 (headers, body, query, json,form_params 等)
     * GET传参用query，POST传参用json，PUT传参用form_params
     * @return array 返回响应数据
     * @author cdyun(121625706@qq.com)
     * @desc HTTP 请求
     */
    public static function request(string $method, string $url, array $options = []): array
    {
        try {
            $response = self::handler()->request($method, $url, $options);
            if ($response->getStatusCode() != 200) {
                throw new \RuntimeException('cURL响应状态码错误：' . $response->getStatusCode());
            }
            return [
                'statusCode' => $response->getStatusCode(),
                'body' => $response->getBody()->getContents(),
                'headers' => $response->getHeaders(),
            ];
        } catch (GuzzleException $e) {
            throw new \RuntimeException('cURL请求失败: ' . $e->getMessage());
        }
    }


    /**
     * GET 请求
     * @param string $url 请求地址
     * @param array $query 查询参数
     * @param array $headers 请求头
     * @param array $options 其他选项
     * @return array 响应数据
     */
    public static function get(string $url, array $query = [], array $headers = [], array $options = []): array
    {
        $requestOptions = array_merge($options, [
            'query' => $query,
            'headers' => $headers,
        ]);

        return self::request('GET', $url, $requestOptions);
    }

    /**
     * POST 请求 - JSON格式
     * @param string $url 请求地址
     * @param array $data 请求数据
     * @param array $headers 请求头
     * @param array $options 其他选项
     * @return array 响应数据
     */
    public static function post(string $url, array $data = [], array $headers = [], array $options = []): array
    {
        $defaultHeaders = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $requestOptions = array_merge($options, [
            'json' => $data,
            'headers' => array_merge($defaultHeaders, $headers),
        ]);

        return self::request('POST', $url, $requestOptions);
    }

    /**
     * POST 请求 - 表单格式
     * @param string $url 请求地址
     * @param array $data 表单数据
     * @param array $headers 请求头
     * @param array $options 其他选项
     * @return array 响应数据
     */
    public static function postForm(string $url, array $data = [], array $headers = [], array $options = []): array
    {
        $defaultHeaders = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $requestOptions = array_merge($options, [
            'form_params' => $data,
            'headers' => array_merge($defaultHeaders, $headers),
        ]);

        return self::request('POST', $url, $requestOptions);
    }

    /**
     * POST 请求 - 文件上传
     * @param string $url 请求地址
     * @param array $multipart 多部分数据 [['name' => 'file', 'contents' => fopen('file.txt', 'r')]]
     * @param array $headers 请求头
     * @param array $options 其他选项
     * @return array 响应数据
     */
    public static function postMultipart(string $url, array $multipart = [], array $headers = [], array $options = []): array
    {
        $requestOptions = array_merge($options, [
            'multipart' => $multipart,
            'headers' => $headers,
        ]);

        return self::request('POST', $url, $requestOptions);
    }

    /**
     * PUT 请求
     * @param string $url 请求地址
     * @param array $data 请求数据
     * @param array $headers 请求头
     * @param array $options 其他选项
     * @return array 响应数据
     */
    public static function put(string $url, array $data = [], array $headers = [], array $options = []): array
    {
        $defaultHeaders = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $requestOptions = array_merge($options, [
            'json' => $data,
            'headers' => array_merge($defaultHeaders, $headers),
        ]);

        return self::request('PUT', $url, $requestOptions);
    }

    /**
     * PUT 请求 - 表单格式
     * @param string $url 请求地址
     * @param array $data 表单数据
     * @param array $headers 请求头
     * @param array $options 其他选项
     * @return array 响应数据
     */
    public static function putForm(string $url, array $data = [], array $headers = [], array $options = []): array
    {
        $defaultHeaders = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $requestOptions = array_merge($options, [
            'form_params' => $data,
            'headers' => array_merge($defaultHeaders, $headers),
        ]);

        return self::request('PUT', $url, $requestOptions);
    }

    /**
     * DELETE 请求
     * @param string $url 请求地址
     * @param array $query 查询参数
     * @param array $headers 请求头
     * @param array $options 其他选项
     * @return array 响应数据
     */
    public static function delete(string $url, array $query = [], array $headers = [], array $options = []): array
    {
        $requestOptions = array_merge($options, [
            'query' => $query,
            'headers' => $headers,
        ]);

        return self::request('DELETE', $url, $requestOptions);
    }

    /**
     * PATCH 请求
     * @param string $url 请求地址
     * @param array $data 请求数据
     * @param array $headers 请求头
     * @param array $options 其他选项
     * @return array 响应数据
     */
    public static function patch(string $url, array $data = [], array $headers = [], array $options = []): array
    {
        $defaultHeaders = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $requestOptions = array_merge($options, [
            'json' => $data,
            'headers' => array_merge($defaultHeaders, $headers),
        ]);

        return self::request('PATCH', $url, $requestOptions);
    }

    /**
     * HEAD 请求
     * @param string $url 请求地址
     * @param array $query 查询参数
     * @param array $headers 请求头
     * @param array $options 其他选项
     * @return array 响应数据（只返回状态码和头部信息）
     */
    public static function head(string $url, array $query = [], array $headers = [], array $options = []): array
    {
        $requestOptions = array_merge($options, [
            'query' => $query,
            'headers' => $headers,
        ]);

        return self::request('HEAD', $url, $requestOptions);
    }

    /**
     * OPTIONS 请求
     * @param string $url 请求地址
     * @param array $headers 请求头
     * @param array $options 其他选项
     * @return array 响应数据
     */
    public static function options(string $url, array $headers = [], array $options = []): array
    {
        $requestOptions = array_merge($options, [
            'headers' => $headers,
        ]);

        return self::request('OPTIONS', $url, $requestOptions);
    }

    /**
     * 设置默认配置
     * @param array $options 配置选项
     * @return void
     */
    public static function setDefaultOptions(array $options): void
    {
        self::$defaultOptions = array_merge(self::$defaultOptions, $options);
        // 重置实例以应用新配置
        self::$instance = null;
    }

    /**
     * 获取默认配置
     * @return array
     */
    public static function getDefaultOptions(): array
    {
        return self::$defaultOptions;
    }

    /**
     * 重置客户端实例
     * @return void
     */
    public static function reset(): void
    {
        self::$instance = null;
    }
}
