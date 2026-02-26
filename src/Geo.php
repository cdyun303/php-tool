<?php
/**
 * Geo.php
 * @author cdyun(121625706@qq.com)
 * @date 2026/2/25 00:56
 */

declare (strict_types=1);

namespace Cdyun\PhpTool;

/**
 * 地理位置工具类
 */
class Geo
{
    // WGS84椭球体参数（更精确）
    private const WGS84_A_KM = 6378.137;           // 长半轴（公里）
    private const WGS84_A_MI = 3963.191;           // 长半轴（英里）
    private const WGS84_A = 6378137.0;           // 长半轴（米）
    private const WGS84_B = 6356752.3142;        // 短半轴（米）
    private const WGS84_F = 1 / 298.257223563;     // 扁率
    private const WGS84_EE = 0.00669437999014;   // 第一偏心率平方

    // 中国地图参数（GCJ-02）
    private const GCJ_A = 6378245.0;             // 长半轴
    private const GCJ_EE = 0.00669342162296594323; // 偏心率平方

    // 转换常量
    private const X_PI = 3.14159265358979324 * 3000.0 / 180.0;
    private const PI = 3.1415926535897932384626;

    /**
     * 使用Haversine公式计算两个坐标之间的距离
     * @param float $lat1 第一个点的纬度
     * @param float $lon1 第一个点的经度
     * @param float $lat2 第二个点的纬度
     * @param float $lon2 第二个点的经度
     * @param string $unit 单位（km:公里, mi:英里, m:米）
     * @return float 两点之间的距离
     */
    public static function distance(float $lat1, float $lon1, float $lat2, float $lon2, string $unit = 'km'): float
    {
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return match ($unit) {
            'mi' => $c * self::WGS84_A_MI,
            'm' => $c * self::WGS84_A,
            default => $c * self::WGS84_A_KM
        };
    }

    /**
     * 将角度转换为弧度
     * @param float $degrees 角度值
     * @return float 弧度值
     */
    public static function toRadians(float $degrees): float
    {
        return deg2rad($degrees);
    }

    /**
     * 将弧度转换为角度
     * @param float $radians 弧度值
     * @return float 角度值
     */
    public static function toDegrees(float $radians): float
    {
        return rad2deg($radians);
    }

    /**
     * 验证坐标是否有效
     * @param float $lat 纬度
     * @param float $lon 经度
     * @return bool 如果坐标有效则返回true
     */
    public static function isValid(float $lat, float $lon): bool
    {
        return $lat >= -90 && $lat <= 90 && $lon >= -180 && $lon <= 180;
    }

    /**
     * 计算两个坐标之间的中点
     * @param float $lat1 第一个点的纬度
     * @param float $lon1 第一个点的经度
     * @param float $lat2 第二个点的纬度
     * @param float $lon2 第二个点的经度
     * @return array 中点坐标 [纬度, 经度]
     */
    public static function midpoint(float $lat1, float $lon1, float $lat2, float $lon2): array
    {
        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);

        $bx = cos($lat2Rad) * cos($lon2Rad - $lon1Rad);
        $by = cos($lat2Rad) * sin($lon2Rad - $lon1Rad);

        $lat3Rad = atan2(sin($lat1Rad) + sin($lat2Rad), sqrt((cos($lat1Rad) + $bx) * (cos($lat1Rad) + $bx) + $by * $by));
        $lon3Rad = $lon1Rad + atan2($by, cos($lat1Rad) + $bx);

