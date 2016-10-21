USE videotreat;

/*医生状态表*/
CREATE TABLE state_info (
	stateId INT PRIMARY KEY auto_increment,
	stateName VARCHAR (10) NOT NULL
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '医生状态表';

INSERT INTO state_info (stateName)
VALUES
	('空闲');

INSERT INTO state_info (stateName)
VALUES
	('忙碌');

INSERT INTO state_info (stateName)
VALUES
	('离开');

/*医生职称表*/
CREATE TABLE profess_info (
	professId INT PRIMARY KEY auto_increment,
	professName VARCHAR (20) NOT NULL UNIQUE
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '医生职称表';

INSERT INTO profess_info (professName)
VALUES
	('住院医师');

INSERT INTO profess_info (professName)
VALUES
	('主治医师');

INSERT INTO profess_info (professName)
VALUES
	('副主任医师');

INSERT INTO profess_info (professName)
VALUES
	('主任医师');

/*医生科室表*/
CREATE TABLE department_info (
	departmentId INT PRIMARY KEY auto_increment,
	departmentName VARCHAR (20) NOT NULL UNIQUE,
	departmentExplain VARCHAR (200) DEFAULT ''
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '医生科室表';

INSERT INTO department_info (departmentName)
VALUES
	('内科');

INSERT INTO department_info (departmentName)
VALUES
	('外科');

INSERT INTO department_info (departmentName)
VALUES
	('妇产科');

INSERT INTO department_info (departmentName)
VALUES
	('男科');

INSERT INTO department_info (departmentName)
VALUES
	('儿科');

INSERT INTO department_info (departmentName)
VALUES
	('五官科');

INSERT INTO department_info (departmentName)
VALUES
	('肿瘤科');

INSERT INTO department_info (departmentName)
VALUES
	('皮肤性病科');

INSERT INTO department_info (departmentName)
VALUES
	('中医科');

INSERT INTO department_info (departmentName)
VALUES
	('传染病科');

INSERT INTO department_info (departmentName)
VALUES
	('整形美容科');

INSERT INTO department_info (departmentName)
VALUES
	('营养科');

INSERT INTO department_info (departmentName)
VALUES
	('麻醉医学科');

INSERT INTO department_info (departmentName)
VALUES
	('骨科');

INSERT INTO department_info (departmentName)
VALUES
	('康复医学科');

INSERT INTO department_info (departmentName)
VALUES
	('介入医学科');

INSERT INTO department_info (departmentName)
VALUES
	('医学影像科');

INSERT INTO department_info (departmentName)
VALUES
	('精神心理科');

INSERT INTO department_info (departmentName)
VALUES
	('其他科室');

/*医院信息表*/
CREATE TABLE hospital_info (
	hospitalId INT AUTO_INCREMENT PRIMARY KEY COMMENT '编号',
	hospitalName VARCHAR (100) UNIQUE NOT NULL COMMENT '医院名称',
	hospitalLogo VARCHAR (200) NOT NULL DEFAULT '' COMMENT '医院Logo',
	hospitalImage VARCHAR (200) NOT NULL DEFAULT '' COMMENT '医院展示图片',
	doctorNumber INT NOT NULL DEFAULT 0 COMMENT '医院医师数量',
	hospitalAddress VARCHAR (200) NOT NULL DEFAULT '' COMMENT '医院地址',
	labelArray VARCHAR (400) NOT NULL DEFAULT '' COMMENT '医院标签',
	hospitalIntroduction VARCHAR (4000) NOT NULL DEFAULT '' COMMENT '医院简介',
	isDel INT (1) NOT NULL DEFAULT 0 COMMENT '1 删除 0为不删除',
	demo VARCHAR (4000) DEFAULT '' COMMENT '预留字段'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '医院信息表';

/*医生信息表*/
CREATE TABLE doctor_info (
	doctorId INT PRIMARY KEY AUTO_INCREMENT COMMENT '医生编号',
	doctorName VARCHAR (32) NOT NULL COMMENT '医生姓名',
	PASSWORD VARCHAR (32) NOT NULL COMMENT '医生密码',
	tel VARCHAR (20) NOT NULL UNIQUE COMMENT '医生手机号',
	stateId INT NOT NULL DEFAULT 3 COMMENT '医生状态  关联state_info表',
	isInVideo   INT   NOT NULL DEFAULT 0  COMMENT '医生是否在视频中，1表示在，0表示不在',
	professId INT NOT NULL COMMENT '职称 关联profess_info表',
	departmentId INT NOT NULL COMMENT '科室 关联department_info表',
	sex INT (1) NULL COMMENT '性别 0为男，1为女，2为未知',
	age INT (4) NOT NULL COMMENT '年龄',
	headPic VARCHAR (128) NOT NULL DEFAULT '' COMMENT '医生头像',
	special VARCHAR (4000) NOT NULL DEFAULT '' COMMENT '医生特长',
	PROFILE VARCHAR (128) NOT NULL DEFAULT '' COMMENT '医生个人简介',
	hospitalId INT NOT NULL COMMENT '医院信息,关联hospital_info表',
	isDel INT (1) NOT NULL DEFAULT 0 COMMENT '1 删除 0为不删除',
	labelArray VARCHAR (400) NOT NULL DEFAULT '' COMMENT '医生个人标签',
	create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (stateId) REFERENCES state_info (stateId),
	FOREIGN KEY (professId) REFERENCES profess_info (professId),
	FOREIGN KEY (departmentId) REFERENCES department_info (departmentId),
	FOREIGN KEY (hospitalId) REFERENCES hospital_info (hospitalId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '医生信息表';

CREATE TABLE dic_user_sex (
	sex_key INT (1) NOT NULL PRIMARY KEY COMMENT '代码',
	sex_value VARCHAR (20) NOT NULL COMMENT '性别'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '性别表';

INSERT INTO dic_user_sex (sex_key, sex_value)VALUES(0, '未知的性别');

INSERT INTO dic_user_sex (sex_key, sex_value)VALUES(1, '男性');

INSERT INTO dic_user_sex (sex_key, sex_value)VALUES(2, '女性');

INSERT INTO dic_user_sex (sex_key, sex_value)VALUES(9, '未说明的性别');

CREATE TABLE user_db_info (
	userId INT PRIMARY KEY auto_increment COMMENT '编号',
	userName VARCHAR (50) NOT NULL DEFAULT '' COMMENT '姓名',
	tel VARCHAR (20) DEFAULT '' COMMENT '手机号',
	password VARCHAR (40) DEFAULT '' COMMENT '密码',
	sex_key INT (1)   NULL   COMMENT '性别',
	birthday VARCHAR (40) DEFAULT '' COMMENT '出生日期',
	imei VARCHAR (20) NOT NULL DEFAULT '' COMMENT '手机的唯一识别号码',
	third_type VARCHAR (20) DEFAULT '' COMMENT '第三方登录类型',
	client INT (1) DEFAULT '1' COMMENT '手机型号 1是苹果0是安卓',
	login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (sex_key) REFERENCES dic_user_sex (sex_key)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '用户登录信息表';


CREATE TABLE qq_info (
	id INT PRIMARY KEY auto_increment COMMENT '编号',
	userId INT NOT NULL COMMENT '用户编号',
	qq_key VARCHAR (100) NOT NULL COMMENT '第三方登录Id',
	qq_token VARCHAR (200) NOT NULL COMMENT 'qq的token值',
	nickName VARCHAR (100) DEFAULT '' COMMENT '昵称',
	headPic VARCHAR (200) DEFAULT '' COMMENT '第三方登录头像',
	login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '第三方QQ登录表';


CREATE TABLE wechat_info (
	id INT PRIMARY KEY auto_increment COMMENT '编号',
	userId INT NOT NULL COMMENT '用户编号',
	wechat_key VARCHAR (100) NOT NULL COMMENT '第三方登录Id',
	wechat_token VARCHAR (200) NOT NULL COMMENT 'wechat的token值',
	nickName VARCHAR (100) DEFAULT '' COMMENT '昵称',
	headPic VARCHAR (200) DEFAULT '' COMMENT '第三方登录头像',
	login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '第三方微信登录表';


CREATE TABLE blog_info (
	id INT PRIMARY KEY auto_increment COMMENT '编号',
	userId INT NOT NULL COMMENT '用户编号',
	blog_key VARCHAR (100) NOT NULL COMMENT '第三方登录Id',
	blog_token VARCHAR (200) NOT NULL COMMENT 'blog的token值',
	nickName VARCHAR (100) DEFAULT '' COMMENT '昵称',
	headPic VARCHAR (200) DEFAULT '' COMMENT '第三方登录头像',
	login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '第三方微博登录表';

CREATE TABLE user_base_info (
	userId INT NOT NULL COMMENT '用户Id',
	address VARCHAR (128) DEFAULT '' COMMENT '地址',
	blood VARCHAR (8) DEFAULT '' COMMENT '血型',
	stature VARCHAR (10) DEFAULT '' COMMENT '身高',
	weight VARCHAR (10) DEFAULT '' COMMENT '体重',
	identityCardNum VARCHAR (20) DEFAULT '' COMMENT '身份证号',
	headPic VARCHAR (200) DEFAULT '' COMMENT '个人头像',
	userSmoking VARCHAR (10) DEFAULT '无' COMMENT '有 或 无',
	create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '用户基本信息表';

/*自述表*/
CREATE TABLE user_report_card (
	reportCardId INT auto_increment PRIMARY KEY COMMENT '自述卡Id',
	userId INT NOT NULL COMMENT '用户id',
	reportCardName VARCHAR (100) NOT NULL COMMENT '自述卡名称',
	reportCardDescribe VARCHAR (1000) NULL COMMENT '病情自述',
	reportCardRemark VARCHAR (1000) NULL COMMENT '备注说明',
	reportCardImage VARCHAR (1000) NULL COMMENT '自述卡图片',
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '自述卡';

/*患者排队信息表*/
CREATE TABLE user_line (
	id INT AUTO_INCREMENT COMMENT '用户排队编号',
	doctorId INT NOT NULL COMMENT '用户id',
	userId INT NOT NULL UNIQUE COMMENT '医生id',
	reportCardId INT NULL UNIQUE COMMENT '自述卡Id',
	create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	FOREIGN KEY (doctorId) REFERENCES doctor_info (doctorId),
	FOREIGN KEY (userId) REFERENCES user_db_info (userId),
	FOREIGN KEY (reportCardId) REFERENCES user_report_card (reportCardId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '用户排队信息表';

CREATE TABLE `version` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `version` varchar(32) NOT NULL COMMENT '版本号',
  `versionContent` varchar(4000) NOT NULL DEFAULT '' COMMENT '解释更新的内容',
  `forcedUpdate` int(1) DEFAULT '0' COMMENT '强制更新，1为强制，0为不强制',
  `phoneModel` int(1) NOT NULL DEFAULT '1' COMMENT '手机型号 1是苹果2是安卓',
  `updateUrl` varchar(200) NOT NULL COMMENT '升级链接',
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='版本升级表';

INSERT INTO `version` VALUES ('1', '2.0', '测试版本_ios', '0', '1', '', '2016-10-11 09:31:53');
INSERT INTO `version` VALUES ('2', '1.0', '测试版本_andriod', '1', '0', 'http://101.201.104.221/YunYi/YunYi.apk', '2016-10-11 09:32:44');
INSERT INTO `version` VALUES ('4', '1.0.0.1', '测试版本2_andriod', '1', '0', 'http://101.201.104.221/YunYi/YunYi.apk', '2016-10-11 14:33:35');
INSERT INTO `version` VALUES ('5', '1.0.2.0', '修复视频通讯bug', '1', '0', 'http://101.201.104.221/YunYi/YunYi.apk', '2016-10-12 17:39:26');
INSERT INTO `version` VALUES ('6', '1.0.2.3', '优化启动速度', '1', '0', 'http://101.201.104.221/YunYi/YunYi.apk', '2016-10-14 16:48:47');

CREATE TABLE suggestion_feedback (
	suggestionId INT (11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '编号',
	userId INT (11) NOT NULL UNIQUE COMMENT '用户id',
	suggestion VARCHAR (2000) NOT NULL DEFAULT '' COMMENT '意见内容',
	suggestionImage VARCHAR (1000) NOT NULL DEFAULT '' COMMENT '意见图片',
	tel VARCHAR (20) NOT NULL COMMENT '手机号',
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8 COMMENT = '意见反馈表';

CREATE TABLE advertisement (
	id INT PRIMARY KEY AUTO_INCREMENT COMMENT '编号',
	advertId INT NOT NULL COMMENT '广告编号',
	advertImage VARCHAR (200) NOT NULL COMMENT '广告图片',
	advertURL VARCHAR (200) NOT NULL COMMENT '广告链接',
	isDel INT (1) NOT NULL DEFAULT 0 COMMENT '是否删除 0为投放，1为不投放',
	join_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '广告的加入时间'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '广告表';

CREATE TABLE attention_hospital (
	id INT PRIMARY KEY AUTO_INCREMENT COMMENT '编号',
	userId INT NOT NULL COMMENT '用户Id',
	hospitalId INT NOT NULL COMMENT '医院Id',
	attention_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '关注时间',
	FOREIGN KEY (hospitalId) REFERENCES hospital_info (hospitalId),
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '关注医院表';

CREATE TABLE attention_doctor (
	id INT PRIMARY KEY AUTO_INCREMENT COMMENT '编号',
	userId INT NOT NULL COMMENT '用户Id',
	doctorId INT NOT NULL COMMENT '医生Id',
	attention_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '关注时间',
	FOREIGN KEY (doctorId) REFERENCES doctor_info (doctorId),
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '关注医生表';

CREATE TABLE user_grade (
	id INT PRIMARY KEY auto_increment COMMENT '编号',
	userId INT NOT NULL UNIQUE COMMENT '用户id',
	userLevel INT NOT NULL COMMENT '用户等级',
	userTotalMark INT NOT NULL COMMENT '用户总经验值',
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '用户等级表';



CREATE TABLE user_sign_in (
	id INT PRIMARY KEY auto_increment COMMENT '编号',
	userId INT NOT NULL COMMENT '用户Id',
	signIn INT NOT NULL DEFAULT 0 COMMENT '用户签到  1 签到，0 未签到',
	signInDate INT NOT NULL COMMENT '用户签到日期',
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '用户签到表';

/*任务列表*/
CREATE TABLE task_info (
	taskId INT PRIMARY KEY auto_increment COMMENT '任务编号',
	taskContent VARCHAR (100) NOT NULL COMMENT '任务详情',
	taskMark INT NOT NULL COMMENT '任务的经验值',
	taskType VARCHAR (20) NOT NULL COMMENT '任务类型 daily newbie'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '任务列表';

INSERT INTO task_info (taskContent,taskMark,taskType)VALUES('分享', 10, 'daily');

/*用户--任务关联表*/
CREATE TABLE user_task (
	id INT PRIMARY KEY auto_increment COMMENT '编号',
	userId INT NOT NULL COMMENT '用户id',
	taskId INT NOT NULL COMMENT '任务id',
	taskState INT NOT NULL DEFAULT 0 COMMENT '任务完成情况 1是完成，0是未完成'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '用户—任务关联表';

/*标签表*/
CREATE TABLE label (
	labelId INT auto_increment PRIMARY KEY COMMENT '标签Id',
	labelName VARCHAR (30) NOT NULL COMMENT '标签名字'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '标签表';

INSERT INTO label (labelName)VALUES('内科、');
INSERT INTO label (labelName)VALUES('外科、');
INSERT INTO label (labelName)VALUES('妇产科、');
INSERT INTO label (labelName)VALUES('男科、');
INSERT INTO label (labelName)VALUES('儿科、');
INSERT INTO label (labelName)VALUES('五官科、');
INSERT INTO label (labelName)VALUES('肿瘤科、');
INSERT INTO label (labelName)VALUES('皮肤性病科、');
INSERT INTO label (labelName)VALUES('中医科、');
INSERT INTO label (labelName)VALUES('传染病科、');
INSERT INTO label (labelName)VALUES('整形美容科、');
INSERT INTO label (labelName)VALUES('营养科、');
INSERT INTO label (labelName)VALUES('麻醉医学科、');
INSERT INTO label (labelName)VALUES('骨科、');
INSERT INTO label (labelName)VALUES('康复医学科、');
INSERT INTO label (labelName)VALUES('介入医学科、');
INSERT INTO label (labelName)VALUES('医学影像科、');
INSERT INTO label (labelName)VALUES('精神心理科、');

/*医生填写病历备注表*/
CREATE TABLE case_history_remark (
	remarkId INT PRIMARY KEY COMMENT '编号',
	remarkName VARCHAR (40) NOT NULL UNIQUE COMMENT '备注名称'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '医生填写病历备注表';

/*就诊记录表*/
CREATE TABLE treat_record (
	treatRecordId INT AUTO_INCREMENT COMMENT '编号',
	userId INT NOT NULL COMMENT '用户id',
	doctorId INT NOT NULL COMMENT '医生id',
	smokingHistory VARCHAR (10) NOT NULL COMMENT '抽烟史',
	allergyHistory VARCHAR (10) NOT NULL COMMENT '过敏史',
	userComplaint VARCHAR (1000) NOT NULL DEFAULT '' COMMENT '主诉',
	userHPC VARCHAR (1000) NOT NULL DEFAULT '' COMMENT '现病史',
	userPMH VARCHAR (300) NOT NULL DEFAULT '' COMMENT '既往史',
	doctorSuggest VARCHAR (1000) NOT NULL DEFAULT '' COMMENT '医生建议',
	remarkId INT NULL COMMENT '描述',
	reportCardDescribe VARCHAR (1000) NOT NULL DEFAULT '' COMMENT '自述卡详情',
	reportCardRemark VARCHAR (100) NOT NULL DEFAULT '' COMMENT '自述卡描述',
	reportCardImage VARCHAR (1000) NOT NULL DEFAULT '' COMMENT '自述卡图片',
	treatTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '接诊日期 yyyy-MM-dd HH:mm:ss',
	PRIMARY KEY (treatRecordId),
	FOREIGN KEY (userId) REFERENCES user_db_info (userId),
	FOREIGN KEY (doctorId) REFERENCES doctor_info (doctorId),
	FOREIGN KEY (remarkId) REFERENCES case_history_remark (remarkId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '就诊记录表';

/*角色表*/
CREATE TABLE role (
	roleId INT auto_increment PRIMARY KEY,
	roleName VARCHAR (100) NOT NULL UNIQUE COMMENT '权限类型'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '角色表';

INSERT INTO role (roleName)VALUES('超级管理员');
INSERT INTO role (roleName)VALUES('普通管理员');
INSERT INTO role (roleName)VALUES('财务统计人员');

/*权限表*/
CREATE TABLE action (
	actionId INT auto_increment PRIMARY KEY COMMENT '权限Id',
	actionName VARCHAR (20) NOT NULL COMMENT '权限名称'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '权限表';

INSERT INTO action (actionName)VALUES('add_hospital');
INSERT INTO action (actionName)VALUES('del_hospital');
INSERT INTO action (actionName)VALUES('mod_hospital');
INSERT INTO action (actionName)VALUES('add_doctor');
INSERT INTO action (actionName)VALUES('del_doctor');
INSERT INTO action (actionName)VALUES('add_manager');
INSERT INTO action (actionName)VALUES('del_manager');
INSERT INTO action (actionName)VALUES('mod_manager');

/*角色—权限表*/
CREATE TABLE role_action (
	roleId INT NOT NULL COMMENT '角色Id',
	actionId INT NOT NULL COMMENT '权限Id',
	FOREIGN KEY (roleId) REFERENCES role (roleId),
	FOREIGN KEY (actionId) REFERENCES action (actionId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '角色—权限表';

/*管理员表*/
CREATE TABLE manager_info (
	managerId INT auto_increment PRIMARY KEY,
	managerName VARCHAR (100) NOT NULL COMMENT '管理员姓名',
	PASSWORD VARCHAR (32) NOT NULL COMMENT '密码',
	systemAdmin INT (1) NOT NULL DEFAULT 0 COMMENT '是否是系统管理员',
	isDel INT NOT NULL DEFAULT 0 COMMENT '是否删除，1为删除'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '管理员表';

INSERT INTO manager_info (managerName, PASSWORD)VALUES('admin', md5('123456'));

/*管理员-医院-角色表*/
CREATE TABLE manager_hospital (
	managerId INT NOT NULL COMMENT '管理员Id，关联到manager_info表',
	hospitalId INT NOT NULL COMMENT '医院Id,关联hospital_info表',
	roleId INT NOT NULL COMMENT '角色Id,关联role表',
	FOREIGN KEY (managerId) REFERENCES manager_info (managerId),
	FOREIGN KEY (hospitalId) REFERENCES hospital_info (hospitalId),
	FOREIGN KEY (roleId) REFERENCES role (roleId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '管理员-医院-角色表';

/*操作类型表*/
CREATE TABLE operation_type (
	operationId INT auto_increment PRIMARY KEY,
	operationName VARCHAR (20) NOT NULL
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '操作类型表';

/*管理员日志表*/
CREATE TABLE manager_log (
	id INT auto_increment PRIMARY KEY,
	managerId INT NOT NULL COMMENT '管理员Id',
	operationId INT NOT NULL COMMENT '操作Id,关联operation_type表',
	operationTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '操作时间',
	operationContent VARCHAR (1000) NOT NULL DEFAULT '' COMMENT '操作内容',
	isDel INT (1) NOT NULL DEFAULT 0 COMMENT '是否删除',
	FOREIGN KEY (managerId) REFERENCES manager_info (managerId),
	FOREIGN KEY (operationId) REFERENCES operation_type (operationId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '管理员日志表';

/*视频记录表*/
DROP TABLE if EXISTS video_history;
CREATE TABLE video_history (
	id INT AUTO_INCREMENT COMMENT '用户排队编号',
	doctorId INT NOT NULL COMMENT '用户id',
	userId INT NOT NULL COMMENT '医生id',
	videoStartTime  VARCHAR(20) NOT NULL DEFAULT ''  COMMENT '视频开始时间',
	videoEndTime    VARCHAR (20) NOT NULL DEFAULT '' COMMENT '视频截止时间',
	videoDuration VARCHAR (20) NOT NULL DEFAULT '' COMMENT '视频时长',
	PRIMARY KEY (id),
	FOREIGN KEY (doctorId) REFERENCES doctor_info (doctorId),
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '视频记录表';

/*填写病历时的就诊卡，从传过来的就诊卡中取数据*/
CREATE TABLE treat_record_report_card (
	id INT AUTO_INCREMENT PRIMARY KEY COMMENT '编号',
	reportCardId INT NOT NULL COMMENT '自述卡Id',
	userId INT NOT NULL COMMENT '用户id',
	reportCardName VARCHAR (100) NOT NULL COMMENT '自述卡名称',
	reportCardDescribe VARCHAR (1000) NULL COMMENT '病情自述',
	reportCardImage VARCHAR (1000) NULL COMMENT '自述卡图片'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '填写病历时的就诊卡';

/*系统参数表*/
CREATE TABLE system_param (
	id INT AUTO_INCREMENT PRIMARY KEY COMMENT '编号',
	paramName VARCHAR (20) NOT NULL UNIQUE COMMENT '系统参数名称',
	paramValue VARCHAR (20) NOT NULL COMMENT '系统参数值',
	unit      VARCHAR(20)  NOT NULL  COMMENT '参数单位',
	modifyTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '参数修改时间'
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '系统参数表';

insert into system_param (paramName,paramValue,unit)VALUES ('get_line_time','5000','毫秒');
insert into system_param (paramName,paramValue,unit)VALUES ('video_duration','600','秒');

/*用户行为表*/
DROP TABLE if EXISTS user_behaviour;
CREATE TABLE user_behaviour (
	behaviourId INT  PRIMARY KEY AUTO_INCREMENT COMMENT '行为编号',
	behaviourName VARCHAR (20) NOT NULL COMMENT '上一次行为',
	userId INT NOT NULL COMMENT '用户id',
	create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '行为日期',
	FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '用户行为表';
