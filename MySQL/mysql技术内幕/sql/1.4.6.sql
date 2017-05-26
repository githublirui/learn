/* 注意符号`和'的区别 */
/*总统表*/
DROP TABLE IF EXISTS `president`;
CREATE TABLE IF NOT EXISTS `president` (
    `last_name` varchar(15) NOT NULL,
    `first_name` varchar(15) NOT NULL,
    `suffix` varchar(15)  NULL,
    `city` varchar(20) NULL,
    `state` varchar(2) NOT NULL,
    `birth` DATE  NOT NULL,
    `death` DATE NULL
);

/**
1. 注意中英文符号,，
2. 字段语句都用英文逗号隔开，最后一行没有逗号
3. 注意date和对data
4. 只有主键才能使用AUTO_INCREMENT
5. PRIMARY KEY 字段要加括号
*/
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`(
    `member_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `last_name` VARCHAR(20) NOT NULL,
    `first_name` VARCHAR(20) NOT NULL,
    `suffix` VARCHAR(15)  NULL,
    `expiration` DATE NULL,
    `email`  VARCHAR(100) NOT NULL,
    `street`  VARCHAR(100) NOT NULL,
    `city`  VARCHAR(100) NOT NULL,
    `state`  VARCHAR(100) NOT NULL,
    `zip`  VARCHAR(100) NOT NULL,
    `phone`  VARCHAR(100) NOT NULL,
    `interests`  VARCHAR(255) NOT NULL,
    PRIMARY KEY (`member_id`)
);