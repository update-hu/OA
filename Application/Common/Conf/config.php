<?php
return array(
	//'配置项'=>'配置值'

    //数据库配置信息
    'DB_TYPE' => 'mysql',
    'DB_NAME' => 'oa',
    'DB_USER' => 'root',
    'DB_PWD' => '123456',
    'DB_HOST' => '127.0.0.1',
    'DB_PORT' => '3306',
    'DB_CHARSET' => 'utf8',

    //RBAC权限配置信息
    'USER_AUTH_ON' => true,     //是否开启权限验证
    'USER_AUTH_TYPE' => 1,      //验证方式 （1：登录验证；2：实时验证）

    'USER_AUTH_KEY' => 'uid',  //用户认证识别号
    'ADMIN_AUTH_KEY' => 'superadmin', //管理员识别号
    'USER_AUTH_MODEL' => 'employee',  //验证用户表模型
    'USER_AUTH_GATEWAY' => '/Login/Login/login',  //用户验证失败，跳转URL
    'AUTH_PWD_ENCODER' => 'md5',  //默认密码加密方式
    'RBAC_SUPERADMIN' => 'admin',  //管理员名称

    'NOT_AUTH_MODULE' => 'Login,Register',  //无需认证的模块
    'NOT_AUTH_ACTION' => 'login',  //无需认证的方法
    'REQUIRE_AUTH_MODULE' => 'Employee,Department,Log,Train,Sign',  //默认需要认证的模块
    'REQUIRE_AUTH_ACTION' => '',  //默认需要认证的动作

    'GUEST_AUTH_ON' => false,  //是否开启游客授权访问
    'GUEST_AUTH_ID' => 0,  //游客标记

    'RBAC_ROLE_TABLE' => 'role',   //角色表名称
    'RBAC_USER_TABLE' => 'role_user',   //用户角色中间表名称
    'RBAC_ACCESS_TABLE' => 'access',  //权限表名称
    'RBAC_NODE_TABLE' => 'node',   //节点表名称


    //Auth权限配置信息
    'AUTH' => true,                //认证开关
    'AUTH_TYPE' => 2,              //认证方式，1：实时验证；2：登录验证。
    'AUTH_GROUP' => 'auth_group',      //用户组数据表名
    'AUTH_GROUP_ACCESS' => 'auth_group_access',  //用户组明细表
    'AUTH_RULE' => 'auth_rule',        //权限规则表
    'AUTH_USER' => 'employee'     //用户信息表




);