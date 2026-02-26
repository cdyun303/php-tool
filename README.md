PHP8.1+ 通用工具包
=====

<!-- TOC -->
* [PHP8.1+ 通用工具包](#php81-通用工具包)
* [简介](#简介)
* [安装](#安装)
* [模块化目录](#模块化目录)
  * [数组处理模块](#数组处理模块)
    * [特性](#特性)
    * [核心方法](#核心方法)
    * [兼容性说明](#兼容性说明)
    * [使用示例](#使用示例)
      * [树形结构转换](#树形结构转换)
        * [tree() / toTree() - 数组转树形结构](#tree--totree---数组转树形结构)
        * [list() - 树形结构转数组](#list---树形结构转数组)
        * [level() - 数组转层级结构](#level---数组转层级结构)
        * [path() - 数组转路径结构](#path---数组转路径结构)
      * [数组访问和操作](#数组访问和操作)
        * [deepMerge() - 数组深度合并](#deepmerge---数组深度合并)
        * [get() - 数组获取值（支持点语法）](#get---数组获取值支持点语法)
        * [set() - 数组设置值](#set---数组设置值)
        * [has() - 数组判断是否存在键](#has---数组判断是否存在键)
        * [only() - 数组仅保留指定键](#only---数组仅保留指定键)
        * [except() - 数组排除指定键](#except---数组排除指定键)
      * [多维数组处理](#多维数组处理)
        * [group() - 多维数组分组](#group---多维数组分组)
        * [count() - 多维数组统计](#count---多维数组统计)
        * [sum() - 多维数组求和](#sum---多维数组求和)
        * [avg() - 多维数组求平均值](#avg---多维数组求平均值)
        * [max() - 多维数组求最大值](#max---多维数组求最大值)
        * [min() - 多维数组求最小值](#min---多维数组求最小值)
      * [PHP 8.4+数组函数](#php-84数组函数)
        * [first() - 数组首元素](#first---数组首元素)
        * [last() - 数组尾元素](#last---数组尾元素)
        * [find() - 查找满足条件的元素](#find---查找满足条件的元素)
        * [findKey() - 查找满足条件的键名](#findkey---查找满足条件的键名)
        * [any() - 检查是否存在满足条件的元素](#any---检查是否存在满足条件的元素)
        * [all() - 检查是否所有元素都满足条件](#all---检查是否所有元素都满足条件)
      * [数组查找和判断](#数组查找和判断)
        * [map() - 数组映射](#map---数组映射)
        * [filter() - 数组过滤](#filter---数组过滤)
        * [reduce() - 数组归约](#reduce---数组归约)
        * [find() - 查找满足条件的第一个元素的键值](#find---查找满足条件的第一个元素的键值)
        * [findKey() - 查找满足条件的第一个元素的键名](#findkey---查找满足条件的第一个元素的键名)
        * [some() - 检查是否存在满足条件的元素（别名方法）](#some---检查是否存在满足条件的元素别名方法)
        * [every() - 检查是否所有元素都满足条件（别名方法）](#every---检查是否所有元素都满足条件别名方法)
        * [contains() - 数组是否包含指定元素](#contains---数组是否包含指定元素)
        * [containsKey() - 数组是否包含指定键名](#containskey---数组是否包含指定键名)
        * [isEmpty() - 数组是否为空](#isempty---数组是否为空)
        * [isAssoc() - 数组是否为关联数组](#isassoc---数组是否为关联数组)
        * [isIndexed() - 数组是否为索引数组](#isindexed---数组是否为索引数组)
      * [数组排序](#数组排序)
        * [sort() - 升序/降序](#sort---升序降序)
        * [multiSort() - 多维数组排序](#multisort---多维数组排序)
        * [reverse() - 数组反转](#reverse---数组反转)
        * [shuffle() - 数组打乱](#shuffle---数组打乱)
      * [数组去重](#数组去重)
        * [unique() - 数组去重](#unique---数组去重)
        * [multiUnique() - 多维数组去重](#multiunique---多维数组去重)
      * [数组分页和切片](#数组分页和切片)
        * [paginate() - 数组分页](#paginate---数组分页)
        * [slice() - 数组切片](#slice---数组切片)
        * [chunk() - 数组分割](#chunk---数组分割)
      * [数组合并和差集](#数组合并和差集)
        * [merge() - 数组合并](#merge---数组合并)
        * [mergeRecursive() - 数组合并（保留键名）](#mergerecursive---数组合并保留键名)
        * [diff() - 数组差集](#diff---数组差集)
        * [diffKey() - 数组差集（带键名）](#diffkey---数组差集带键名)
        * [intersect() - 数组交集](#intersect---数组交集)
        * [intersectKey() - 数组交集（带键名）](#intersectkey---数组交集带键名)
      * [数组转换](#数组转换)
        * [toJson() - 多维数组转JSON](#tojson---多维数组转json)
        * [fromJson() - JSON转多维数组](#fromjson---json转多维数组)
        * [flatten() - 数组扁平化](#flatten---数组扁平化)
        * [keys() - 数组键名](#keys---数组键名)
        * [values() - 数组键值](#values---数组键值)
        * [flip() - 键名与键值翻转](#flip---键名与键值翻转)
        * [column() - 数组列提取](#column---数组列提取)
      * [数组键值操作](#数组键值操作)
        * [mapKeys() - 数组映射键名](#mapkeys---数组映射键名)
        * [mapValues() - 数组映射键值](#mapvalues---数组映射键值)
        * [combine() - 数组合并键值](#combine---数组合并键值)
        * [fillKeys() - 数组填充键值](#fillkeys---数组填充键值)
        * [fill() - 数组填充](#fill---数组填充)
      * [数组随机操作](#数组随机操作)
        * [random() - 数组随机元素](#random---数组随机元素)
        * [randomMany() - 数组随机多个元素](#randommany---数组随机多个元素)
      * [数组元素操作](#数组元素操作)
        * [shift() - 数组弹出第一个元素](#shift---数组弹出第一个元素)
        * [pop() - 数组弹出最后一个元素](#pop---数组弹出最后一个元素)
        * [unshift() - 数组头部添加元素](#unshift---数组头部添加元素)
        * [push() - 数组尾部添加元素](#push---数组尾部添加元素)
        * [remove() - 数组删除指定元素](#remove---数组删除指定元素)
        * [removeKey() - 数组删除指定键名](#removekey---数组删除指定键名)
  * [字符串处理模块](#字符串处理模块)
    * [特性](#特性-1)
    * [核心方法](#核心方法-1)
    * [使用示例](#使用示例-1)
      * [脱敏](#脱敏)
        * [mask() - 字符串脱敏](#mask---字符串脱敏)
        * [maskPhone() - 手机号脱敏](#maskphone---手机号脱敏)
        * [maskEmail() - 邮箱脱敏](#maskemail---邮箱脱敏)
        * [maskIdCard() - 身份证号脱敏](#maskidcard---身份证号脱敏)
        * [maskBankCard() - 银行卡号脱敏](#maskbankcard---银行卡号脱敏)
        * [maskName() - 姓名脱敏](#maskname---姓名脱敏)
      * [字符串长度和截断](#字符串长度和截断)
        * [length() - 字符串长度](#length---字符串长度)
        * [truncate() - 字符串截断](#truncate---字符串截断)
        * [limit() - 字符串限制长度](#limit---字符串限制长度)
        * [wordTruncate() - 字符串单词截断](#wordtruncate---字符串单词截断)
      * [字符串命名转换](#字符串命名转换)
        * [snake() - 驼峰转下划线](#snake---驼峰转下划线)
        * [toSnake() - 驼峰命名转下划线命名(支持数组键名)](#tosnake---驼峰命名转下划线命名支持数组键名)
        * [camel() - 下划线转驼峰](#camel---下划线转驼峰)
        * [toCamel() - 下划线命名转驼峰命名(支持数组键名)](#tocamel---下划线命名转驼峰命名支持数组键名)
        * [studly() - 首字母大写驼峰命名](#studly---首字母大写驼峰命名)
        * [ucfirst() - 首字母大写](#ucfirst---首字母大写)
        * [lcfirst() - 首字母小写](#lcfirst---首字母小写)
        * [ucwords() - 单词首字母大写](#ucwords---单词首字母大写)
        * [upper() - 全部大写](#upper---全部大写)
        * [lower() - 全部小写](#lower---全部小写)
        * [swap() - 大小写转换](#swap---大小写转换)
        * [title() - 标题格式](#title---标题格式)
      * [字符串查找和判断](#字符串查找和判断)
        * [contains() - 是否包含子串](#contains---是否包含子串)
        * [startsWith() - 是否以子串开头](#startswith---是否以子串开头)
        * [endsWith() - 是否以子串结尾](#endswith---是否以子串结尾)
        * [pos() - 子串首次出现位置](#pos---子串首次出现位置)
        * [rpos() - 子串最后一次出现位置](#rpos---子串最后一次出现位置)
        * [count() - 子串出现次数](#count---子串出现次数)
        * [match() - 字符串是否匹配正则](#match---字符串是否匹配正则)
      * [字符串替换](#字符串替换)
        * [replace() - 字符串替换](#replace---字符串替换)
        * [replaceArray() - 字符串批量替换](#replacearray---字符串批量替换)
        * [replaceRegex() - 字符串正则替换](#replaceregex---字符串正则替换)
        * [substrReplace() - 字符串截取并替换](#substrreplace---字符串截取并替换)
      * [字符串分割和连接](#字符串分割和连接)
        * [split() - 字符串分割](#split---字符串分割)
        * [toArray() - 字符串分割为数组](#toarray---字符串分割为数组)
        * [fromArray() - 数组连接为字符串](#fromarray---数组连接为字符串)
        * [join() - 字符串连接](#join---字符串连接)
        * [concat() - 字符串拼接](#concat---字符串拼接)
      * [字符串去除空白](#字符串去除空白)
        * [trim() - 去除首尾空白](#trim---去除首尾空白)
        * [ltrim() - 去除左侧空白](#ltrim---去除左侧空白)
        * [rtrim() - 去除右侧空白](#rtrim---去除右侧空白)
        * [clean() - 去除所有空白](#clean---去除所有空白)
      * [字符串填充](#字符串填充)
        * [padLeft() - 左侧填充](#padleft---左侧填充)
        * [padRight() - 右侧填充](#padright---右侧填充)
        * [padBoth() - 两侧填充](#padboth---两侧填充)
      * [字符串重复](#字符串重复)
        * [repeat() - 字符串重复](#repeat---字符串重复)
        * [reverse() - 字符串反转](#reverse---字符串反转)
      * [字符串随机](#字符串随机)
        * [random() - 生成随机字符串](#random---生成随机字符串)
        * [numeric() - 生成随机数字字符串](#numeric---生成随机数字字符串)
        * [alpha() - 生成随机字母字符串](#alpha---生成随机字母字符串)
      * [字符串编码解码](#字符串编码解码)
        * [toBase64() - Base64编码](#tobase64---base64编码)
        * [fromBase64() - Base64解码](#frombase64---base64解码)
        * [toUrlEncode() - URL编码](#tourlencode---url编码)
        * [fromUrlEncode() - URL解码](#fromurlencode---url解码)
        * [toHtmlEntities() - HTML实体编码](#tohtmlentities---html实体编码)
        * [fromHtmlEntities() - HTML实体解码](#fromhtmlentities---html实体解码)
        * [toJson() - JSON编码](#tojson---json编码)
        * [fromJson() - JSON解码](#fromjson---json解码)
        * [toXml() - XML编码](#toxml---xml编码)
        * [fromXml() - XML解码](#fromxml---xml解码)
        * [toBinary() - 二进制编码](#tobinary---二进制编码)
        * [fromBinary() - 二进制解码](#frombinary---二进制解码)
        * [toHex() - 十六进制编码](#tohex---十六进制编码)
        * [fromHex() - 十六进制解码](#fromhex---十六进制解码)
      * [字符串哈希](#字符串哈希)
        * [md5() - MD5哈希](#md5---md5哈希)
        * [sha1() - SHA1哈希](#sha1---sha1哈希)
        * [sha256() - SHA256哈希](#sha256---sha256哈希)
        * [sha512() - SHA512哈希](#sha512---sha512哈希)
      * [字符串验证](#字符串验证)
        * [isEmail() - 是否为邮箱](#isemail---是否为邮箱)
        * [isUrl() - 是否为URL](#isurl---是否为url)
        * [isIp() - 是否为IP地址](#isip---是否为ip地址)
        * [isIpv4() - 是否为IPv4地址](#isipv4---是否为ipv4地址)
        * [isIpv6() - 是否为IPv6地址](#isipv6---是否为ipv6地址)
        * [isPhone() - 是否为手机号](#isphone---是否为手机号)
        * [isIdCard() - 是否为身份证号](#isidcard---是否为身份证号)
        * [isBankCard() - 是否为银行卡号](#isbankcard---是否为银行卡号)
        * [isNumeric() - 是否为数字](#isnumeric---是否为数字)
        * [isAlpha() - 是否为字母](#isalpha---是否为字母)
        * [isAlnum() - 是否为字母数字](#isalnum---是否为字母数字)
        * [isHex() - 是否为十六进制](#ishex---是否为十六进制)
        * [isBinary() - 是否为二进制](#isbinary---是否为二进制)
        * [isJson() - 是否为JSON](#isjson---是否为json)
        * [isXml() - 是否为XML](#isxml---是否为xml)
        * [isSerialized() - 是否为序列化数据](#isserialized---是否为序列化数据)
        * [isBase64() - 是否为Base64](#isbase64---是否为base64)
      * [字符串转换](#字符串转换)
        * [toArray() - 字符串转数组](#toarray---字符串转数组)
        * [fromArray() - 数组转字符串](#fromarray---数组转字符串)
        * [toObject() - 字符串转对象](#toobject---字符串转对象)
        * [fromObject() - 对象转字符串](#fromobject---对象转字符串)
        * [toQuery() - 字符串转查询字符串](#toquery---字符串转查询字符串)
        * [fromQuery() - 查询字符串转数组](#fromquery---查询字符串转数组)
      * [字符串格式化](#字符串格式化)
        * [format() - 字符串格式化](#format---字符串格式化)
        * [template() - 字符串模板渲染](#template---字符串模板渲染)
        * [indent() - 字符串缩进](#indent---字符串缩进)
        * [unindent() - 字符串去除缩进](#unindent---字符串去除缩进)
      * [字符串字符操作](#字符串字符操作)
        * [first() - 获取字符串首字符](#first---获取字符串首字符)
        * [last() - 获取字符串尾字符](#last---获取字符串尾字符)
        * [firstN() - 获取字符串前N个字符](#firstn---获取字符串前n个字符)
        * [lastN() - 获取字符串后N个字符](#lastn---获取字符串后n个字符)
        * [removeFirst() - 去除首字符](#removefirst---去除首字符)
        * [removeLast() - 去除尾字符](#removelast---去除尾字符)
        * [removeFirstN() - 去除前N个字符](#removefirstn---去除前n个字符)
        * [removeLastN() - 去除后N个字符](#removelastn---去除后n个字符)
      * [字符串统计](#字符串统计)
        * [count() - 统计子串出现次数](#count---统计子串出现次数)
        * [wordCount() - 统计单词数](#wordcount---统计单词数)
        * [charCount() - 统计字符数](#charcount---统计字符数)
        * [byteLength() - 统计字节长度](#bytelength---统计字节长度)
      * [字符串安全](#字符串安全)
        * [escapeHtml() - 转义HTML特殊字符](#escapehtml---转义html特殊字符)
        * [escapeSql() - 转义SQL特殊字符](#escapesql---转义sql特殊字符)
        * [escapeJs() - 转义JavaScript特殊字符](#escapejs---转义javascript特殊字符)
        * [escapeRegex() - 转义正则表达式特殊字符](#escaperegex---转义正则表达式特殊字符)
      * [字符串比较](#字符串比较)
        * [compare() - 字符串比较](#compare---字符串比较)
        * [similarity() - 字符串相似度](#similarity---字符串相似度)
        * [distance() - 字符串编辑距离](#distance---字符串编辑距离)
  * [时间处理模块](#时间处理模块)
    * [特性](#特性-2)
    * [核心方法](#核心方法-2)
    * [使用示例](#使用示例-2)
      * [时间格式化](#时间格式化)
        * [format() - 格式化时间](#format---格式化时间)
        * [now() - 获取当前时间](#now---获取当前时间)
        * [today() - 获取今天日期](#today---获取今天日期)
        * [yesterday() - 获取昨天日期](#yesterday---获取昨天日期)
        * [tomorrow() - 获取明天日期](#tomorrow---获取明天日期)
      * [时间计算](#时间计算)
        * [add() - 时间加法](#add---时间加法)
        * [sub() - 时间减法](#sub---时间减法)
        * [diff() - 时间差](#diff---时间差)
        * [diffForHumans() - 人性化时间差](#diffforhumans---人性化时间差)
      * [周日期范围](#周日期范围)
        * [weekStart() - 获取本周开始时间](#weekstart---获取本周开始时间)
        * [weekEnd() - 获取本周结束时间](#weekend---获取本周结束时间)
        * [lastWeekStart() - 获取上周开始时间](#lastweekstart---获取上周开始时间)
        * [lastWeekEnd() - 获取上周结束时间](#lastweekend---获取上周结束时间)
      * [月日期范围](#月日期范围)
        * [monthStart() - 获取本月开始时间](#monthstart---获取本月开始时间)
        * [monthEnd() - 获取本月结束时间](#monthend---获取本月结束时间)
        * [lastMonthStart() - 获取上月开始时间](#lastmonthstart---获取上月开始时间)
        * [lastMonthEnd() - 获取上月结束时间](#lastmonthend---获取上月结束时间)
      * [年日期范围](#年日期范围)
        * [yearStart() - 获取本年开始时间](#yearstart---获取本年开始时间)
        * [yearEnd() - 获取本年结束时间](#yearend---获取本年结束时间)
        * [lastYearStart() - 获取上年开始时间](#lastyearstart---获取上年开始时间)
        * [lastYearEnd() - 获取上年结束时间](#lastyearend---获取上年结束时间)
      * [时间判断](#时间判断)
        * [between() - 判断是否在某个时间区间内](#between---判断是否在某个时间区间内)
        * [isToday() - 判断是否是今天](#istoday---判断是否是今天)
        * [isYesterday() - 判断是否是昨天](#isyesterday---判断是否是昨天)
        * [isTomorrow() - 判断是否是明天](#istomorrow---判断是否是明天)
        * [isThisWeek() - 判断是否是本周](#isthisweek---判断是否是本周)
        * [isThisMonth() - 判断是否是本月](#isthismonth---判断是否是本月)
        * [isThisYear() - 判断是否是本年](#isthisyear---判断是否是本年)
      * [日期信息获取](#日期信息获取)
        * [daysInMonth() - 获取某个月的天数](#daysinmonth---获取某个月的天数)
        * [dayOfWeek() - 获取某天是周几](#dayofweek---获取某天是周几)
        * [dayOfWeekName() - 获取某天是周几（中文名称）](#dayofweekname---获取某天是周几中文名称)
        * [dayOfYear() - 获取某天是本年第几天](#dayofyear---获取某天是本年第几天)
        * [weekOfYear() - 获取某天是本年第几周](#weekofyear---获取某天是本年第几周)
      * [年龄计算](#年龄计算)
        * [age() - 计算年龄](#age---计算年龄)
      * [时间戳转换](#时间戳转换)
        * [toTimestamp() - 时间字符串转时间戳](#totimestamp---时间字符串转时间戳)
        * [toMillisecond() - 时间戳转毫秒](#tomillisecond---时间戳转毫秒)
        * [fromMillisecond() - 毫秒转时间戳](#frommillisecond---毫秒转时间戳)
        * [millisecond() - 获取当前毫秒时间戳](#millisecond---获取当前毫秒时间戳)
        * [microsecond() - 获取当前微秒时间戳](#microsecond---获取当前微秒时间戳)
        * [microtime() - 获取当前时间戳（带微秒）](#microtime---获取当前时间戳带微秒)
      * [时区操作](#时区操作)
        * [timezone() - 获取当前时区](#timezone---获取当前时区)
        * [setTimezone() - 设置时区](#settimezone---设置时区)
    * [实际应用场景](#实际应用场景)
  * [数学计算处理模块](#数学计算处理模块)
    * [特性](#特性-3)
    * [核心方法](#核心方法-3)
    * [使用示例](#使用示例-3)
      * [基础运算](#基础运算)
        * [add() - 高精度加法](#add---高精度加法)
        * [sub() - 高精度减法](#sub---高精度减法)
        * [mul() - 高精度乘法](#mul---高精度乘法)
        * [div() - 高精度除法](#div---高精度除法)
        * [mod() - 取模运算](#mod---取模运算)
        * [pow() - 幂运算](#pow---幂运算)
        * [sqrt() - 平方根运算](#sqrt---平方根运算)
      * [取整运算](#取整运算)
        * [round() - 四舍五入](#round---四舍五入)
        * [ceil() - 向上取整](#ceil---向上取整)
        * [floor() - 向下取整](#floor---向下取整)
      * [比较运算](#比较运算)
        * [compare() - 比较两个数的大小](#compare---比较两个数的大小)
        * [equal() - 判断两个数是否相等](#equal---判断两个数是否相等)
      * [格式化](#格式化)
        * [format() - 格式化数字](#format---格式化数字)
      * [三角函数](#三角函数)
        * [sin() - 正弦函数](#sin---正弦函数)
        * [cos() - 余弦函数](#cos---余弦函数)
        * [tan() - 正切函数](#tan---正切函数)
        * [asin() - 反正弦函数](#asin---反正弦函数)
        * [acos() - 反余弦函数](#acos---反余弦函数)
        * [atan() - 反正切函数](#atan---反正切函数)
      * [对数运算](#对数运算)
        * [ln() - 自然对数（以e为底）](#ln---自然对数以e为底)
        * [log10() - 常用对数（以10为底）](#log10---常用对数以10为底)
        * [log() - 自定义底数对数](#log---自定义底数对数)
      * [角度转换](#角度转换)
        * [rad2deg() - 弧度转角度](#rad2deg---弧度转角度)
        * [deg2rad() - 角度转弧度](#deg2rad---角度转弧度)
      * [数值操作](#数值操作)
        * [abs() - 绝对值](#abs---绝对值)
        * [factorial() - 阶乘](#factorial---阶乘)
        * [gcd() - 最大公约数](#gcd---最大公约数)
        * [lcm() - 最小公倍数](#lcm---最小公倍数)
      * [金融计算](#金融计算)
        * [percentage() - 百分比计算](#percentage---百分比计算)
        * [discount() - 折扣计算](#discount---折扣计算)
        * [tax() - 税费计算](#tax---税费计算)
        * [taxIncluded() - 含税金额计算](#taxincluded---含税金额计算)
        * [taxExcluded() - 不含税金额计算](#taxexcluded---不含税金额计算)
        * [simpleInterest() - 简单利息计算](#simpleinterest---简单利息计算)
        * [compoundInterest() - 复利计算](#compoundinterest---复利计算)
      * [随机数生成](#随机数生成)
        * [random() - 生成指定范围内的随机数](#random---生成指定范围内的随机数)
      * [范围检查](#范围检查)
        * [inRange() - 数值范围检查](#inrange---数值范围检查)
        * [clamp() - 限制数值范围](#clamp---限制数值范围)
      * [数值判断](#数值判断)
        * [isPositive() - 判断是否为正数](#ispositive---判断是否为正数)
        * [isNegative() - 判断是否为负数](#isnegative---判断是否为负数)
        * [isZero() - 判断是否为零](#iszero---判断是否为零)
        * [isEven() - 判断是否为偶数](#iseven---判断是否为偶数)
        * [isOdd() - 判断是否为奇数](#isodd---判断是否为奇数)
        * [isPrime() - 判断是否为质数](#isprime---判断是否为质数)
        * [isValid() - 判断数值是否有效](#isvalid---判断数值是否有效)
      * [插值运算](#插值运算)
        * [lerp() - 线性插值](#lerp---线性插值)
      * [统计分析](#统计分析)
        * [average() - 平均值计算](#average---平均值计算)
        * [median() - 中位数计算](#median---中位数计算)
        * [mode() - 众数计算](#mode---众数计算)
        * [standardDeviation() - 标准差计算](#standarddeviation---标准差计算)
    * [实际应用场景](#实际应用场景-1)
  * [地理位置处理模块](#地理位置处理模块)
    * [特性](#特性-4)
    * [核心方法](#核心方法-4)
    * [使用示例](#使用示例-4)
        * [distance() - 计算两个坐标之间的距离](#distance---计算两个坐标之间的距离)
        * [isValid() - 坐标验证](#isvalid---坐标验证)
        * [midpoint() - 计算两个坐标之间的中点](#midpoint---计算两个坐标之间的中点)
        * [bearing() - 计算两个坐标之间的方位角](#bearing---计算两个坐标之间的方位角)
        * [toRadians() - 将角度转换为弧度](#toradians---将角度转换为弧度)
        * [toDegrees() - 将弧度转换为角度](#todegrees---将弧度转换为角度)
        * [toDMS() - 将十进制度数转换为度分秒（DMS）](#todms---将十进制度数转换为度分秒dms)
        * [toDecimal() - 将度分秒（DMS）转换为十进制度数](#todecimal---将度分秒dms转换为十进制度数)
        * [gcj02ToBd09() - GCJ02坐标转BD09坐标](#gcj02tobd09---gcj02坐标转bd09坐标)
        * [bd09ToGcj02() - BD09坐标转GCJ02坐标](#bd09togcj02---bd09坐标转gcj02坐标)
        * [wgs84ToGcj02() - WGS84坐标转GCJ02坐标（中国火星坐标系）](#wgs84togcj02---wgs84坐标转gcj02坐标中国火星坐标系)
        * [gcj02ToWgs84() - GCJ02坐标转WGS84坐标](#gcj02towgs84---gcj02坐标转wgs84坐标)
        * [wgs84ToBd09() - WGS84坐标转BD09坐标](#wgs84tobd09---wgs84坐标转bd09坐标)
        * [bd09ToWgs84() - BD09坐标转WGS84坐标](#bd09towgs84---bd09坐标转wgs84坐标)
  * [IP地址处理模块](#ip地址处理模块)
    * [特性](#特性-5)
    * [核心方法](#核心方法-5)
    * [使用示例](#使用示例-5)
        * [getRealIp() - 获取真实客户端IP地址](#getrealip---获取真实客户端ip地址)
        * [isValid() - 验证IP地址格式是否有效](#isvalid---验证ip地址格式是否有效)
        * [isPrivate() - 检查IP地址是否为私有/内部地址](#isprivate---检查ip地址是否为私有内部地址)
        * [getVersion() - 获取IP地址版本](#getversion---获取ip地址版本)
        * [toLong() - 将IP地址转换为长整数](#tolong---将ip地址转换为长整数)
        * [fromLong() - 将长整数转换为IP地址](#fromlong---将长整数转换为ip地址)
        * [getLocation() - 获取IP地址位置信息](#getlocation---获取ip地址位置信息)
        * [isFromCountry() - 检查IP地址是否来自特定国家](#isfromcountry---检查ip地址是否来自特定国家)
        * [getType() - 获取IP地址类型](#gettype---获取ip地址类型)
  * [代码生成模块](#代码生成模块)
    * [特性](#特性-6)
    * [核心方法](#核心方法-6)
    * [使用示例](#使用示例-6)
        * [uuid() - 生成uuid](#uuid---生成uuid)
        * [orderNo() - 生成订单号](#orderno---生成订单号)
        * [inviteCode() - 生成邀请码](#invitecode---生成邀请码)
        * [urlSafeCode() - 生成URL安全码](#urlsafecode---生成url安全码)
        * [registerCode() - 生成注册码](#registercode---生成注册码)
  * [加解密处理模块](#加解密处理模块)
    * [特性](#特性-7)
    * [核心方法](#核心方法-7)
    * [使用示例](#使用示例-7)
        * [Crypto - 加密引擎说明](#crypto---加密引擎说明)
        * [Crypto - 加密模式说明](#crypto---加密模式说明)
        * [Crypto - 基础加解密](#crypto---基础加解密)
        * [Crypto - 静态方法调用](#crypto---静态方法调用)
        * [md5() - MD5加密（支持加盐）](#md5---md5加密支持加盐)
        * [passwordHash()  - 密码哈希](#passwordhash---密码哈希)
        * [passwordVerify()  - 密码哈希验证](#passwordverify---密码哈希验证)
        * [Crypto - HMAC签名](#crypto---hmac签名)
        * [Crypto - SSL对称加解密](#crypto---ssl对称加解密)
        * [Crypto - 错误处理](#crypto---错误处理)
    * [使用场景](#使用场景)
  * [HTTP请求处理模块](#http请求处理模块)
    * [特性](#特性-8)
    * [核心方法](#核心方法-8)
    * [使用示例](#使用示例-8)
        * [setDefaultOptions() - 设置默认配置](#setdefaultoptions---设置默认配置)
        * [getDefaultOptions() - 获取默认配置](#getdefaultoptions---获取默认配置)
        * [reset() - 重置客户端实例](#reset---重置客户端实例)
        * [options() - OPTIONS请求](#options---options请求)
        * [head() - HEAD请求](#head---head请求)
        * [get() - GET请求](#get---get请求)
        * [post() - POST请求](#post---post请求)
        * [postForm() - POST表单请求](#postform---post表单请求)
        * [postMultipart() - POST文件上传请求](#postmultipart---post文件上传请求)
        * [put() - PUT请求](#put---put请求)
        * [putForm() - PUT表单请求](#putform---put表单请求)
        * [delete() - PUT请求](#delete---put请求)
        * [patch() - PATCH请求](#patch---patch请求)
* [版本要求](#版本要求)
* [许可证](#许可证)
<!-- TOC -->

# 简介

这是一个基于PHP8.1+特性开发的模块化通用工具包，提供了数组处理、字符串处理、时间处理、加解密、消息体、IP地址处理、地理计算、全局辅助方法等功能。支持对象和静态两种调用方式，兼容进程和协程环境。

# 安装

```
composer require cdyun/php-tool
```

# 模块化目录
工具包采用清晰的模块化架构，每个模块专注于特定领域的功能：

```
├── src/
│   ├── Arr.php       // 数组处理主类
│   ├── Str.php       // 字符串处理主类
│   ├── Time.php      // 时间处理主类
│   ├── Math.php      // 数学计算主类
│   ├── Geo.php       // 地理位置主类
│   ├── Ip.php        // IP地址处理主类
│   ├── Crypto.php    // 加解密主类（命名简洁）
│   ├── Generate.php  // 代码生成工具类
│   ├── Curl.php      // HTTP请求主类
│   ├── helpers.php   // 全局辅助函数文件
│   ├──......             // 其他│   
│   
├── composer.json         // Composer配置
├── README.md             // 使用文档
```
## 数组处理模块

### 特性
- ✅ 树形结构转换（数组转树、树转数组）
- ✅ 层级结构转换
- ✅ 路径结构转换
- ✅ 常用数组操作（get/set/has/only/except）
- ✅ 数组深度合并
- ✅ 多维数组分组
- ✅ 多维数组统计（count/sum/avg/max/min）
- ✅ 多维数组转JSON/JSON转数组
- ✅ 非递归算法，支持大数据量
- ✅ 支持点语法和数组嵌套键访问

### 核心方法
| 方法名 | 功能描述 | 调用示例 |
|--------|----------|----------|
| [`first()`](#arrfirst---数组首元素) | 获取第一个元素 | `Arr::first([1, 2, 3])` |
| [`last()`](#arrlast---数组尾元素) | 获取最后一个元素 | `Arr::last([1, 2, 3])` |
| [`find()`](#arrfind---查找满足条件的元素) | 查找满足条件的元素 | `Arr::find([1, 2, 3], fn($n) => $n > 1)` |
| [`tree()`](#arrtree---数组转树形结构) | 数组转树形结构 | `Arr::tree($list, 'id', 'pid')` |
| [`list()`](#arrlist---树形结构转数组) | 树形结构转数组 | `Arr::list($tree)` |
| [`deepMerge()`](#arrdeepmerge---数组深度合并) | 深度合并数组 | `Arr::deepMerge($arr1, $arr2)` |

### 兼容性说明
数组处理模块会自动检测PHP版本，在PHP 8.4+环境下使用原生数组函数以获得最佳性能：

- `array_first()` - 获取数组第一个元素
- `array_last()` - 获取数组最后一个元素
- `array_find()` - 查找满足条件的元素
- `array_find_key()` - 查找满足条件的键名
- `array_any()` - 检查是否存在满足条件的元素
- `array_all()` - 检查是否所有元素都满足条件

在PHP 8.4以下版本，模块会使用兼容的实现，确保代码在不同PHP版本下都能正常运行。

### 使用示例

#### 树形结构转换

##### tree() / toTree() - 数组转树形结构
```php
use Cdyun\PhpTool\Arr;

$data = [
    ['id' => 1, 'name' => '部门1', 'parent_id' => 0],
    ['id' => 2, 'name' => '部门2', 'parent_id' => 1],
    ['id' => 3, 'name' => '部门3', 'parent_id' => 1],
    ['id' => 4, 'name' => '部门4', 'parent_id' => 2],
    ['id' => 5, 'name' => '部门5', 'parent_id' => 100]
];

// 按指定根节点ID，将扁平化数组转换为树形结构，会过滤掉非指定根节点及子节点的数据
$tree = Arr::toTree($data, 5, 'id', 'parent_id', 'children');
// 输出:
// [
//     [
//         'id' => 5,
//         'name' => '部门5',
//         'parent_id' => 100,
//         'children' => []
//     ]
// ]

// 数组转树形结构
$tree = Arr::tree($data, 'id', 'parent_id', 'children');
// 输出:
// [
//     [
//         'id' => 1,
//         'name' => '部门1',
//         'parent_id' => 0,
//         'children' => [
//             [
//                 'id' => 2,
//                 'name' => '部门2',
//                 'parent_id' => 1,
//                 'children' => [
//                     ['id' => 4, 'name' => '部门4', 'parent_id' => 2, 'children' => []]
//                 ]
//             ],
//             [
//                 'id' => 3,
//                 'name' => '部门3',
//                 'parent_id' => 1,
//                 'children' => []
//             ]
//         ]
//     ],
//     [
//         'id' => 5,
//         'name' => '部门5',
//         'parent_id' => 100,
//         'children' => []
//     ]
// ]
```

##### list() - 树形结构转数组
```php
$flat = Arr::list($tree, 'children');
```

##### level() - 数组转层级结构
```php
$level = Arr::level($data, 'id', 'parent_id', 'level');
// 输出:
// [
//     ['id' => 1, 'name' => '部门1', 'parent_id' => 0, 'level' => 1],
//     ['id' => 2, 'name' => '部门2', 'parent_id' => 1, 'level' => 2],
//     ['id' => 3, 'name' => '部门3', 'parent_id' => 1, 'level' => 2],
//     ['id' => 4, 'name' => '部门4', 'parent_id' => 2, 'level' => 3]
// ]
```

##### path() - 数组转路径结构
```php
$path = Arr::path($data, 'id', 'parent_id', 'name', 'path', '/');
// 输出:
// [
//     ['id' => 1, 'name' => '部门1', 'parent_id' => 0, 'path' => '部门1'],
//     ['id' => 2, 'name' => '部门2', 'parent_id' => 1, 'path' => '部门1/部门2'],
//     ['id' => 3, 'name' => '部门3', 'parent_id' => 1, 'path' => '部门1/部门3'],
//     ['id' => 4, 'name' => '部门4', 'parent_id' => 2, 'path' => '部门1/部门2/部门4']
// ]
```

#### 数组访问和操作

##### deepMerge() - 数组深度合并
```php
use Cdyun\PhpTool\Arr;

$arr1 = [
    'user' => ['name' => '张三', 'age' => 25],
    'settings' => ['theme' => 'dark']
];

$arr2 = [
    'user' => ['age' => 26, 'email' => 'user@example.com'],
    'settings' => ['language' => 'zh-CN']
];

$merged = Arr::deepMerge($arr1, $arr2);
// 输出:
// [
//     'user' => ['name' => '张三', 'age' => 26,'email' => 'user@example.com'],
//     'settings' => ['theme' => 'dark', 'language' => 'zh-CN']
// ]
```

##### get() - 数组获取值（支持点语法）
```php
$value = Arr::get($arr1, 'user.name'); // '张三'
$value = Arr::get($arr1, ['user', 'age']); // 25
$value = Arr::get($arr1, 'user.email', 'default@example.com'); // 'default@example.com'
```

##### set() - 数组设置值
```php
$result = Arr::set($arr1, 'user.age', 26);
```

##### has() - 数组判断是否存在键
```php
$exists = Arr::has($arr1, 'user.name'); // true
$exists = Arr::has($arr1, 'user.email'); // false
```

##### only() - 数组仅保留指定键
```php
$only = Arr::only($arr1, ['user.name', 'user.age']);
// 输出: ['user' => ['name' => '张三', 'age' => 25]]
```

##### except() - 数组排除指定键
```php
$except = Arr::except($array1, ['settings']);
// 输出: ['user' => ['name' => '张三', 'age' => 25]]
```

#### 多维数组处理

##### group() - 多维数组分组
```php
use Cdyun\PhpTool\Arr;

$flatArray = [
    ['id' => 1, 'name' => '部门1', 'parent_id' => 0],
    ['id' => 2, 'name' => '部门2', 'parent_id' => 1],
    ['id' => 3, 'name' => '部门3', 'parent_id' => 1],
    ['id' => 4, 'name' => '部门4', 'parent_id' => 2]
];

// 多维数组分组
$grouped = Arr::group($flatArray, 'parent_id');
// 输出:
// [
//     0 => [['id' => 1, 'name' => '部门1', 'parent_id' => 0]],
//     1 => [
//         ['id' => 2, 'name' => '部门2', 'parent_id' => 1],
//         ['id' => 3, 'name' => '部门3', 'parent_id' => 1]
//     ],
//     2 => [['id' => 4, 'name' => '部门4', 'parent_id' => 2]]
// ]
```

##### count() - 多维数组统计
```php
// 多维数组统计
$count = Arr::count($flatArray, 'parent_id');
// 输出: [0 => 1, 1 => 2, 2 => 1]
```

##### sum() - 多维数组求和
```php
$sum = Arr::sum($flatArray, 'id'); // 10
```

##### avg() - 多维数组求平均值
```php
$avg = Arr::avg($flatArray, 'id'); // 2.5
```

##### max() - 多维数组求最大值
```php
$min = Arr::max($flatArray, 'id'); // 4
```

##### min() - 多维数组求最小值
```php
$min = Arr::min($flatArray, 'id'); // 1
```

#### PHP 8.4+数组函数

##### first() - 数组首元素

```php
use Cdyun\PhpTool\Arr;

// PHP 8.4+使用原生array_first
$first = Arr::first([1, 2, 3, 4, 5]); // 1
$first = Arr::first([]); // null
```

##### last() - 数组尾元素
```php
// PHP 8.4+使用原生array_last
$last = Arr::last([1, 2, 3, 4, 5]); // 5
$last = Arr::last([]); // null
```

##### find() - 查找满足条件的元素
```php
// PHP 8.4+使用原生array_find
$found = Arr::find([1, 2, 3, 4, 5], fn($n) => $n > 2); // 3
$found = Arr::find([1, 2, 3, 4, 5], fn($n) => $n > 10); // null
```

##### findKey() - 查找满足条件的键名
```php
// PHP 8.4+使用原生array_find_key
$foundKey = Arr::findKey(['a' => 1, 'b' => 2, 'c' => 3], fn($n) => $n > 1); // 'b'
$foundKey = Arr::findKey(['a' => 1, 'b' => 2, 'c' => 3], fn($n) => $n > 10); // null
```

##### any() - 检查是否存在满足条件的元素
```php
// PHP 8.4+使用原生array_any
$hasAny = Arr::any([1, 2, 3, 4, 5], fn($n) => $n > 3); // true
$hasAny = Arr::any([1, 2, 3, 4, 5], fn($n) => $n > 10); // false
```

##### all() - 检查是否所有元素都满足条件
```php
// PHP 8.4+使用原生array_all
$allMatch = Arr::all([1, 2, 3, 4, 5], fn($n) => $n > 0); // true
$allMatch = Arr::all([1, 2, 3, 4, 5], fn($n) => $n > 2); // false
```

#### 数组查找和判断

##### map() - 数组映射
```php
$mapped = Arr::map([1, 2, 3, 4, 5], fn($n) => $n * 2); // [2, 4, 6, 8, 10]
```

##### filter() - 数组过滤
```php
$filtered = Arr::filter([1, 2, 3, 4, 5], fn($n) => $n > 2); // [3, 4, 5]
$filtered = Arr::filter([1, 2, 0, null, false]); // [1, 2]（过滤空值）
```

##### reduce() - 数组归约
```php
$sum = Arr::reduce([1, 2, 3, 4, 5], fn($carry, $n) => $carry + $n, 0); // 15
```

##### find() - 查找满足条件的第一个元素的键值
```php
$findVal = Arr::find([1, 2, 3, 4, 5], fn($n) => $n > 3); // 4
$findVal = Arr::find(['a' => 10, 'b' => 20, 'c' => 30], fn($n) => $n > 20); // 30
```

##### findKey() - 查找满足条件的第一个元素的键名
```php
$findKeyVal = Arr::findKey([1, 2, 3, 4, 5], fn($n) => $n > 3); // 3
$findKeyVal = Arr::findKey(['a' => 10, 'b' => 20, 'c' => 30], fn($n) => $n > 20); // 'c'
```

##### some() - 检查是否存在满足条件的元素（别名方法）
```php
$hasSome = Arr::some([1, 2, 3, 4, 5], fn($n) => $n > 3); // true
```

##### every() - 检查是否所有元素都满足条件（别名方法）
```php
$allMatch = Arr::every([1, 2, 3, 4, 5], fn($n) => $n > 0); // true
```

##### contains() - 数组是否包含指定元素
```php
$contains = Arr::contains([1, 2, 3, 4, 5], 3); // true
$contains = Arr::contains([1, 2, 3, 4, 5], '3', false); // true（非严格比较）
$contains = Arr::contains([1, 2, 3, 4, 5], '3', true); // false（严格比较）
```

##### containsKey() - 数组是否包含指定键名
```php
$containsKey = Arr::containsKey(['a' => 1, 'b' => 2], 'a'); // true
```

##### isEmpty() - 数组是否为空
```php
$isEmpty = Arr::isEmpty([]); // true
$isEmpty = Arr::isEmpty([1, 2, 3]); // false
```

##### isAssoc() - 数组是否为关联数组
```php
$isAssoc = Arr::isAssoc(['a' => 1, 'b' => 2]); // true
$isAssoc = Arr::isAssoc([1, 2, 3]); // false
```

##### isIndexed() - 数组是否为索引数组
```php
$isIndexed = Arr::isIndexed([1, 2, 3]); // true
$isIndexed = Arr::isIndexed(['a' => 1, 'b' => 2]); // false
```

#### 数组排序

```php
use Cdyun\PhpTool\Arr;

$users = [
    ['id' => 3, 'name' => '张三', 'age' => 25],
    ['id' => 1, 'name' => '李四', 'age' => 30],
    ['id' => 2, 'name' => '王五', 'age' => 28]
];
```

##### sort() - 升序/降序
```php
// 升序
$sorted = Arr::sort($users, 'age', 'asc');
// 输出: 
//  [
//      ['id' => 3, 'name' => '张三', 'age' => 25],
//      ['id' => 2, 'name' => '王五', 'age' => 28],
//      ['id' => 1, 'name' => '李四', 'age' => 30]
//  ]

// 降序
$sorted = Arr::sort($users, 'age', 'desc');
// 输出:
//  [
//      ['id' => 1, 'name' => '李四', 'age' => 30],
//      ['id' => 2, 'name' => '王五', 'age' => 28],
//      ['id' => 3, 'name' => '张三', 'age' => 25]
//  ]
```

##### multiSort() - 多维数组排序
```php
// 先按age升序，age相同时按id降序
$multiSorted = Arr::multiSort($users, ['age', 'id'], ['asc', 'desc']);
```

##### reverse() - 数组反转
```php
$reversed = Arr::reverse([1, 2, 3, 4, 5]); // [5, 4, 3, 2, 1]
$reversed = Arr::reverse(['a' => 1, 'b' => 2], true); // ['b' => 2, 'a' => 1]（保留键名）
```

##### shuffle() - 数组打乱
```php
$shuffled = Arr::shuffle([1, 2, 3, 4, 5]); // 随机打乱顺序
```

#### 数组去重

##### unique() - 数组去重
```php
$unique = Arr::unique([1, 2, 2, 3, 3, 3, 4, 4, 4, 4]); // [1, 2, 3, 4]
$unique = Arr::unique([1, '1', 2, '2'], true); // [1, '1', 2, '2]（严格比较）
$unique = Arr::unique([1, '1', 2, '2'], false); // [1, 2]（非严格比较）
```

##### multiUnique() - 多维数组去重
```php
$users = [
    ['id' => 1, 'name' => '张三'],
    ['id' => 2, 'name' => '李四'],
    ['id' => 1, 'name' => '张三']
];
$unique = Arr::multiUnique($users, 'id');
// 输出:
//  [
//      ['id' => 1, 'name' => '张三'],
//      ['id' => 2, 'name' => '李四']
//  ]
```

#### 数组分页和切片

##### paginate() - 数组分页
```php
$array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
$page1 = Arr::paginate($array, 1, 5); // [1, 2, 3, 4, 5]
$page2 = Arr::paginate($array, 2, 5); // [6, 7, 8, 9, 10]
$page3 = Arr::paginate($array, 3, 5); // [11, 12]
```

##### slice() - 数组切片
```php
$sliced = Arr::slice([1, 2, 3, 4, 5], 1, 3); // [2, 3, 4]
$sliced = Arr::slice(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 1, 2, true); // ['b' => 2, 'c' => 3]（保留键名）
```

##### chunk() - 数组分割
```php
$chunked = Arr::chunk([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], 3);
// 输出: [[1, 2, 3], [4, 5, 6], [7, 8, 9], [10]]
```

#### 数组合并和差集

##### merge() - 数组合并
```php
$merged = Arr::merge([1, 2, 3], [4, 5, 6]); // [1, 2, 3, 4, 5, 6]
```

##### mergeRecursive() - 数组合并（保留键名）
```php
$merged = Arr::mergeRecursive(['a' => 1], ['b' => 2]); // ['a' => 1, 'b' => 2]
```

##### diff() - 数组差集
```php
$diff = Arr::diff([1, 2, 3, 4, 5], [2, 4]); // [1, 3, 5]
```

##### diffKey() - 数组差集（带键名）
```php
$diff = Arr::diffKey(['a' => 1, 'b' => 2, 'c' => 3], ['b' => 2]); // ['a' => 1, 'c' => 3]
```

##### intersect() - 数组交集
```php
$intersect = Arr::intersect([1, 2, 3, 4, 5], [2, 4, 6]); // [2, 4]
```

##### intersectKey() - 数组交集（带键名）
```php
$intersect = Arr::intersectKey(['a' => 1, 'b' => 2, 'c' => 3], ['b' => 2, 'c' => 4]); // ['b' => 2, 'c' => 3]
```

#### 数组转换

##### toJson() - 多维数组转JSON
```php
$json = Arr::toJson(['name' => '张三', 'age' => 25]); // '{"name":"张三","age":25}'
```

##### fromJson() - JSON转多维数组
```php
$array = Arr::fromJson('{"name":"张三","age":25}'); // ['name' => '张三', 'age' => 25]
```

##### flatten() - 数组扁平化
```php
$flattened = Arr::flatten([1, [2, [3, [4, 5]]]]); // [1, 2, 3, 4, 5]
```

##### keys() - 数组键名
```php
$keys = Arr::keys(['a' => 1, 'b' => 2, 'c' => 3]); // ['a', 'b', 'c']
```

##### values() - 数组键值
```php
$values = Arr::values(['a' => 1, 'b' => 2, 'c' => 3]); // [1, 2, 3]
```

##### flip() - 键名与键值翻转
```php
$flipped = Arr::flip(['a' => 1, 'b' => 2, 'c' => 3]); // [1 => 'a', 2 => 'b', 3 => 'c']
```

##### column() - 数组列提取
```php
$users = [
    ['id' => 1, 'name' => '张三', 'age' => 25],
    ['id' => 2, 'name' => '李四', 'age' => 30]
];
$names = Arr::column($users, 'name'); // ['张三', '李四']
$indexed = Arr::column($users, 'name', 'id'); // [1 => '张三', 2 => '李四']
```

#### 数组键值操作

##### mapKeys() - 数组映射键名
```php
$mapped = Arr::mapKeys(['a' => 1, 'b' => 2], fn($key) => strtoupper($key)); // ['A' => 1, 'B' => 2]
```

##### mapValues() - 数组映射键值
```php
$mapped = Arr::mapValues(['a' => 1, 'b' => 2], fn($value) => $value * 2); // ['a' => 2, 'b' => 4]
```

##### combine() - 数组合并键值
```php
$combined = Arr::combine(['a', 'b', 'c'], [1, 2, 3]); // ['a' => 1, 'b' => 2, 'c' => 3]
```

##### fillKeys() - 数组填充键值
```php
$filled = Arr::fillKeys(['a', 'b', 'c'], 0); // ['a' => 0, 'b' => 0, 'c' => 0]
```

##### fill() - 数组填充
```php
$filled = Arr::fill(0, 5, 0); // [0, 0, 0, 0, 0]
```

#### 数组随机操作

##### random() - 数组随机元素
```php
$random = Arr::random([1, 2, 3, 4, 5]); // 随机返回其中一个元素
```

##### randomMany() - 数组随机多个元素
```php
$randomMany = Arr::randomMany([1, 2, 3, 4, 5], 3); // 随机返回3个元素
```

#### 数组元素操作

```php
$array = [1, 2, 3, 4, 5];
```

##### shift() - 数组弹出第一个元素
```php
$first = Arr::shift($array); // 1，$array变为[2, 3, 4, 5]
```

##### pop() - 数组弹出最后一个元素
```php
$last = Arr::pop($array); // 5，$array变为[2, 3, 4]
```

##### unshift() - 数组头部添加元素
```php
$count = Arr::unshift($array, 0); // 4，$array变为[0, 2, 3, 4]
```

##### push() - 数组尾部添加元素
```php
$count = Arr::push($array, 5); // 5，$array变为[0, 2, 3, 4, 5]
```

##### remove() - 数组删除指定元素
```php
$removed = Arr::remove([1, 2, 3, 2, 4, 2], 2); // [1, 3, 4]
```

##### removeKey() - 数组删除指定键名
```php
$removed = Arr::removeKey(['a' => 1, 'b' => 2, 'c' => 3], 'b'); // ['a' => 1, 'c' => 3]
```

## 字符串处理模块

### 特性
- ✅ 随机字符串生成
- ✅ 命名转换（驼峰、蛇形、大驼峰）
- ✅ 字符串转义和反转义
- ✅ 字符串修剪
- ✅ 字符串脱敏（手机号、身份证号、邮箱、银行卡号、车牌号、姓名）
- ✅ 字符串验证（手机号、身份证号、邮箱、车牌号、银行卡号）
- ✅ 收货地址解析
- ✅ 字符串格式化和转换
- ✅ 字符串相似度比较
- ✅ 多分隔符字符串分割

### 核心方法
| 方法名 | 功能描述 | 调用示例 |
|--------|----------|----------|
| [`maskPhone()`](#strmaskphone---手机号脱敏) | 手机号脱敏 | `Str::maskPhone('13800138000')` |
| [`maskEmail()`](#strmaskemail---邮箱脱敏) | 邮箱脱敏 | `Str::maskEmail('user@example.com')` |
| [`camel()`](#strcamel---下划线转驼峰) | 转驼峰命名 | `Str::camel('hello_world')` |
| [`snake()`](#strsnake---驼峰转下划线) | 转蛇形命名 | `Str::snake('helloWorld')` |
| [`toBase64()`](#strtobase64---转base64编码) | 转Base64编码 | `Str::toBase64('hello')` |
| [`fromBase64()`](#strfrombase64---base64解码) | Base64解码 | `Str::fromBase64('aGVsbG8=')` |

### 使用示例

#### 脱敏

##### mask() - 字符串脱敏
```php
$masked = Str::mask('13800138000', 3, 4, '*'); // '138****8000'
$masked = Str::mask('user@example.com', 2, 4, '*'); // 'us****@example.com'
```

##### maskPhone() - 手机号脱敏
```php
$phone = Str::maskPhone('13800138000'); // '138****8000'
$phone = Str::maskPhone('13800138000', 3, 4); // '138****8000'
```

##### maskEmail() - 邮箱脱敏
```php
$email = Str::maskEmail('user@example.com'); // 'us***@example.com'
$email = Str::maskEmail('user@example.com', 2, 3); // 'us***@example.com'
```

##### maskIdCard() - 身份证号脱敏
```php
$idCard = Str::maskIdCard('110101199001011234'); // '110101********1234'
$idCard = Str::maskIdCard('110101199001011234', 6, 8); // '110101********1234'
```

##### maskBankCard() - 银行卡号脱敏
```php
$bankCard = Str::maskBankCard('6222021234567890123'); // '622202********0123'
$bankCard = Str::maskBankCard('6222021234567890123', 6, 10); // '622202********0123'
```

##### maskName() - 姓名脱敏
```php
$name = Str::maskName('张三'); // '张*'
$name = Str::maskName('欧阳修'); // '欧阳*'
$name = Str::maskName('张三丰', 1, 1); // '张*丰'
```

#### 字符串长度和截断

##### length() - 字符串长度
```php
$length = Str::length('你好世界'); // 4（使用mb_strlen）
```

##### truncate() - 字符串截断
```php
$truncated = Str::truncate('这是一段很长的文本内容', 10); // '这是一段很长的文...'
$truncated = Str::truncate('这是一段很长的文本内容', 10, '---'); // '这是一段很长的文---'
```

##### limit() - 字符串限制长度
```php
$limited = Str::limit('这是一段很长的文本内容', 10); // '这是一段很长的文...'
$limited = Str::limit('短文本', 10); // '短文本'（不超过长度不截断）
```

##### wordTruncate() - 字符串单词截断
```php
$wordTruncate = Str::wordTruncate('This is a long text content', 10); // 'This is a...'
```

#### 字符串命名转换

##### snake() - 驼峰转下划线
```php
$snake = Str::snake('helloWorld'); // 'hello_world'
$snake = Str::snake('HelloWorld'); // 'hello_world'
$snake = Str::snake('HelloWorld', '-'); // 'hello-world'
```
##### toSnake() - 驼峰命名转下划线命名(支持数组键名)
```php
$snake = Str::toSnake('helloWorld'); // 'hello_world'
$snake = Str::toSnake('HelloWorld'); // 'hello_world'
$snake = Str::toSnake(['AaBbCc'=>1]); // ['aa_bb_cc'=>1]
```

##### camel() - 下划线转驼峰
```php
$camel = Str::camel('hello_world'); // 'helloWorld'
$camel = Str::camel('hello-world'); // 'helloWorld'
$camel = Str::camel('hello_world', '-'); // 'helloWorld'
```

##### toCamel() - 下划线命名转驼峰命名(支持数组键名)
```php
$camel = Str::toCamel('hello_world', false); // 'helloWorld'
$camel = Str::toCamel('hello_world', true); // 'HelloWorld'
$camel = Str::toCamel(['aa_bb_cc'=>1], false); // 'aaBbCc'
$camel = Str::toCamel(['aa_bb_cc'=>1], true); // 'AaBbCc'
```

##### studly() - 首字母大写驼峰命名
```php
$camel = Str::studly('hello_world'); // 'HelloWorld'
$camel = Str::studly('hello-world'); // 'HelloWorld'
$camel = Str::studly('hello.world'); // 'HelloWorld'
$camel = Str::studly('aa-bb_cc.dd'); // 'AaBbCcDd'
```

##### ucfirst() - 首字母大写
```php
$ucfirst = Str::ucfirst('hello'); // 'Hello'
```

##### lcfirst() - 首字母小写
```php
$lcfirst = Str::lcfirst('Hello'); // 'hello'
```

##### ucwords() - 单词首字母大写
```php
$ucwords = Str::ucwords('hello world'); // 'Hello World'
```

##### upper() - 全部大写
```php
$upper = Str::upper('hello'); // 'HELLO'
```

##### lower() - 全部小写
```php
$lower = Str::lower('HELLO'); // 'hello'
```

##### swap() - 大小写转换
```php
$swap = Str::swap('Hello'); // 'hELLO'
```

##### title() - 标题格式
```php
$title = Str::title('hello world'); // 'Hello World'
```

#### 字符串查找和判断

##### contains() - 是否包含子串
```php
$contains = Str::contains('hello world', 'world'); // true
$contains = Str::contains('hello world', 'php'); // false
```

##### startsWith() - 是否以子串开头
```php
$startsWith = Str::startsWith('hello world', 'hello'); // true
$startsWith = Str::startsWith('hello world', 'world'); // false
```

##### endsWith() - 是否以子串结尾
```php
$endsWith = Str::endsWith('hello world', 'world'); // true
$endsWith = Str::endsWith('hello world', 'hello'); // false
```

##### pos() - 子串首次出现位置
```php
$pos = Str::pos('hello world', 'world'); // 6
$pos = Str::pos('hello world', 'php'); // false
```

##### rpos() - 子串最后一次出现位置
```php
$pos = Str::rpos('hello world world', 'world'); // 12
$pos = Str::rpos('hello world', 'php'); // false
```

##### count() - 子串出现次数
```php
$count = Str::count('hello world world', 'world'); // 2
```

##### match() - 字符串是否匹配正则
```php
$match = Str::match('hello123', '/^[a-z]+\d+$/'); // true
$match = Str::match('hello', '/^[a-z]+\d+$/'); // false
```

#### 字符串替换

##### replace() - 字符串替换
```php
$replaced = Str::replace('hello world', 'world', 'php'); // 'hello php'
```

##### replaceArray() - 字符串批量替换
```php
$replaced = Str::replaceArray('hello world', ['hello' => 'hi', 'world' => 'php']); // 'hi php'
```

##### replaceRegex() - 字符串正则替换
```php
$replaced = Str::replaceRegex('hello123world', '/\d+/', '456'); // 'hello456world'
```

##### substrReplace() - 字符串截取并替换
```php
$replaced = Str::substrReplace('hello world', 'php', 6, 5); // 'hello php'
```

#### 字符串分割和连接

##### split() - 字符串分割
```php
$parts = Str::split('hello,world,php', ','); // ['hello', 'world', 'php']
```

##### toArray() - 字符串分割为数组
```php
$array = Str::toArray('hello,world,php', ','); // ['hello', 'world', 'php']
```

##### fromArray() - 数组连接为字符串
```php
$string = Str::fromArray(['hello', 'world', 'php'], ','); // 'hello,world,php'
```

##### join() - 字符串连接
```php
$joined = Str::join(['hello', 'world', 'php'], ','); // 'hello,world,php'
```

##### concat() - 字符串拼接
```php
$concat = Str::concat('hello', ' ', 'world'); // 'hello world'
```

#### 字符串去除空白

##### trim() - 去除首尾空白
```php
$trimmed = Str::trim('  hello world  '); // 'hello world'
```

##### ltrim() - 去除左侧空白
```php
$ltrim = Str::ltrim('  hello world  '); // 'hello world  '
```

##### rtrim() - 去除右侧空白
```php
$rtrim = Str::rtrim('  hello world  '); // '  hello world'
```
##### clean() - 去除所有空白
```php
$clean = Str::clean('  hello   world  '); // 'helloworld'
```

#### 字符串填充

##### padLeft() - 左侧填充
```php
$padded = Str::padLeft('123', 6, '0'); // '000123'
```

##### padRight() - 右侧填充
```php
$padded = Str::padRight('123', 6, '0'); // '123000'
```

##### padBoth() - 两侧填充
```php
$padded = Str::padBoth('123', 7, '*'); // '**123**'
```

#### 字符串重复

##### repeat() - 字符串重复
```php
$repeated = Str::repeat('hello', 3); // 'hellohellohello'
```

##### reverse() - 字符串反转
```php
$reversed = Str::reverse('hello'); // 'olleh'
```

#### 字符串随机

##### random() - 生成随机字符串
```php
$random = Str::random(16); // 16位随机字符串
```

##### numeric() - 生成随机数字字符串
```php
$numeric = Str::numeric(6); // 6位随机数字字符串
```
##### alpha() - 生成随机字母字符串
```php
$alpha = Str::alpha(8); // 8位随机字母字符串
```

#### 字符串编码解码

##### toBase64() - Base64编码
```php
$base64 = Str::toBase64('hello'); // 'aGVsbG8='
```

##### fromBase64() - Base64解码
```php
$decoded = Str::fromBase64('aGVsbG8='); // 'hello'
```

##### toUrlEncode() - URL编码
```php
$urlEncoded = Str::toUrlEncode('hello world'); // 'hello%20world'
```

##### fromUrlEncode() - URL解码
```php
$urlDecoded = Str::fromUrlEncode('hello%20world'); // 'hello world'
```

##### toHtmlEntities() - HTML实体编码
```php
$htmlEncoded = Str::toHtmlEntities('<div>hello</div>'); // '&lt;div&gt;hello&lt;/div&gt;'
```

##### fromHtmlEntities() - HTML实体解码
```php
$htmlDecoded = Str::fromHtmlEntities('&lt;div&gt;hello&lt;/div&gt;'); // '<div>hello</div>'
```

##### toJson() - JSON编码
```php
$json = Str::toJson(['name' => '张三', 'age' => 25]); // '{"name":"张三","age":25}'
```

##### fromJson() - JSON解码
```php
$decoded = Str::fromJson('{"name":"张三","age":25}'); // ['name' => '张三', 'age' => 25]
```

##### toXml() - XML编码
```php
$xml = Str::toXml(['name' => '张三', 'age' => 25], 'root'); // '<root><name>张三</name><age>25</age></root>'
```
##### fromXml() - XML解码
```php
$decoded = Str::fromXml('<root><name>张三</name><age>25</age></root>'); // ['name' => '张三', 'age' => 25]
```

##### toBinary() - 二进制编码
```php
$binary = Str::toBinary('hello'); // '0110100001100101011011000110110001101111'
```

##### fromBinary() - 二进制解码
```php
$decoded = Str::fromBinary('0110100001100101011011000110110001101111'); // 'hello'
```

##### toHex() - 十六进制编码
```php
$hex = Str::toHex('hello'); // '68656c6c6f'
```

##### fromHex() - 十六进制解码
```php
$decoded = Str::fromHex('68656c6c6f'); // 'hello'
```

#### 字符串哈希

##### md5() - MD5哈希
```php
$md5 = Str::md5('hello'); // '5d41402abc4b2a76b9719d911017c592'
```

##### sha1() - SHA1哈希
```php
$sha1 = Str::sha1('hello'); // 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d'
```

##### sha256() - SHA256哈希
```php
$sha256 = Str::sha256('hello'); // '2cf24dba5fb0a30e26e83b2ac5b9e29e1b161e5c1fa7425e73043362938b9824'
```

##### sha512() - SHA512哈希
```php
$sha512 = Str::sha512('hello'); // '9b71d224bd62f3785d96d46ad3ea3d73319bfbc2890caadae2dff72519673ca72323c3d99ba5c11d7c7acc6e14b8c5da0c4663475c2e5c3adef46f73bcdec043'
```

#### 字符串验证

##### isEmail() - 是否为邮箱
```php
$isEmail = Str::isEmail('user@example.com'); // true
$isEmail = Str::isEmail('invalid-email'); // false
```

##### isUrl() - 是否为URL
```php
$isUrl = Str::isUrl('https://example.com'); // true
$isUrl = Str::isUrl('not-a-url'); // false
```

##### isIp() - 是否为IP地址
```php
$isIp = Str::isIp('192.168.1.1'); // true
$isIp = Str::isIp('not-an-ip'); // false
```

##### isIpv4() - 是否为IPv4地址
```php
$isIpv4 = Str::isIpv4('192.168.1.1'); // true
$isIpv4 = Str::isIpv4('2001:0db8:85a3:0000:0000:8a2e:0370:7334'); // false
```

##### isIpv6() - 是否为IPv6地址
```php
$isIpv6 = Str::isIpv6('2001:0db8:85a3:0000:0000:8a2e:0370:7334'); // true
$isIpv6 = Str::isIpv6('192.168.1.1'); // false
```

##### isPhone() - 是否为手机号
```php
$isPhone = Str::isPhone('13800138000'); // true
$isPhone = Str::isPhone('12345678901'); // false
```

##### isIdCard() - 是否为身份证号
```php
$isIdCard = Str::isIdCard('110101199001011234'); // true
$isIdCard = Str::isIdCard('123456789012345678'); // false
```

##### isBankCard() - 是否为银行卡号
```php
$isBankCard = Str::isBankCard('6222021234567890123'); // true
$isBankCard = Str::isBankCard('1234567890'); // false
```

##### isNumeric() - 是否为数字
```php
$isNumeric = Str::isNumeric('12345'); // true
$isNumeric = Str::isNumeric('abc123'); // false
```

##### isAlpha() - 是否为字母
```php
$isAlpha = Str::isAlpha('hello'); // true
$isAlpha = Str::isAlpha('hello123'); // false
```

##### isAlnum() - 是否为字母数字
```php
$isAlnum = Str::isAlnum('hello123'); // true
$isAlnum = Str::isAlnum('hello world'); // false
```

##### isHex() - 是否为十六进制
```php
$isHex = Str::isHex('1a2b3c'); // true
$isHex = Str::isHex('1g2h3i'); // false
```

##### isBinary() - 是否为二进制
```php
$isBinary = Str::isBinary('01010101'); // true
$isBinary = Str::isBinary('12345678'); // false
```

##### isJson() - 是否为JSON
```php
$isJson = Str::isJson('{"name":"张三"}'); // true
$isJson = Str::isJson('not json'); // false
```

##### isXml() - 是否为XML
```php
$isXml = Str::isXml('<root>hello</root>'); // true
$isXml = Str::isXml('not xml'); // false
```

##### isSerialized() - 是否为序列化数据
```php
$isSerialized = Str::isSerialized('a:1:{i:0;s:5:"hello";}'); // true
$isSerialized = Str::isSerialized('not serialized'); // false
```

##### isBase64() - 是否为Base64
```php
$isBase64 = Str::isBase64('aGVsbG8='); // true
$isBase64 = Str::isBase64('not base64'); // false
```

#### 字符串转换

##### toArray() - 字符串转数组
```php
$array = Str::toArray('hello,world,php', ','); // ['hello', 'world', 'php']
```

##### fromArray() - 数组转字符串
```php
$string = Str::fromArray(['hello', 'world', 'php'], ','); // 'hello,world,php'
```

##### toObject() - 字符串转对象
```php
$object = Str::toObject('{"name":"张三","age":25}'); // stdClass Object ( [name] => 张三 [age] => 25 )
```

##### fromObject() - 对象转字符串
```php
$string = Str::fromObject((object)['name' => '张三', 'age' => 25]); // '{"name":"张三","age":25}'
```

##### toQuery() - 字符串转查询字符串
```php
$query = Str::toQuery(['name' => '张三', 'age' => 25]); // 'name=%E5%BC%A0%E4%B8%89&age=25'
```

##### fromQuery() - 查询字符串转数组
```php
$array = Str::fromQuery('name=%E5%BC%A0%E4%B8%89&age=25'); // ['name' => '张三', 'age' => 25]
```

#### 字符串格式化

##### format() - 字符串格式化
```php
$formatted = Str::format('Hello, %s! You are %d years old.', '张三', 25); // 'Hello, 张三! You are 25 years old.'
```

##### template() - 字符串模板渲染
```php
$rendered = Str::template('Hello, {{name}}! Age: {{age}}', ['name' => '张三', 'age' => 25]); // 'Hello, 张三! Age: 25'
```

##### indent() - 字符串缩进
```php
$indented = Str::indent('hello', 4); // '    hello'
```

##### unindent() - 字符串去除缩进
```php
$unindented = Str::unindent('    hello'); // 'hello'
```

#### 字符串字符操作

##### first() - 获取字符串首字符
```php
$first = Str::first('hello'); // 'h'
```

##### last() - 获取字符串尾字符
```php
$last = Str::last('hello'); // 'o'
```

##### firstN() - 获取字符串前N个字符
```php
$firstN = Str::firstN('hello', 2); // 'he'
```

##### lastN() - 获取字符串后N个字符
```php
$lastN = Str::lastN('hello', 2); // 'lo'
```

##### removeFirst() - 去除首字符
```php
$removed = Str::removeFirst('hello'); // 'ello'
```

##### removeLast() - 去除尾字符
```php
$removed = Str::removeLast('hello'); // 'hell'
```

##### removeFirstN() - 去除前N个字符
```php
$removed = Str::removeFirstN('hello', 2); // 'llo'
```

##### removeLastN() - 去除后N个字符
```php
$removed = Str::removeLastN('hello', 2); // 'hel'
```

#### 字符串统计

##### count() - 统计子串出现次数
```php
$count = Str::count('hello world world', 'world'); // 2
```

##### wordCount() - 统计单词数
```php
$wordCount = Str::wordCount('hello world php'); // 3
```

##### charCount() - 统计字符数
```php
$charCount = Str::charCount('hello'); // 5
```

##### byteLength() - 统计字节长度
```php
$byteLength = Str::byteLength('你好'); // 6（UTF-8编码）
```

#### 字符串安全

##### escapeHtml() - 转义HTML特殊字符
```php
$escaped = Str::escapeHtml('<div>hello</div>'); // '&lt;div&gt;hello&lt;/div&gt;'
```

##### escapeSql() - 转义SQL特殊字符
```php
$escaped = Str::escapeSql("O'Reilly"); // "O\'Reilly"
```

##### escapeJs() - 转义JavaScript特殊字符
```php
$escaped = Str::escapeJs("It's a test"); // "It\'s a test"
```

##### escapeRegex() - 转义正则表达式特殊字符
```php
$escaped = Str::escapeRegex('hello.world'); // 'hello\.world'
```

#### 字符串比较

##### compare() - 字符串比较
```php
$compare = Str::compare('hello', 'hello'); // 0（相等）
$compare = Str::compare('hello', 'world'); // -15（不相等）
```

##### similarity() - 字符串相似度
```php
$similarity = Str::similarity('hello', 'hello'); // 1.0（完全相同）
$similarity = Str::similarity('hello', 'world'); // 0.2（相似度）
```

##### distance() - 字符串编辑距离
```php
$distance = Str::distance('hello', 'hello'); // 0（相同）
$distance = Str::distance('hello', 'world'); // 4（编辑距离）
```

## 时间处理模块

### 特性
- ✅ 时间格式化
- ✅ 时间计算（加法、减法、差值）
- ✅ 常用时间获取（当前时间、今天、昨天、明天）
- ✅ 时区支持
- ✅ 人性化时间显示、日期范围计算

### 核心方法
| 方法名 | 功能描述 | 调用示例 |
|--------|----------|----------|
| [`format()`](#timeformat---格式化时间) | 格式化时间 | `Time::format(time(), 'Y-m-d')` |
| [`now()`](#timenow---获取当前时间) | 获取当前时间 | `Time::now()` |
| [`today()`](#timetoday---获取今天日期) | 获取今天日期 | `Time::today()` |
| [`yesterday()`](#timeyesterday---获取昨天日期) | 获取昨天日期 | `Time::yesterday()` |
| [`tomorrow()`](#timetomorrow---获取明天日期) | 获取明天日期 | `Time::tomorrow()` |
| [`add()`](#timeadd---时间加法) | 时间加法 | `Time::add(time(), 3600)` |
| [`sub()`](#timesub---时间减法) | 时间减法 | `Time::sub(time(), 3600)` |
| [`diff()`](#timediff---时间差) | 时间差 | `Time::diff(time(), time() - 3600)` |
| [`diffForHumans()`](#timediffforhumans---人性化时间差) | 人性化时间差 | `Time::diffForHumans(time() - 3600)` |
| [`weekStart()`](#timeweekstart---获取本周开始时间) | 本周开始时间 | `Time::weekStart()` |
| [`weekEnd()`](#timeweekend---获取本周结束时间) | 本周结束时间 | `Time::weekEnd()` |
| [`monthStart()`](#timemonthstart---获取本月开始时间) | 本月开始时间 | `Time::monthStart()` |
| [`monthEnd()`](#timemonthend---获取本月结束时间) | 本月结束时间 | `Time::monthEnd()` |

### 使用示例

#### 时间格式化

##### format() - 格式化时间
```php
$formatted = Time::format(time(), 'Y-m-d H:i:s'); // '2025-12-26 12:00:00'
$formatted = Time::format(time(), 'Y年m月d日'); // '2025年12月26日'
$formatted = Time::format(1735200000, 'Y-m-d'); // '2025-12-26'
```

##### now() - 获取当前时间
```php
$now = Time::now(); // '2025-12-26 12:00:00'
$now = Time::now('Y-m-d'); // '2025-12-26'
$now = Time::now('H:i:s'); // '12:00:00'
```

##### today() - 获取今天日期
```php
$today = Time::today(); // '2025-12-26'
$today = Time::today('Y-m-d H:i:s'); // '2025-12-26 00:00:00'
```

##### yesterday() - 获取昨天日期
```php
$yesterday = Time::yesterday(); // '2025-12-25'
$yesterday = Time::yesterday('Y-m-d H:i:s'); // '2025-12-25 00:00:00'
```

##### tomorrow() - 获取明天日期
```php
$tomorrow = Time::tomorrow(); // '2025-12-27'
$tomorrow = Time::tomorrow('Y-m-d H:i:s'); // '2025-12-27 00:00:00'
```

#### 时间计算
```php
$timestamp = time();
```

##### add() - 时间加法
```php
$newTime = Time::add($timestamp, 3600); // 加1小时
$newTime = Time::add($timestamp, 86400); // 加1天
$newTime = Time::add($timestamp, 604800); // 加1周
```

##### sub() - 时间减法
```php
$newTime = Time::sub($timestamp, 3600); // 减1小时
$newTime = Time::sub($timestamp, 86400); // 减1天
$newTime = Time::sub($timestamp, 604800); // 减1周
```

##### diff() - 时间差
```php
$diff = Time::diff(time(), time() - 3600); // 3600（秒）
$diff = Time::diff(time() - 86400, time()); // 86400（秒）
```

##### diffForHumans() - 人性化时间差
```php
$human = Time::diffForHumans(time() - 60); // '1分钟前'
$human = Time::diffForHumans(time() - 3600); // '1小时前'
$human = Time::diffForHumans(time() - 86400); // '1天前'
$human = Time::diffForHumans(time() - 2592000); // '1个月前'
$human = Time::diffForHumans(time() - 31536000); // '1年前'
$human = Time::diffForHumans(time() + 3600); // '1小时后'
$human = Time::diffForHumans(time() + 86400); // '1天后'
// 指定基准时间的人性化时间差
$human = Time::diffForHumans(time() - 3600, time() - 7200); // '1小时前'
```

#### 周日期范围

##### weekStart() - 获取本周开始时间
```php
$weekStart = Time::weekStart(); // 本周一00:00:00的时间戳
$weekStart = Time::weekStart(time()); // 指定时间所在周的开始时间
$weekStartFormatted = Time::format(Time::weekStart(), 'Y-m-d H:i:s'); // '2025-12-22 00:00:00'
```

##### weekEnd() - 获取本周结束时间
```php
$weekEnd = Time::weekEnd(); // 本周日23:59:59的时间戳
$weekEnd = Time::weekEnd(time()); // 指定时间所在周的结束时间
$weekEndFormatted = Time::format(Time::weekEnd(), 'Y-m-d H:i:s'); // '2025-12-28 23:59:59'
```

##### lastWeekStart() - 获取上周开始时间
```php
$lastWeekStart = Time::lastWeekStart(); // 上周一00:00:00的时间戳
$lastWeekStartFormatted = Time::format(Time::lastWeekStart(), 'Y-m-d H:i:s'); // '2025-12-15 00:00:00'
```

##### lastWeekEnd() - 获取上周结束时间
```php
$lastWeekEnd = Time::lastWeekEnd(); // 上周日23:59:59的时间戳
$lastWeekEndFormatted = Time::format(Time::lastWeekEnd(), 'Y-m-d H:i:s'); // '2025-12-21 23:59:59'
```

#### 月日期范围

##### monthStart() - 获取本月开始时间
```php
$monthStart = Time::monthStart(); // 本月1日00:00:00的时间戳
$monthStart = Time::monthStart(time()); // 指定时间所在月的开始时间
$monthStartFormatted = Time::format(Time::monthStart(), 'Y-m-d H:i:s'); // '2025-12-01 00:00:00'
```

##### monthEnd() - 获取本月结束时间
```php
$monthEnd = Time::monthEnd(); // 本月最后一天23:59:59的时间戳
$monthEnd = Time::monthEnd(time()); // 指定时间所在月的结束时间
$monthEndFormatted = Time::format(Time::monthEnd(), 'Y-m-d H:i:s'); // '2025-12-31 23:59:59'
```

##### lastMonthStart() - 获取上月开始时间
```php
$lastMonthStart = Time::lastMonthStart(); // 上月1日00:00:00的时间戳
$lastMonthStartFormatted = Time::format(Time::lastMonthStart(), 'Y-m-d H:i:s'); // '2025-11-01 00:00:00'
```

##### lastMonthEnd() - 获取上月结束时间
```php
$lastMonthEnd = Time::lastMonthEnd(); // 上月最后一天23:59:59的时间戳
$lastMonthEndFormatted = Time::format(Time::lastMonthEnd(), 'Y-m-d H:i:s'); // '2025-11-30 23:59:59'
```

#### 年日期范围

##### yearStart() - 获取本年开始时间
```php
$yearStart = Time::yearStart(); // 本年1月1日00:00:00的时间戳
$yearStart = Time::yearStart(time()); // 指定时间所在年的开始时间
$yearStartFormatted = Time::format(Time::yearStart(), 'Y-m-d H:i:s'); // '2025-01-01 00:00:00'
```

##### yearEnd() - 获取本年结束时间
```php
$yearEnd = Time::yearEnd(); // 本年12月31日23:59:59的时间戳
$yearEnd = Time::yearEnd(time()); // 指定时间所在年的结束时间
$yearEndFormatted = Time::format(Time::yearEnd(), 'Y-m-d H:i:s'); // '2025-12-31 23:59:59'
```

##### lastYearStart() - 获取上年开始时间
```php
$lastYearStart = Time::lastYearStart(); // 上年1月1日00:00:00的时间戳
$lastYearStartFormatted = Time::format(Time::lastYearStart(), 'Y-m-d H:i:s'); // '2024-01-01 00:00:00'
```

##### lastYearEnd() - 获取上年结束时间
```php
$lastYearEnd = Time::lastYearEnd(); // 上年12月31日23:59:59的时间戳
$lastYearEndFormatted = Time::format(Time::lastYearEnd(), 'Y-m-d H:i:s'); // '2024-12-31 23:59:59'
```

#### 时间判断

```php
$timestamp = time();
```

##### between() - 判断是否在某个时间区间内
```php
$inRange = Time::between($timestamp, time() - 3600, time() + 3600); // true
$inRange = Time::between(time() - 7200, time() - 3600, time()); // false
```

##### isToday() - 判断是否是今天
```php
$isToday = Time::isToday($timestamp); // true
$isToday = Time::isToday(time() - 86400); // false
```

##### isYesterday() - 判断是否是昨天
```php
$isYesterday = Time::isYesterday(time() - 86400); // true
$isYesterday = Time::isYesterday(time()); // false
```

##### isTomorrow() - 判断是否是明天
```php
$isTomorrow = Time::isTomorrow(time() + 86400); // true
$isTomorrow = Time::isTomorrow(time()); // false
```

##### isThisWeek() - 判断是否是本周
```php
$isThisWeek = Time::isThisWeek($timestamp); // true
$isThisWeek = Time::isThisWeek(time() - 604800); // false
```

##### isThisMonth() - 判断是否是本月
```php
$isThisMonth = Time::isThisMonth($timestamp); // true
$isThisMonth = Time::isThisMonth(strtotime('2025-11-01')); // false
```

##### isThisYear() - 判断是否是本年
```php
$isThisYear = Time::isThisYear($timestamp); // true
$isThisYear = Time::isThisYear(strtotime('2024-01-01')); // false
```

#### 日期信息获取

##### daysInMonth() - 获取某个月的天数
```php
$days = Time::daysInMonth(12); // 31（12月有31天）
$days = Time::daysInMonth(2, 2024); // 29（2024年2月有29天，闰年）
$days = Time::daysInMonth(2, 2023); // 28（2023年2月有28天，平年）
```

##### dayOfWeek() - 获取某天是周几
```php
$weekday = Time::dayOfWeek(time()); // 0-6（0表示周日，1表示周一，以此类推）
$weekday = Time::dayOfWeek(strtotime('2025-12-26')); // 5（周五）
```

##### dayOfWeekName() - 获取某天是周几（中文名称）
```php
$weekdayName = Time::dayOfWeekName(time()); // '周五'
$weekdayName = Time::dayOfWeekName(strtotime('2025-12-28')); // '周日'
```

##### dayOfYear() - 获取某天是本年第几天
```php
$dayOfYear = Time::dayOfYear(time()); // 360（2025年第360天）
$dayOfYear = Time::dayOfYear(strtotime('2025-01-01')); // 1（第1天）
```

##### weekOfYear() - 获取某天是本年第几周
```php
$weekOfYear = Time::weekOfYear(time()); // 52（第52周）
$weekOfYear = Time::weekOfYear(strtotime('2025-01-01')); // 1（第1周）
```

#### 年龄计算

##### age() - 计算年龄
```php
$age = Time::age('1990-01-01'); // 35（假设当前是2025年）
$age = Time::age('2000-12-31'); // 24（假设当前是2025年）
$age = Time::age('2010-06-15'); // 15（假设当前是2025年）
```

#### 时间戳转换

##### toTimestamp() - 时间字符串转时间戳
```php
$timestamp = Time::toTimestamp('2025-12-26 12:00:00'); // 1735200000
$timestamp = Time::toTimestamp('2025-12-26'); // 1735152000
$timestamp = Time::toTimestamp('now'); // 当前时间戳
$timestamp = Time::toTimestamp('+1 day'); // 明天同一时间的时间戳
```

##### toMillisecond() - 时间戳转毫秒
```php
$millisecond = Time::toMillisecond(time()); // 1735200000000
$millisecond = Time::toMillisecond(1735200000); // 1735200000000
```

##### fromMillisecond() - 毫秒转时间戳
```php
$timestamp = Time::fromMillisecond(1735200000000); // 1735200000
```

##### millisecond() - 获取当前毫秒时间戳
```php
$millisecond = Time::millisecond(); // 当前时间的毫秒时间戳
```

##### microsecond() - 获取当前微秒时间戳
```php
$microsecond = Time::microsecond(); // 当前时间的微秒时间戳
```

##### microtime() - 获取当前时间戳（带微秒）
```php
$microtime = Time::microtime(); // 1735200000.123456
```

#### 时区操作

##### timezone() - 获取当前时区
```php
$timezone = Time::timezone(); // 'Asia/Shanghai'（或其他时区）
```

##### setTimezone() - 设置时区
```php
$success = Time::setTimezone('UTC'); // true
$success = Time::setTimezone('America/New_York'); // true

// 设置时区后获取时间
Time::setTimezone('UTC');
$utcTime = Time::now(); // UTC时间

Time::setTimezone('Asia/Shanghai');
$shanghaiTime = Time::now(); // 上海时间
```

### 实际应用场景

```php
// 订单创建时间显示
$createdAt = time() - 3600; // 1小时前创建
$displayTime = Time::diffForHumans($createdAt); // '1小时前'

// 数据统计时间范围
$weekStart = Time::weekStart();
$weekEnd = Time::weekEnd();
// 查询本周数据：WHERE created_at >= $weekStart AND created_at <= $weekEnd

// 用户生日计算
$birthday = '1990-05-15';
$age = Time::age($birthday); // 35岁

// 活动倒计时
$endTime = strtotime('2025-12-31 23:59:59');
$diff = Time::diff(time(), $endTime); // 距离结束的秒数

// 日程安排
$today = Time::today();
$tomorrow = Time::tomorrow();
$weekStart = Time::weekStart();
$weekEnd = Time::weekEnd();

// 数据归档
$lastMonthStart = Time::lastMonthStart();
$lastMonthEnd = Time::lastMonthEnd();
// 归档上月数据：WHERE created_at >= $lastMonthStart AND created_at <= $lastMonthEnd

// 报表生成
$yearStart = Time::yearStart();
$yearEnd = Time::yearEnd();
// 生成本年报表：WHERE created_at >= $yearStart AND created_at <= $yearEnd

// 定时任务检查
if (Time::isToday($taskTime)) {
    // 执行今天的任务
}

// 工作日判断
$weekday = Time::dayOfWeek(time());
if ($weekday >= 1 && $weekday <= 5) {
    // 周一到周五，工作日
} else {
    // 周六周日，休息日
}

// 高精度时间测量
$startTime = Time::microsecond();
// 执行一些代码
$endTime = Time::microsecond();
$duration = $endTime - $startTime; // 微秒
```

## 数学计算处理模块

### 特性
- ✅ 高精度计算（使用bcmath扩展）
- ✅ 支持金融计算（折扣、税费、利息）
- ✅ 支持统计分析（平均数、中位数、标准差）
- ✅ 支持幂运算、平方根等数学操作
- ✅ 结果保留任意小数位数
- ✅ 兼容PHP8.3+特性

### 核心方法
| 方法名 | 功能描述 | 调用示例 |
|--------|----------|----------|
| [`add()`](#mathadd---高精度加法) | 高精度加法 | `Math::add('1.1', '2.2')` |
| [`sub()`](#mathsub---高精度减法) | 高精度减法 | `Math::sub('3.3', '1.1')` |
| [`mul()`](#mathmul---高精度乘法) | 高精度乘法 | `Math::mul('2.5', '4')` |
| [`div()`](#mathdiv---高精度除法) | 高精度除法 | `Math::div('10', '3')` |
| [`avg()`](#mathavg---多维数组求平均值) | 平均数 | `Math::avg([1, 2, 3, 4, 5])` |
| [`median()`](#mathmedian---中位数) | 中位数 | `Math::median([1, 2, 3, 4, 5])` |
| [`discount()`](#mathdiscount---折扣计算) | 计算折扣价 | `Math::discount('100', '0.2')` |
| [`tax()`](#mathtax---税费计算) | 计算税额 | `Math::tax('100', '0.13')` |

### 使用示例

#### 基础运算

##### add() - 高精度加法
```php
$sum = Math::add(0.1, 0.2); // 0.3（而不是0.30000000000000004）
$sum = Math::add('1.1', '2.2', 2); // 3.30（保留2位小数）
```

##### sub() - 高精度减法
```php
$diff = Math::sub(0.3, 0.1); // 0.2
$diff = Math::sub('5.5', '2.2', 2); // 3.30
```

##### mul() - 高精度乘法
```php
$product = Math::mul(0.1, 0.2); // 0.02
$product = Math::mul('1.5', '2.5', 2); // 3.75
```

##### div() - 高精度除法
```php
$quotient = Math::div(0.3, 0.1); // 3
$quotient = Math::div('10', '3', 2); // 3.33
```

##### mod() - 取模运算
```php
$mod = Math::mod(10, 3); // 1
$mod = Math::mod('10.5', '3'); // 1.5
```

##### pow() - 幂运算
```php
$pow = Math::pow(2, 10); // 1024
$pow = Math::pow('2.5', 3, 2); // 15.62
```

##### sqrt() - 平方根运算
```php
$sqrt = Math::sqrt(16); // 4
$sqrt = Math::sqrt('2', 4); // 1.4142
```

#### 取整运算

##### round() - 四舍五入
```php
$rounded = Math::round(3.14159, 2); // 3.14
$rounded = Math::round(3.5, 0); // 4
```

##### ceil() - 向上取整
```php
$ceil = Math::ceil(3.2); // 4
$ceil = Math::ceil(3.8, 1); // 3.8
$ceil = Math::ceil('3.21', 1); // 3.3
```

##### floor() - 向下取整
```php
$floor = Math::floor(3.8); // 3
$floor = Math::floor(3.2, 1); // 3.2
$floor = Math::floor('3.89', 1); // 3.8
```

#### 比较运算

##### compare() - 比较两个数的大小
```php
$result = Math::compare(5, 3); // 1（5 > 3）
$result = Math::compare(3, 5); // -1（3 < 5）
$result = Math::compare(5, 5); // 0（相等）
```

##### equal() - 判断两个数是否相等
```php
$equal = Math::equal(0.1 + 0.2, 0.3); // true（解决浮点数比较问题）
$equal = Math::equal('1.000', '1.00', 2); // true（保留2位小数比较）
```

#### 格式化

##### format() - 格式化数字
```php
$formatted = Math::format(1234567.89, 2, true); // 1,234,567.89（带千分位）
$formatted = Math::format(1234567.89, 2, false); // 1234567.89（不带千分位）
$formatted = Math::format('1234567.89123', 3, true); // 1,234,567.891
```

#### 三角函数

##### sin() - 正弦函数
```php
$sin = Math::sin(Math::deg2rad(30)); // 0.5（30度的正弦值）
$sin = Math::sin(3.14159 / 2); // 1（π/2的正弦值）
```

##### cos() - 余弦函数
```php
$cos = Math::cos(Math::deg2rad(60)); // 0.5（60度的余弦值）
$cos = Math::cos(0); // 1（0度的余弦值）
```

##### tan() - 正切函数
```php
$tan = Math::tan(Math::deg2rad(45)); // 1（45度的正切值）
$tan = Math::tan(3.14159 / 4); // 1（π/4的正切值）
```

##### asin() - 反正弦函数
```php
$asin = Math::asin(1); // 1.5708（π/2）
$asin = Math::asin(0.5); // 0.5236（π/6）
```

##### acos() - 反余弦函数
```php
$acos = Math::acos(0); // 1.5708（π/2）
$acos = Math::acos(0.5); // 1.0472（π/3）
```

##### atan() - 反正切函数
```php
$atan = Math::atan(1); // 0.7854（π/4）
$atan = Math::atan(0); // 0
```

#### 对数运算

##### ln() - 自然对数（以e为底）
```php
$ln = Math::ln(Math::exp(1)); // 1
$ln = Math::ln(2.71828); // 1
```

##### log10() - 常用对数（以10为底）
```php
$log10 = Math::log10(100); // 2
$log10 = Math::log10(1000); // 3
```

##### log() - 自定义底数对数
```php
$log = Math::log(8, 2); // 3（2的3次方等于8）
$log = Math::log(100, 10); // 2（10的2次方等于100）
```

#### 角度转换

##### rad2deg() - 弧度转角度
```php
$deg = Math::rad2deg(3.14159); // 180（π弧度 = 180度）
$deg = Math::rad2deg(1.5708); // 90（π/2弧度 = 90度）
```

##### deg2rad() - 角度转弧度
```php
$rad = Math::deg2rad(180); // 3.14159（180度 = π弧度）
$rad = Math::deg2rad(90); // 1.5708（90度 = π/2弧度）
```

#### 数值操作

##### abs() - 绝对值
```php
$abs = Math::abs(-10); // 10
$abs = Math::abs(10); // 10
$abs = Math::abs('-5.5'); // 5.5
```

##### factorial() - 阶乘
```php
$factorial = Math::factorial(5); // 120（5! = 5×4×3×2×1）
$factorial = Math::factorial(0); // 1（0! = 1）
```

##### gcd() - 最大公约数
```php
$gcd = Math::gcd(12, 18); // 6
$gcd = Math::gcd(24, 36); // 12
```

##### lcm() - 最小公倍数
```php
$lcm = Math::lcm(4, 6); // 12
$lcm = Math::lcm(3, 5); // 15
```

#### 金融计算

##### percentage() - 百分比计算
```php
$percentage = Math::percentage(25, 100); // 25（25占100的25%）
$percentage = Math::percentage('30', '150', 2); // 20.00
```

##### discount() - 折扣计算
```php
$discounted = Math::discount(100, 0.8); // 80（打8折）
$discounted = Math::discount('200', '0.7', 2); // 140.00（打7折）
```

##### tax() - 税费计算
```php
$tax = Math::tax(100, 0.1); // 10（100的10%税额）
$tax = Math::tax('500', '0.13', 2); // 65.00（500的13%税额）
```

##### taxIncluded() - 含税金额计算
```php
$taxIncluded = Math::taxIncluded(100, 0.1); // 110（100 + 10%税）
$taxIncluded = Math::taxIncluded('500', '0.13', 2); // 565.00
```

##### taxExcluded() - 不含税金额计算
```php
$taxExcluded = Math::taxExcluded(110, 0.1); // 100（110 / 1.1）
$taxExcluded = Math::taxExcluded('565', '0.13', 2); // 500.00
```

##### simpleInterest() - 简单利息计算
```php
$simpleInterest = Math::simpleInterest(1000, 0.05, 2); // 100（1000本金，5%年利率，2年）
$simpleInterest = Math::simpleInterest('5000', '0.04', 3, 2); // 600.00
```

##### compoundInterest() - 复利计算
```php
$compoundInterest = Math::compoundInterest(1000, 0.05, 2); // 1102.5（1000本金，5%年利率，2年复利）
$compoundInterest = Math::compoundInterest('5000', '0.04', 3, 2); // 5624.32
```

#### 随机数生成

##### random() - 生成指定范围内的随机数
```php
$random = Math::random(1, 100); // 1-100之间的随机整数
$random = Math::random('1.5', '5.5', 2); // 1.50-5.50之间的随机数（保留2位小数）
```

#### 范围检查

##### inRange() - 数值范围检查
```php
$inRange = Math::inRange(5, 1, 10); // true（5在1-10范围内）
$inRange = Math::inRange(15, 1, 10); // false（15不在1-10范围内）
```

##### clamp() - 限制数值范围
```php
$clamped = Math::clamp(5, 1, 10); // 5（在范围内，保持不变）
$clamped = Math::clamp(15, 1, 10); // 10（超出最大值，限制为10）
$clamped = Math::clamp(-5, 1, 10); // 1（小于最小值，限制为1）
$clamped = Math::clamp('5.5', '1.0', '10.0', 1); // 5.5
```

#### 数值判断

##### isPositive() - 判断是否为正数
```php
$isPositive = Math::isPositive(10); // true
$isPositive = Math::isPositive(-5); // false
$isPositive = Math::isPositive(0); // false
```

##### isNegative() - 判断是否为负数
```php
$isNegative = Math::isNegative(-5); // true
$isNegative = Math::isNegative(10); // false
$isNegative = Math::isNegative(0); // false
```

##### isZero() - 判断是否为零
```php
$isZero = Math::isZero(0); // true
$isZero = Math::isZero(0.0000000001, 10); // true（保留10位小数比较）
$isZero = Math::isZero(1); // false
```

##### isEven() - 判断是否为偶数
```php
$isEven = Math::isEven(4); // true
$isEven = Math::isEven(5); // false
```

##### isOdd() - 判断是否为奇数
```php
$isOdd = Math::isOdd(5); // true
$isOdd = Math::isOdd(4); // false
```

##### isPrime() - 判断是否为质数
```php
$isPrime = Math::isPrime(7); // true
$isPrime = Math::isPrime(4); // false
$isPrime = Math::isPrime(2); // true
$isPrime = Math::isPrime(1); // false
```

##### isValid() - 判断数值是否有效
```php
$isValid = Math::isValid(123); // true
$isValid = Math::isValid('123.45'); // true
$isValid = Math::isValid('abc'); // false
$isValid = Math::isValid(INF); // false（无穷大）
$isValid = Math::isValid(NAN); // false（非数字）
```

#### 插值运算

##### lerp() - 线性插值
```php
$lerp = Math::lerp(0, 10, 0.5); // 5（0和10的中点）
$lerp = Math::lerp(0, 10, 0.25); // 2.5（0和10的25%位置）
$lerp = Math::lerp('0', '100', '0.75', 1); // 75.0
```

#### 统计分析

##### average() - 平均值计算
```php
$avg = Math::average([1, 2, 3, 4, 5]); // 3
$avg = Math::average([1.5, 2.5, 3.5], 2); // 2.50
```

##### median() - 中位数计算
```php
$median = Math::median([1, 2, 3, 4, 5]); // 3
$median = Math::median([1, 2, 3, 4]); // 2.5（2和3的平均值）
$median = Math::median(['1.5', '2.5', '3.5'], 2); // 2.50
```

##### mode() - 众数计算
```php
$mode = Math::mode([1, 2, 2, 3, 3, 3]); // 3（出现次数最多）
$mode = Math::mode([1, 2, 3]); // 1（多个众数时返回第一个）
```

##### standardDeviation() - 标准差计算
```php
$stdDev = Math::standardDeviation([1, 2, 3, 4, 5]); // 1.414
$stdDev = Math::standardDeviation([10, 20, 30], 2); // 10.00
```

### 实际应用场景

```php
// 电商订单金额计算
$subtotal = Math::add('99.99', '49.99'); // 149.98（商品小计）
$discount = Math::discount($subtotal, '0.9'); // 134.98（打9折）
$tax = Math::tax($discount, '0.13'); // 17.55（13%税）
$total = Math::add($discount, $tax, 2); // 152.53（总金额）

// 贷款利息计算
$principal = 100000; // 本金10万
$rate = 0.05; // 年利率5%
$years = 5; // 5年
$simpleInterest = Math::simpleInterest($principal, $rate, $years); // 25000（简单利息）
$compoundInterest = Math::compoundInterest($principal, $rate, $years); // 27628.16（复利）

// 数据分析
$scores = [85, 92, 78, 90, 88, 95, 82];
$avg = Math::average($scores, 2); // 87.14（平均分）
$median = Math::median($scores, 2); // 88.00（中位数）
$stdDev = Math::standardDeviation($scores, 2); // 5.67（标准差）

// 价格范围检查
$price = 99.99;
$minPrice = 50;
$maxPrice = 100;
if (Math::inRange($price, $minPrice, $maxPrice)) {
    echo '价格在合理范围内';
}

// 数值格式化显示
$amount = 1234567.89123;
$formatted = Math::format($amount, 2, true); // 1,234,567.89
```

## 地理位置处理模块

### 特性
- ✅ 使用Haversine公式计算距离
- ✅ 支持多种距离单位（公里、英里、米）
- ✅ 支持方位角和中点计算

### 核心方法
| 方法名 | 功能描述 | 调用示例 |
|--------|----------|----------|
| [`distance()`](#geodistance---计算两个坐标之间的距离) | 计算两点距离 | `Geo::distance(39.9042, 116.4074, 31.2304, 121.4737)` |
| [`isValid()`](#geoisValid---坐标验证) | 验证坐标 | `Geo::isValid(39.9042, 116.4074)` |
| [`bearing()`](#geobearing---计算方位角) | 计算方位角 | `Geo::bearing(39.9042, 116.4074, 31.2304, 121.4737)` |
| [`midpoint()`](#geomidpoint---计算中点坐标) | 计算中点坐标 | `Geo::midpoint(39.9042, 116.4074, 31.2304, 121.4737)` |

### 使用示例
##### distance() - 计算两个坐标之间的距离
```php
$distance = Geo::distance(39.9042, 116.4074, 31.2304, 121.4737, 'km'); // 北京到上海的距离，约1067公里
```

##### isValid() - 坐标验证
```php
$valid = Geo::isValidCoordinate(39.9042, 116.4074); // true
```

##### midpoint() - 计算两个坐标之间的中点
```php
$midpoint = Geo::midpoint(39.9042, 116.4074, 31.2304, 121.4737); // [35.593729492520936,119.07801023725797]
```

##### bearing() - 计算两个坐标之间的方位角
```php
$bearing = Geo::bearing(39.9042, 116.4074, 31.2304, 121.4737); // 153.0726752205012
```

##### toRadians() - 将角度转换为弧度
```php
$bearing = Geo::toRadians(90); // 1.5707963267948966
```

##### toDegrees() - 将弧度转换为角度
```php
$bearing = Geo::toDegrees(1.5707963267948966); // 90
```

##### toDMS() - 将十进制度数转换为度分秒（DMS）
```php
$bearing = Geo::toDMS(90, true); // [90,0,0,"N"]
$bearing = Geo::toDMS(90, false); // [90,0,0,"E"]
```

##### toDecimal() - 将度分秒（DMS）转换为十进制度数
```php
$bearing = Geo::toDecimal(90,0,0,"N"); // 90
```

##### gcj02ToBd09() - GCJ02坐标转BD09坐标
```php
$bd01 = Geo::gcj02ToBd09(39.9042, 116.4074); // [39.9105, 116.4138]
```

##### bd09ToGcj02() - BD09坐标转GCJ02坐标
```php
$gcj01 = Geo::bd09ToGcj02(39.9105, 116.4138); // [39.9042, 116.4074]
```

##### wgs84ToGcj02() - WGS84坐标转GCJ02坐标（中国火星坐标系）
```php
$gcj02 = Geo::wgs84ToGcj02(39.9042, 116.4074); // [39.9056, 116.4136]
```

##### gcj02ToWgs84() - GCJ02坐标转WGS84坐标
```php
$wgs01 = Geo::gcj02ToWgs84(39.9056, 116.4136); // [39.9042, 116.4074]
```

##### wgs84ToBd09() - WGS84坐标转BD09坐标
```php
$bd02 = Geo::wgs84ToBd09(39.9042, 116.4074); // [39.9119, 116.4200]
```

##### bd09ToWgs84() - BD09坐标转WGS84坐标
```php
$wgs02 = Geo::bd09ToWgs84(39.9119, 116.4200); // [39.9042, 116.4074]
```

## IP地址处理模块

### 特性
- ✅ 获取IP地址版本
- ✅ 验证IP地址格式
- ✅ 获取IP地址位置信息

### 核心方法
| 方法名 | 功能描述 | 调用示例                                                  |
|--------|----------|-------------------------------------------------------|
| `getLocation()` | 获取IP地址位置信息 | `Ip::getLocation(192.168.10.88)` |
| `isValid()` | 验证IP地址格式 | `Ip::isValid(192.168.10.88)`                           |
| `isPrivate()` | 检查IP地址是否为私有/内部地址 | `Ip::isPrivate(192.168.10.88)`  |
| `getVersion()` | 获取IP地址版本 | `Ip::getVersion(192.168.10.88)` |

### 使用示例

##### getRealIp() - 获取真实客户端IP地址
```php
$ip = Ip::getRealIp();
```

##### isValid() - 验证IP地址格式是否有效
```php
$valid = Ip::isValid('192.168.1.1'); // true
```

##### isPrivate() - 检查IP地址是否为私有/内部地址
```php
$private = Ip::isPrivate('192.168.1.1'); // true
```

##### getVersion() - 获取IP地址版本
```php
$ip = Ip::isPrivate();
```

##### toLong() - 将IP地址转换为长整数
```php
$long = Ip::toLong('192.168.1.1'); // 3232235777
```

##### fromLong() - 将长整数转换为IP地址
```php
$ipStr = Ip::toString(3232235777); // '192.168.1.1'
```

##### getLocation() - 获取IP地址位置信息
```php
$local = Ip::getLocation('192.168.1.1');
```

##### isFromCountry() - 检查IP地址是否来自特定国家
```php
$ip = Ip::isFromCountry('192.168.1.1', 'CN');
```

##### getType() - 获取IP地址类型
```php
$type = Ip::getType('192.168.1.1');
```

## 代码生成模块

### 特性
- ✅ UUID生成
- ✅ 订单号生成（时间戳+随机数）
- ✅ 邀请码生成（自定义长度和字符集）
- ✅ URL安全码生成（Base64URL编码）
- ✅ 注册码生成（支持分段显示）
- ✅ 线程安全的随机数生成（random_int）

### 核心方法

| 方法名              | 功能描述     | 调用示例                                                            |
|------------------|----------|-----------------------------------------------------------------|
| `uuid()`         | 生成UUID   | `Crypto::uuid()`                                                |
| `orderNo()`      | 生成订单号    | `Crypto::orderNo('')`                                           |
| `inviteCode()`   | 生成邀请码    | `Crypto::inviteCode(6, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')` |
| `urlSafeCode()`  | 生成URL安全码 | `Crypto::urlSafeCode(16)`                                       |
| `registerCode()` | 生成注册码    | `Crypto::registerCode(16, 4, '-')`                              |

### 使用示例

##### uuid() - 生成uuid
```php
$uuid = Generate::uuid();
```

##### orderNo() - 生成订单号
```php
// 生成不带前缀的订单号
$orderNo = Generate::orderNo(); // 202512251200001234

// 生成带前缀的订单号
$orderNo = Generate::orderNo('ORD'); // ORD202507261234561234
```

##### inviteCode() - 生成邀请码
```php
$inviteCode = Generate::inviteCode(8); // 8位邀请码
```

##### urlSafeCode() - 生成URL安全码
```php
$urlSafe = Generate::urlSafeCode(16); // URL安全的随机码
```

##### registerCode() - 生成注册码
```php
$registerCode = Generate::registerCode(12, 4); // 12位注册码，每4位分隔
```

## 加解密处理模块

### 特性
- ✅ MD5加密（支持加盐）
- ✅ 密码哈希（基于PHP原生password_hash）
- ✅ SSL对称加密（AES-256-GCM）
- ✅ HMAC签名（支持多种算法）
- ✅ 双模式调用：实例调用 + 静态调用
- ✅ 符合安全最佳实践
- ✅ PHP8.3+只读属性确保配置安全

### 核心方法
| 方法名                | 功能描述        | 调用示例                                      |
|--------------------|-------------|-------------------------------------------|
| `md5()`            | MD5加密（支持加盐） | `Crypto::md5('123456', 'salt')`           |
| `passwordHash()`   | 密码哈希        | `Crypto::passwordHash('123456')`          |
| `passwordVerify()` | 密码验证        | `Crypto::passwordVerify('123456', $hash)` |
| `sslEncrypt()`     | SSL对称加密     | `Crypto::sslEncrypt('data', $key)`        |
| `sslDecrypt()`     | SSL对称解密     | `Crypto::sslDecrypt($encrypted, $key)`    |

### 使用示例

##### Crypto - 加密引擎说明
```php
use Cdyun\PhpTool\Crypto;

// Sodium引擎 - 推荐使用（性能更高，安全性更强）
// 需要PHP扩展：sodium
$crypto = new Crypto('your_key', Crypto::ENGINE_SODIUM);

// OpenSSL引擎 - 通用选择
// 需要PHP扩展：openssl
$crypto = new Crypto('your_key', Crypto::ENGINE_OPENSSL);

// 自动选择引擎 - 自动选择最优引擎
$crypto = new Crypto('your_key', Crypto::ENGINE_AUTO);
```

##### Crypto - 加密模式说明
```php
use Cdyun\PhpTool\Crypto;

// 标准模式 - Base64编码
$crypto = new Crypto('your_key', Crypto::ENGINE_AUTO, Crypto::MODE_STANDARD);
$encrypted = $crypto->encrypt('敏感数据');
// 输出示例: VEhJUz1mYWxzZVZlcnNpb249MS4wJmtleT1zZWN1cmVfazEyMw==

// URL安全模式 - Base64URL编码（无=号，适合URL传输）
$crypto = new Crypto('your_key', Crypto::ENGINE_AUTO, Crypto::MODE_URL_SAFE);
$encrypted = $crypto->encrypt('敏感数据');
// 输出示例: VEhJUz1mYWxzZVZlcnNpb249MS4wJmtleT1zZWN1cmVfazEyMw

// 紧凑模式 - 十六进制编码（最短长度，适合存储）
$crypto = new Crypto('your_key', Crypto::ENGINE_AUTO, Crypto::MODE_COMPACT);
$encrypted = $crypto->encrypt('敏感数据');
// 输出示例: 54484349533b66756c73652076657273696f6e20312e302e303b6b65793d7365637572655f6b313233
```

##### Crypto - 基础加解密

```php
use Cdyun\PhpTool\Crypto;

// 创建加密实例
$crypto = new Crypto('your_secret_key_2025');

// 加密数据
$encrypted = $crypto->encrypt('这是需要加密的敏感数据');
echo $encrypted;
// 输出示例: VEhJUz1mYWxzZVZlcnNpb249MS4wJmtleT1zZWN1cmVfazEyMw==

// 解密数据
$decrypted = $crypto->decrypt($encrypted);
echo $decrypted;
// 输出: 这是需要加密的敏感数据

// 使用不同的密钥
$crypto2 = new Crypto('another_key');
$encrypted2 = $crypto2->encrypt('另一个敏感数据');

// 解密（需要使用相同的密钥）
$decrypted2 = $crypto2->decrypt($encrypted2);
```

##### Crypto - 静态方法调用

```php
use Cdyun\PhpTool\Crypto;

// 静态加密（使用默认密钥）
$encrypted = Crypto::encrypt('敏感数据');
$decrypted = Crypto::decrypt($encrypted);

// 使用自定义密钥的静态方法
$encrypted = (new Crypto('custom_key'))->encrypt('敏感数据');
$decrypted = (new Crypto('custom_key'))->decrypt($encrypted);
```

##### md5() - MD5加密（支持加盐）
```php
// 基础MD5加密
$md5 = Crypto::md5('123456'); // e10adc3949ba59abbe56e057f20f883e

// 加盐MD5加密
$salt = 'your_custom_salt';
$md5WithSalt = Crypto::md5('123456', $salt); // 52c69e3a57331081823331c4e6999d23

// 多次加盐（提高安全性）
$doubleSalt = Crypto::md5(Crypto::md5('123456'), $salt);
```

##### passwordHash()  - 密码哈希
```php
$password = 'my_secure_password';
$hash = Crypto::passwordHash($password);
```

##### passwordVerify()  - 密码哈希验证
```php
// 密码正确
$isValid = Crypto::passwordVerify('my_secure_password', $hash);

// 密码错误
$isValid = Crypto::passwordVerify('wrong_password', $hash);

// 密码哈希更新（重新哈希）
if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
    $newHash = Crypto::passwordHash($password);
}
```

##### Crypto - HMAC签名

```php
use Cdyun\PhpTool\Crypto\Crypto;

// SHA256签名（默认）
$signature = Crypto::hmac('待签名数据', 'your_secret_key');
echo $signature;
// 输出示例: 3a6eb0790f39ac87c94f3856b2dd2c5d110e0f9b0e9c9d6e7b8c9d0e1f2a3b4c

// SHA512签名
$signature512 = Crypto::hmac('待签名数据', 'your_secret_key', 'sha512');
echo $signature512;
// 输出示例: a4e6b8c0d1e2f3a4b5c6d7e8f9a0b1c2d3e4f5a6b7c8d9e0f1a2b3c4d5e6f7a8b9c0d1e2f3a4b5c6d7e8f9a0b1c2

// MD5签名
$signatureMd5 = Crypto::hmac('待签名数据', 'your_secret_key', 'md5');
echo $signatureMd5;
// 输出示例: 1a1dc06f7a0b2c8d9e0f1a2b3c4d5e6f7

// 数据完整性验证
$originalData = '订单数据';
$originalSignature = Crypto::hmac($originalData, 'api_secret');

$receivedData = '订单数据';
$receivedSignature = $_SERVER['HTTP_SIGNATURE'] ?? '';

if (hash_equals($originalSignature, $receivedSignature)) {
    echo '数据完整性验证通过';
} else {
    echo '数据可能被篡改';
}
```

##### Crypto - SSL对称加解密

```php
use Cdyun\PhpTool\Crypto;

// 使用自定义密钥进行SSL加密
$key = 'your_ssl_key_32_bytes_long!';
$crypto = new Crypto();

$encrypted = $crypto->sslEncrypt('SSL加密数据', $key);
echo $encrypted;
// 输出示例: VGhpc0lzU1NMY0VuY3J5cHRlZERhdGE=

$decrypted = $crypto->sslDecrypt($encrypted, $key);
echo $decrypted;
// 输出: SSL加密数据
```

##### Crypto - 错误处理

```php
use Cdyun\PhpTool\Crypto;

$crypto = new Crypto('your_key');

try {
    $encrypted = $crypto->encrypt('敏感数据');
    $decrypted = $crypto->decrypt($encrypted);
    echo '加解密成功: ' . $decrypted;
} catch (\Exception $e) {
    echo '加解密失败: ' . $e->getMessage();
}

// 密钥错误时的解密异常
try {
    $wrongCrypto = new Crypto('wrong_key');
    $decrypted = $wrongCrypto->decrypt($encrypted);
} catch (\Exception $e) {
    echo '解密失败（密钥错误）: ' . $e->getMessage();
}
```

### 使用场景

```php
use Cdyun\PhpTool\Crypto;

// 场景1：用户敏感信息加密存储
function saveUserSensitiveData(Crypto $crypto, array $data): array
{
    return [
        'id' => $data['id'],
        'name' => $data['name'],
        'encrypted_phone' => $crypto->encrypt($data['phone']),
        'encrypted_id_card' => $crypto->encrypt($data['id_card'])
    ];
}

function getUserSensitiveData(Crypto $crypto, array $userData): array
{
    return [
        'id' => $userData['id'],
        'name' => $userData['name'],
        'phone' => $crypto->decrypt($userData['encrypted_phone']),
        'id_card' => $crypto->decrypt($userData['encrypted_id_card'])
    ];
}

// 场景2：API请求签名验证
function verifyApiRequest(Crypto $crypto, array $params, string $signature): bool
{
    $expectedSignature = Crypto::hmac(json_encode($params), $apiSecret);
    return hash_equals($expectedSignature, $signature);
}

// 场景3：密码安全存储
function registerUser(string $password): string
{
    return Crypto::passwordHash($password);
}

function verifyUserPassword(string $password, string $hash): bool
{
    return Crypto::passwordVerify($password, $hash);
}
```

## HTTP请求处理模块

### 特性
- ✅ 支持HTTP/HTTPS协议
- ✅ 支持请求超时设置
- ✅ 支持请求头设置
- ✅ 支持请求参数设置
- ✅ 支持响应状态码、响应头、响应体获取
- ✅ 支持异常处理
- ✅ 支持多种HTTP方法（GET/POST/PUT/PATCH/DELETE/HEAD/OPTIONS）
- ✅ 支持多种内容类型（JSON/form/multipart）
- ✅ 灵活的请求选项配置
- ✅ 响应处理和错误处理

### 核心方法
| 方法名                | 功能描述        | 调用示例             |
|--------------------|-------------|-------------------------------------------|
| `get()` | GET请求 | `Curl::get('https://api.example.com', $data)` |
| `post()` | POST请求 | `Curl::post('https://api.example.com', $data)` |
| `put()` | PUT请求 | `Curl::put('https://api.example.com/1', $data)` |
| `delete()` | DELETE请求 | `Curl::delete('https://api.example.com/1')` |
| `head()` | HEAD请求 | `Curl::head('https://api.example.com')` |
| `options()` | OPTIONS请求 | `Curl::options('https://api.example.com')` |

### 使用示例

##### setDefaultOptions() - 设置默认配置
```php
Curl::setDefaultOptions([
        'timeout' => 60,
        'connect_timeout' => 20,
    ])
```

##### getDefaultOptions() - 获取默认配置
```php
Curl::getDefaultOptions()
// 返回默认配置
//  [
//        'timeout' => 60,
//        'connect_timeout' => 20,
//        'verify' => true,
//  ]
```

##### reset() - 重置客户端实例
```php
Curl::reset()
```

##### options() - OPTIONS请求
```php
$response = Curl::options('https://api.example.com', [], []);
```

##### head() - HEAD请求
```php
$response = Curl::head('https://api.example.com', [], [], []);
```

##### get() - GET请求
```php
$response = Curl::get('https://api.example.com', [], [], []);

$response = Curl::get('https://api.example.com/users', ['page' => 1, 'limit' => 10]);
```

##### post() - POST请求
```php
$response = Curl::post('https://api.example.com', [], [], []);

$response = Curl::post('https://api.example.com', ['name' => 'John', 'email' => 'john@example.com']);
```

##### postForm() - POST表单请求
```php
$response = Curl::postForm('https://api.example.com', [], [], []);

$response = Curl::postForm('https://api.example.com', ['name' => 'John', 'email' => 'john@example.com']);
```

##### postMultipart() - POST文件上传请求
```php
$response = Curl::postMultipart(
    'https://api.example.com/upload', 
    [
        ['name' => 'file', 'contents' => fopen('/path/to/file.jpg', 'r')]
    ]
);
```

##### put() - PUT请求
```php
$response = Curl::put('https://api.example.com/users/1', [], [], []);

$response = Curl::put('https://api.example.com/users/1', ['name' => 'Updated Name']);
```

##### putForm() - PUT表单请求
```php
$response = Curl::put('https://api.example.com/users/1', [], [], []);

$response = Curl::put('https://api.example.com/users/1', ['name' => 'Updated Name']);
```

##### delete() - PUT请求
```php
$response = Curl::delete('https://api.example.com/users/1', [], [], []);

$response = Curl::delete('https://api.example.com/users/1');
```

##### patch() - PATCH请求
```php
$response = Curl::patch('https://api.example.com/users/1', [], [], []);

$response = Curl::patch('https://api.example.com/users/1', [
    'status' => 'active'
]);
```

# 版本要求

- PHP >= 8.1
- ext-openssl
- ext-json

# 许可证

MIT License