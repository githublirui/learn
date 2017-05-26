mysql 存储引擎

1. MyISAM
特征：
1. 每个表对应磁盘三个文件  tablename.MYD数据文件,tablename.frm表定义文件,tablename.MYI索引文件
2. 每个表最大索引数量为64，可以在源代码中修改重新编译
3. 每个索引最多16列
4. 索引最大长度1000字节
5. 索引列中允许null
6. 使用底层操作系统缓存读取和写入
7. 支持并发，同时读取和写入
8. check table 恢复


2. InnoDB
和MyISAM 区别
1. 通过日志来恢复数据库崩溃
2. 把数据和索引单独存在一个表空间文件中
3. 物理上通过主键顺序来存储数据，支持聚集索引
4. 读取和写入都是通过自己写的函数，不依靠操作系统
5. 支持原始磁盘分区，InnoDB内部格式的磁盘分区
6. 支持行级锁
7. 支持外键
8. 事务处理

回滚
BEGIN WORK;
DELETE FROM `category_itemlv2` WHERE id=2;
ROLLBACK;
COMMIT;

设置回滚点
SAVEPOINT a;
ROLLBACK TO SAVEPOINT a;
eg:
BEGIN WORK;
DELETE FROM `category_itemlv2` WHERE id=4;
SAVEPOINT a;
DELETE FROM `category_itemlv2` WHERE id=5;
ROLLBACK TO SAVEPOINT a;

Archive
1. 不经常使用但需要存储在数据库中
2. 通过zlib GZIP方式压缩
3. 不支持索引
4. 支持insert,select 不支持update,delete,replace
5. .ARM是数据文件是一个Gzip文件