# 保存图书数据所用的表如何设计呢？
通过分析页面结构，我找到了一些规律。

book 表，存储书籍相关的元数据，用于确定一本书，包括
* id 自增主键
* title VARCHAR(256) 书名（标题）
* sub_title VARCHAR(256) 副标题
* author VARCHAR(256) 作者
* publisher VARCHAR(256) 出版社
* publish_date DATETIME 出版时间
* ISBN VARCHAR(13) ISBN号码
* size VARCHAR(128) 尺寸('16开')
* pages INT 页数
* wordage INT 字数
* paper_type VARCHAR(128) 用纸类型('纯质纸', '胶版纸')
* packet_type VARCHAR(128) 包装('平装')
* updated_time datetime
* created_time timestamp
* 建表语句：
    ``` sql
    CREATE TABLE `book` (
    `id` bigint(20) NOT NULL COMMENT '自增主键',
    `title` varchar(256) NOT NULL COMMENT '书名（标题）',
    `sub_title` varchar(256) NOT NULL COMMENT '副标题',
    `author` varchar(256) NOT NULL COMMENT '作者',
    `publisher` varchar(256) NOT NULL COMMENT '出版社',
    `publish_date` datetime NOT NULL COMMENT '出版时间',
    `isbn` varchar(13) NOT NULL COMMENT 'ISBN号',
    `size` varchar(128) NOT NULL COMMENT '尺寸（16开，32开）',
    `pages` int(11) DEFAULT '0' COMMENT '页数',
    `wordage` int(11) DEFAULT '0' COMMENT '字数',
    `paper_type` varchar(128) DEFAULT ' ' COMMENT '用纸类型(''纯质纸'', ''胶版纸'')',
    `packet_type` varchar(128) DEFAULT ' ' COMMENT '包装(''平装'')',
    `updated_time` datetime NOT NULL COMMENT '记录更新时间',
    `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '记录创建时间'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='书籍表';

    ALTER TABLE `book`
    ADD PRIMARY KEY (`id`);


    ALTER TABLE `book`
    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增主键';
    ```

book_price 表，存储书籍的价格信息，包括
* id 自增主键
* book_id book表外键
* price 价格
* origin_price 原始定价
* price_date 价格抓取的时间