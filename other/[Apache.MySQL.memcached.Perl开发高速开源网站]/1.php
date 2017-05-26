1. mysql概述
运行操作顺序
1. 客户端程序输入查询语句
2. 数据库分析器把语句整理成数据项树结构，查询片段
3. 通过表处理程序接口，打开查询语句中使用的表
4. 

mysql事务acid
原子性: 事务中的sql有一条失败则会全部回滚，事务失败
一致性: 记录更新未提交，在没有进行提交前读取数据,会读取临时表中的数据,保证数据的一致性
持久性: 在执行中的事务遇到突然情况，数据不会丢失
隔离性: 
mysqladmin mysqldump mysqlimport mysqlshow
mysql核心组件
组件                                说明
分析器/命令执行器              处理查询语句，生成数据项数结构
优化器                        使用分析器生成的数据项数，查询执行最少的执行计划
表处理程序                    位于数据库服务器和存储引擎的抽象接口

mysqldump 创建数据库备份
>mysqldump -u root -p lrtest --no-create-info > e:\tmp\lrtest.sql  导入insert的sql，不包含创建语句 生成数据备份就是用计划任务执行脚本
mysqladmin 命令
>mysqladmin -u root -p create database lrtest  #创建，删除数据库
>myqsladmin -u root -p --sleep=5 processlist   #监控mysql进程，五秒刷新一次

mysqlimport  数据库导入工具
mysqlshow lrtest dbname table field

mysql守护，启动程序
mysqld,mysqld_safe,mysql.server,mysqld_multi

查询帮助
>help delete;
>help alter;
mysql数据类型
show create table user\G
null
ALTER TABLE `user` ADD COLUMN `add` INTEGER(11) DEFAULT NULL AFTER `name` #添加字段
ALTER TABLE `user` CHANGE COLUMN `add1` `add2` INTEGER(11) DEFAULT NULL #修改字段名
ALTER TABLE `user` MODIFY COLUMN `add2` VARCHAR(255) DEFAULT NULL#修改数据类型
ALTER TABLE `user` ADD INDEX `name` (`name`)#添加索引
ALTER TABLE `user` DROP INDEX `name`#删除索引
ALTER TABLE `user` AUTO_INCREMENT=1#自增长设置1开始
索引修改执行的是先删除再添加

INSERT IGNORE INTO #忽略插入 插入数据，不会报错如主键唯一键重复等
INSERT DELAYED INTO #mysql 延迟插入,不需要客户端等待，插入内存队列插入，解决mysql堵塞问题
INSERT LOW_PRIORITY INTO #mysql 延迟插入,直到没有其它客户端从表中读取为止


SELECT * FROM `user` LEFT JOIN constellation USING(`id`)
等价于
SELECT * FROM `user` LEFT JOIN constellation on user.id=constellation.id

update user join states using(id) set age=20 where name='New York'

replace into 不存在插入，存在更新，根据unique或者主键字段判断，
replace into table () values();
replace into table set colomn1=value1,colomn2=value2...

REPLACE INTO `user` (`id`,`name`) VALUES(1,'bbbb');
INSERT INTO `user` (`id`,`name`) VALUES(1,'bbbb') ON DUPLICATE KEY UPDATE `name`='cccc';#存在更新,不存在插入

#MySQL函数
查看mysql函数
>help Numeric Functions;
>help Bit Functions;
>help Date and Time Functions;
>help Encryption Functions;
>help Information Functions;
>help Miscellaneous Functions;
>help String Functions;

>select database();#当前链接的数据库
>select current_user();#当前登录用户

#字符串函数
1.concat(a,b,c).字符串连接函数
2.replace().替换函数
eg: SELECT CONCAT(`city_id`,REPLACE(`data`,'updateTime','upTime')) FROM weather_pm25;
3.LENGTH().替换函数,大写
eg: INSERT INTO lengths SELECT id,LENGTH(`data`) FROM weather_pm25;
4.soundex英文声音匹配
eg: SOUNDEX('') = SOUNDEX('');
5. mysql正则
SELECT * FROM weather_pm25 WHERE `data` REGEXP 'aqi":[[:digit:]]{3}[^0-9].';
6. 字符串截取 substr
SELECT SUBSTR(`data`,25,10),`data` FROM weather_pm25
7. 字符串比较strcmp
SELECT STRCMP ('test1','test');
8.时间日期
SELECT FROM_UNIXTIME(UNIX_TIMESTAMP());#时间戳转时间
Select UNIX_TIMESTAMP(’2006-11-04 12:23:00′);#时间转时间戳
select date_format(now(),'%Y-%m-%d %H:%i:%s'); #格式化时间

#流程控制语句
1. case when then else 
eg:
SELECT `name`,`birthday`,
CASE WHEN birthday<'1980-01-01' THEN 'old' 
WHEN birthday>='1990-01-01' THEN 'young' 
ELSE 'OK'  END AS age
FROM lee;
2. IF(BOOL,value1,value2),true=>value1,false=>value2

#mysql自定义变量
1. 两种赋值方式
select @name := 'name';
set @name='name';
tip: :=为赋值符号，=只有在set =的时候作为复制，其他都是操作符

#权限
1.查看当前用户权限
>show privileges;
2.创建用户
>create user 'lirui' identified by 'adminlirui';
3.删除用户
>drop user 'lirui'@'host'