        return [rad2deg($lat3Rad), rad2deg($lon3Rad)];
    }

    /**
     * 计算两个坐标之间的方位角
     * @param float $lat1 第一个点的纬度
     * @param float $lon1 第一个点的经度
     * @param float $lat2 第二个点的纬度
     * @param float $lon2 第二个点的经度
     * @return float 方位角（0-360度）
     */
    public static function bearing(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        // 输入合法性校验
        if ($lat1 < -90 || $lat1 > 90 || $lat2 < -90 || $lat2 > 90) {
            throw new InvalidArgumentException("纬度必须在 [-90, 90] 范围内");
        }
        if ($lon1 < -180 || $lon1 > 180 || $lon2 < -180 || $lon2 > 180) {
            throw new InvalidArgumentException("经度必须在 [-180, 180] 范围内");
        }

        // 角度转弧度并缓存中间变量
        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);

        // 经度差值
        $dLon = $lon2Rad - $lon1Rad;

        // 计算 y 和 x 分量
        $y = sin($dLon) * cos($lat2Rad);
        $x = cos($lat1Rad) * sin($lat2Rad) - sin($lat1Rad) * cos($lat2Rad) * cos($dLon);

        // 特殊情况处理：两点重合或极点附近
        if (abs($x) < 1e-10 && abs($y) < 1e-10) {
            return 0.0; // 方位角无意义，默认返回 0
        }

        // 计算方位角（弧度）
        $bearingRad = atan2($y, $x);

        // 弧度转角度并规范化到 [0, 360)
        $bearingDeg = rad2deg($bearingRad);
        $bearingDeg = fmod($bearingDeg + 360, 360);

        return $bearingDeg;
    }


    /**
     * 将十进制度数转换为度分秒（DMS）
     * @param float $decimal 十进制度数
     * @param bool $isLatitude 是否为纬度
     * @return array DMS组件 [度, 分, 秒, 方向]
     */
    public static function toDMS(float $decimal, bool $isLatitude): array
    {
        $direction = match (true) {
            $isLatitude && $decimal >= 0 => 'N',
            $isLatitude && $decimal < 0 => 'S',
            !$isLatitude && $decimal >= 0 => 'E',
            default => 'W'
        };

        $absDecimal = abs($decimal);
        $degrees = (int)$absDecimal;
        $minutes = ($absDecimal - $degrees) * 60;
        $seconds = ($minutes - (int)$minutes) * 60;

        return [$degrees, (int)$minutes, round($seconds, 4), $direction];
    }

    /**
     * 将度分秒（DMS）转换为十进制度数
     * @param int $degrees 度
     * @param int $minutes 分
     * @param float $seconds 秒
     * @param string $direction 方向（N, S, E, W）
     * @return float 十进制度数
     */
    public static function toDecimal(int $degrees, int $minutes, float $seconds, string $direction): float
    {
        $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);

        return in_array(strtoupper($direction), ['S', 'W']) ? -$decimal : $decimal;
    }

    /**
     * GCJ02坐标转BD09坐标
     * @param float $lat 纬度
     * @param float $lng 经度
     * @return array [bd09纬度, bd09经度]
     */
    public static function gcj02ToBd09(float $lat, float $lng): array
    {
        $z = sqrt($lng * $lng + $lat * $lat) + 0.00002 * sin($lat * self::X_PI);
        $theta = atan2($lat, $lng) + 0.000003 * cos($lng * self::X_PI);
        $bd_lng = $z * cos($theta) + 0.0065;
        $bd_lat = $z * sin($theta) + 0.006;
        return [$bd_lat, $bd_lng];
    }

    /**
     * BD09坐标转GCJ02坐标
     * @param float $lat 纬度
     * @param float $lng 经度
     * @return array [gcj02纬度, gcj02经度 ]
     */
    public static function bd09ToGcj02(float $lat, float $lng): array
    {
        $x = $lng - 0.0065;
        $y = $lat - 0.006;
        $z = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * self::X_PI);
        $theta = atan2($y, $x) - 0.000003 * cos($x * self::X_PI);
        $gg_lng = $z * cos($theta);
        $gg_lat = $z * sin($theta);
        return [$gg_lat, $gg_lng];
    }

    /**
     * WGS84坐标转GCJ02坐标（中国火星坐标系）
     * @param float $lat 纬度
     * @param float $lng 经度
     * @return array [gcj02纬度, gcj02经度]
     */
    public static function wgs84ToGcj02(float $lat, float $lng): array
    {
        if (self::outOfChina($lat, $lng)) {
            return [$lat, $lng];
        }

        $dlat = self::transformLat($lat - 35.0, $lng - 105.0);
        $dlng = self::transformLng($lat - 35.0, $lng - 105.0);
        $radlat = $lat / 180.0 * self::PI;
        $magic = sin($radlat);
        $magic = 1 - self::GCJ_EE * $magic * $magic;
        $sqrtmagic = sqrt($magic);
        $dlat = ($dlat * 180.0) / ((self::GCJ_A * (1 - self::GCJ_EE)) / ($magic * $sqrtmagic) * self::PI);
        $dlng = ($dlng * 180.0) / (self::GCJ_A / $sqrtmagic * cos($radlat) * self::PI);
        $mglat = $lat + $dlat;
        $mglng = $lng + $dlng;
        return [$mglat, $mglng];
    }

    /**
     * GCJ02坐标转WGS84坐标
     * @param float $lat 纬度
     * @param float $lng 经度
     * @return array [wgs84纬度, wgs84经度]
     */
    public static function gcj02ToWgs84(float $lat, float $lng): array
    {
        if (self::outOfChina($lat, $lng)) {
            return [$lat, $lng];
        }

        $dlat = self::transformLat($lat - 35.0, $lng - 105.0);
        $dlng = self::transformLng($lat - 35.0, $lng - 105.0);
        $radlat = $lat / 180.0 * self::PI;
        $magic = sin($radlat);
        $magic = 1 - self::GCJ_EE * $magic * $magic;
        $sqrtmagic = sqrt($magic);
        $dlat = ($dlat * 180.0) / ((self::GCJ_A * (1 - self::GCJ_EE)) / ($magic * $sqrtmagic) * self::PI);
        $dlng = ($dlng * 180.0) / (self::GCJ_A / $sqrtmagic * cos($radlat) * self::PI);
        $mglat = $lat - $dlat;
        $mglng = $lng - $dlng;
        return [$mglat, $mglng];
    }

    /**
     * WGS84坐标转BD09坐标
     * @param float $lat 纬度
     * @param float $lng 经度
     * @return array [bd09纬度, bd09经度]
     */
    public static function wgs84ToBd09(float $lat, float $lng): array
    {
        $gcj = self::wgs84ToGcj02($lat, $lng);
        return self::gcj02ToBd09($gcj[0], $gcj[1]);
    }

    /**
     * BD09坐标转WGS84坐标
     * @param float $lat 纬度
     * @param float $lng 经度
     * @return array [wgs84纬度, wgs84经度]
     */
    public static function bd09ToWgs84(float $lat, float $lng): array
    {
        $gcj = self::bd09ToGcj02($lat, $lng);
        return self::gcj02ToWgs84($gcj[0], $gcj[1]);
    }

    /**
     * 判断是否在中国范围内
     * @param float $lat 纬度
     * @param float $lng 经度
     * @return bool
     */
    private static function outOfChina(float $lat, float $lng): bool
    {
        return ($lng < 72.004 || $lng > 137.8347) || ($lat < 0.8293 || $lat > 55.8271);
    }

    /**
     * 转换纬度
     * @param float $lat
     * @param float $lng
     * @return float
     */
    private static function transformLat(float $lat, float $lng): float
    {
        $ret = -100.0 + 2.0 * $lng + 3.0 * $lat + 0.2 * $lat * $lat + 0.1 * $lng * $lat + 0.2 * sqrt(abs($lng));
        $ret += (20.0 * sin(6.0 * $lng * self::PI) + 20.0 * sin(2.0 * $lng * self::PI)) * 2.0 / 3.0;
        $ret += (20.0 * sin($lat * self::PI) + 40.0 * sin($lat / 3.0 * self::PI)) * 2.0 / 3.0;
        $ret += (160.0 * sin($lat / 12.0 * self::PI) + 320 * sin($lat * self::PI / 30.0)) * 2.0 / 3.0;
        return $ret;
    }

    /**
     * 转换经度
     * @param float $lat
     * @param float $lng
     * @return float
     */
    private static function transformLng(float $lat, float $lng): float
    {
        $ret = 300.0 + $lng + 2.0 * $lat + 0.1 * $lng * $lng + 0.1 * $lng * $lat + 0.1 * sqrt(abs($lng));
        $ret += (20.0 * sin(6.0 * $lng * self::PI) + 20.0 * sin(2.0 * $lng * self::PI)) * 2.0 / 3.0;
        $ret += (20.0 * sin($lng * self::PI) + 40.0 * sin($lng / 3.0 * self::PI)) * 2.0 / 3.0;
        $ret += (150.0 * sin($lng / 12.0 * self::PI) + 300.0 * sin($lng / 30.0 * self::PI)) * 2.0 / 3.0;
        return $ret;
    }
}