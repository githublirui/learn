#存储过程
语法结构，[]为非必填
CREATE  
   [DEFINER = {user | current_user }] //定义所有者，默认当前用户
   PROCEDURE <name> ([parameter])  #参数格式[in | out | input] <parameter name> type
CREATE
          
DECIMAL=numeric
>DELEMITER | #定义定界符，按|结束
>CREATE PROCEDURE user_avg(OUT average numeric(5,2))
>BEGIN
>SELECT AVG(age) from lengths;
>|
>END

eg:
DELIMITER // #定界符，由于默认;为结束符所以需要修改定界符
CREATE DEFINER='lirui1'@'localhost' PROCEDURE productpricing(IN avg_length VARCHAR(255)) #参数(out参数作为输出 | in参数作为输入 inout输入和返回值 参数名 参数类型)
BEGIN #开始
SELECT * FROM weather_pm25;#函数主体
END;#结束
//
SET @a = 1231;
CALL productpricing(@a);#调用存储过程
SHOW PROCEDURE STATUS;/*显示所有存储过程*/
DROP PROCEDURE  IF EXISTS `productpricing`;#删除存储过程

函数
DELIMITER //
CREATE FUNCTION test123(uname VARCHAR(50))
RETURNS VARCHAR(200)
DETERMINISTIC
BEGIN
	DECLARE nam VARCHAR(50);#声明变量
	#DECLARE nam1 int(10);
	SELECT uname INTO nam;	
	RETURN(nam);
END;
//
SELECT test123('1234');调用函数
SHOW FUNCTION STATUS;#查看所有函数
DROP FUNCTION IF EXISTS `test123`;#删除函数

eg:#创建登录存储过程
DELIMITER //
CREATE 
DEFINER='root'@'localhost'
PROCEDURE login(IN uname VARCHAR(50),mypassword VARCHAR(50))
BEGIN
DECLARE tusername VARCHAR(50);
DECLARE tpassword VARCHAR(50);
DECLARE result VARCHAR(50);
SELECT `username`,`password` INTO tusername,tpassword FROM `user` WHERE `username`=uname LIMIT 1;
#select tusername,tpassword;#存储过程以先查询的为结果
IF (ISNULL(tpassword)) 
THEN
SET result='error username'; 
ELSEIF(tpassword != MD5(mypassword))
THEN 
SET result='error password'; 
ELSE
SET result='login ok';
END IF;
SELECT result;
END;
//
DELIMITER ;
CALL login('aa','aa');
DROP PROCEDURE login;

eg:
DELIMITER //
CREATE FUNCTION is_young(username VARCHAR(64))
RETURNS VARCHAR(64)  #返回type格式定义
DETERMINISTIC #函数类型
BEGIN
DECLARE age_check DECIMAL(10,2);
DECLARE is_young VARCHAR(64);
SELECT `age` INTO age_check FROM `user` WHERE `name`=username;
IF (age_check<=30 AND age_check<=20) THEN 
  SET is_young = 'young';
ELSEIF(age_check>=40 AND age_check<=50) THEN 
  SET is_young = 'mid';
ELSE
  SET is_young = 'old';
END IF;
 RETURN(is_young);
END;
//
DROP FUNCTION is_young;#删除函数
SELECT is_young('dd'); #page 113

#创建登录函数 function
DELIMITER //
CREATE FUNCTION login(username VARCHAR(50),mypassword VARCHAR(50))
RETURNS VARCHAR(50)
DETERMINISTIC
BEGIN
DECLARE tusername VARCHAR(50);
DECLARE tpassword VARCHAR(50);
DECLARE result VARCHAR(50);
SELECT `username`=tusername,`password`=tpassword FROM `user` WHERE `username`=username LIMIT 1;
SET result = tpassword;
#if(isnull(tpassword))
#then 
#set result='error username';
#elseif (tpassword != md5(mypassword))
#then
#set result='error password';
#else
#set result='login ok;';
#END IF;
RETURN(result);
END;
//
DROP FUNCTION IF EXISTS login;
SHOW FUNCTION STATUS;
SELECT login('bb','bb');

#触发器
对于INSERT语句,只有NEW是合法的；对于DELETE语句，只有OLD才合法；而UPDATE语句可以在和NEW以及
OLD同时使用。
old，new同时使用例子
CREATE TRIGGER tr1  
BEFORE UPDATE ON t22   
FOR EACH ROW   
BEGIN   
SET @old = OLD.s1;   
SET @new = NEW.s1;   
END; 

语法：
create trigger triggerName
after/before insert/update/delete on 表名
for each row   #这句话在mysql是固定的
begin
sql语句;
end;

eg：
#1 用户添加订单，商品减去
INSERT INTO goods (`name`,`created`) VALUES('饮料',UNIX_TIMESTAMP(NOW()));
INSERT INTO `order`(`goods_id`,`num`,`created`) VALUES(2,2,UNIX_TIMESTAMP(NOW()));
DELIMITER //  #定义分界符
CREATE TRIGGER buy AFTER INSERT ON `order` #在order插入之后，执行触发器
FOR EACH ROW #固定格式
BEGIN
UPDATE `goods` SET num = num - new.num WHERE id=new.goods_id;
END
//
SHOW TRIGGERS;#查询所有触发器
DROP TRIGGER buy;#删除触发器
#2 用户撤销订单，商品添加
DELIMITER //
CREATE TRIGGER del_order AFTER DELETE ON `order` FOR EACH ROW
BEGIN
UPDATE `goods` SET num = num + old.num WHERE id=old.goods_id;
END
//
#121 视图

创建函数UDF