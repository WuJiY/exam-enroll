<?php
namespace Kezhi\Model;
/**
 * 学生信息表
 * CREATE TABLE user_info(
 * uid INT(8) NOT NULL PRIMARY KEY,
 * student_number VARCHAR(45) default NULL,
 * name VARCHAR(45) default NULL,
 * sex INT(8) default 2 COMMENT '0表示男，1表示女，2表示未知',
 * nation INT(8) default 0 COMMENT '0表示未知',
 * id_card_number VARCHAR(45) default NULL COMMENT ;身份证号;,
 * telephone_number VARCHAR(45) default NULL,
 * college VARCHAR(45) default NULL,
 * grade VARCHAR(45) default NULL,
 * major VARCHAR(45) default NULL,
 * class VARCHAR(45) default NULL,
 * FOREIGN KEY(uid) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
 * )default charset=utf8 COMMENT='学生信息表';
*/
class UserInfo extends Model{
    /**
     * 新增一条记录
     *
     * @param integer $id user_id
     * @param Array $data 用户的个人信息
    */
    public function add($id, Array $data){

    }
}
?>
