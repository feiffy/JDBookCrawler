# JDBookCrawler
抓取京东的图书信息

# 配置数据库
创建一个数据库：jd_book

创建数据库表：
``` sh
cd JDBookCrawler
vendor/bin/doctrine orm:schema-tool:ceate
```

# 执行抓取
设置 save.php 中for循环的起始id和结束id

执行抓取
``` sh
php save.php
```
