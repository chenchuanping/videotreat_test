
use videotreat;

/*医生状态表*/
 create table state_info (
  stateId   int PRIMARY KEY  auto_increment ,
  stateName varchar(10) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='医生状态表';
INSERT INTO state_info (stateName) VALUES ('空闲');
INSERT INTO state_info (stateName) VALUES ('忙碌');
INSERT INTO state_info (stateName) VALUES ('离开');

/*医生职称表*/
CREATE TABLE profess_info(
  professId   int PRIMARY KEY  auto_increment ,
  professName varchar(20) not null unique
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='医生职称表';
INSERT INTO profess_info(professName) VALUES ('住院医师');
INSERT INTO profess_info(professName) VALUES ('主治医师');
INSERT INTO profess_info(professName) VALUES ('副主任医师');
INSERT INTO profess_info(professName) VALUES ('主任医师');

/*医生科室表*/
CREATE TABLE department_info(
  departmentId   int PRIMARY KEY  auto_increment ,
  departmentName varchar(20) not null unique,
  departmentExplain varchar(200) default ''
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='医生科室表';
INSERT INTO department_info(departmentName) VALUES ('内科');
INSERT INTO department_info(departmentName) VALUES ('外科');
INSERT INTO department_info(departmentName) VALUES ('妇产科');
INSERT INTO department_info(departmentName) VALUES ('男科');
INSERT INTO department_info(departmentName) VALUES ('儿科');
INSERT INTO department_info(departmentName) VALUES ('五官科');
INSERT INTO department_info(departmentName) VALUES ('肿瘤科');
INSERT INTO department_info(departmentName) VALUES ('皮肤性病科');
INSERT INTO department_info(departmentName) VALUES ('中医科');
INSERT INTO department_info(departmentName) VALUES ('传染病科');
INSERT INTO department_info(departmentName) VALUES ('整形美容科');
INSERT INTO department_info(departmentName) VALUES ('营养科');
INSERT INTO department_info(departmentName) VALUES ('麻醉医学科');
INSERT INTO department_info(departmentName) VALUES ('骨科');
INSERT INTO department_info(departmentName) VALUES ('康复医学科');
INSERT INTO department_info(departmentName) VALUES ('介入医学科');
INSERT INTO department_info(departmentName) VALUES ('医学影像科');
INSERT INTO department_info(departmentName) VALUES ('精神心理科');
INSERT INTO department_info(departmentName) VALUES ('其他科室');

/*医院信息表*/
CREATE TABLE hospital_info (
  hospitalId int  AUTO_INCREMENT PRIMARY KEY COMMENT '编号',
  hospitalName varchar(100) UNIQUE  not null  COMMENT '医院名称',
  hospitalLogo varchar(200)  not null  DEFAULT '' COMMENT '医院Logo',
  hospitalImage varchar(200)  not null DEFAULT '' comment '医院展示图片',
  doctorNumber   int     not null  DEFAULT  0     COMMENT '医院医师数量',
  hospitalAddress  varchar(200)  not null default ''  COMMENT '医院地址',
  labelArray   varchar(400)      not null default ''  COMMENT '医院标签',
  hospitalIntroduction varchar(4000) not null  DEFAULT '' COMMENT '医院简介',
  isDel int(1) not null  DEFAULT 0 COMMENT '1 删除 0为不删除',
  demo  varchar(4000) DEFAULT '' COMMENT '预留字段'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='医院信息表';

/*医生信息表*/
CREATE TABLE doctor_info(
  doctorId          int                PRIMARY KEY AUTO_INCREMENT COMMENT '医生编号',
  doctorName        varchar(32)       NOT NULL   COMMENT '医生姓名',
  password          varchar(32)         NOT NULL COMMENT '医生密码',
  tel               varchar(20)         NOT  NULL UNIQUE  COMMENT  '医生手机号',
  stateId           int                NOT NULL DEFAULT 3 COMMENT '医生状态  关联state_info表',
  professId         int                 NOT NULL   COMMENT '职称 关联profess_info表',
  departmentId      int                NOT NULL  COMMENT '科室 关联department_info表',
  sex                int(1)                NULL  COMMENT '性别 0为男，1为女，2为未知',
  age                int(4)              NOT NULL    COMMENT '年龄',
  headPic            varchar(128)        NOT NULL DEFAULT  'E:/wamp/www/videotreat/Public/doctorImages/default.png' COMMENT '医生头像',
  special            varchar(4000)       NOT NULL DEFAULT '' COMMENT '医生特长',
  profile            varchar(128)        NOT NULL DEFAULT '' COMMENT '医生个人简介',
  hospitalId        int                 NOT NULL  COMMENT '医院信息,关联hospital_info表',
  isDel             int(1)              not null  DEFAULT 0 COMMENT '1 删除 0为不删除',
  labelArray        varchar(400)      not null default ''  COMMENT '医生个人标签',
  create_time timestamp DEFAULT current_timestamp,
  foreign key (stateId) references state_info(stateId),
  foreign key (professId) references profess_info(professId),
  foreign key (departmentId) references department_info(departmentId),
   foreign key (hospitalId) references hospital_info(hospitalId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='医生信息表';

CREATE TABLE qq_info(
  id                    int  PRIMARY KEY auto_increment COMMENT '编号',
  userId                int  not null COMMENT '用户编号',
  qq_key                varchar(100) NOT NULL COMMENT '第三方登录Id',
  nickName              VARCHAR(100) DEFAULT '' COMMENT '昵称',
  headPic               varchar(200) DEFAULT '' COMMENT '第三方登录头像',
  login_time           timestamp DEFAULT current_timestamp
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第三方QQ登录表';



CREATE TABLE wechat_info(
  id                    int  PRIMARY KEY auto_increment COMMENT '编号',
  userId                int  not null COMMENT  '用户编号',
  wechat_key             varchar(100)  NOT NULL COMMENT '第三方登录Id',
  nickName              VARCHAR(100) DEFAULT ''  COMMENT '昵称',
  headPic             varchar(200) DEFAULT '' COMMENT '第三方登录头像',
  login_time          timestamp DEFAULT current_timestamp
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第三方微信登录表';


CREATE TABLE blog_info(
  id                    int  PRIMARY KEY auto_increment COMMENT '编号',
  userId                int  not null  COMMENT '用户编号',
  blog_key                varchar(100)   NOT NULL COMMENT '第三方登录Id',
  nickName             VARCHAR(100) DEFAULT ''  COMMENT '昵称',
  headPic              varchar(200) DEFAULT '' COMMENT '第三方登录头像',
  login_time          timestamp DEFAULT current_timestamp
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第三方微博登录表';

CREATE TABLE user_db_info(
  userId                int  PRIMARY KEY auto_increment COMMENT '编号',
  tel                   VARCHAR(20)   DEFAULT '' COMMENT '手机号',
  password             VARCHAR(40)    DEFAULT '' COMMENT '密码',
  imei                  VARCHAR (20)  not null  DEFAULT ''  COMMENT '手机的唯一识别号码',
  third_type           VARCHAR (20)  DEFAULT '' COMMENT '第三方登录类型',
  qq_key             VARCHAR(64)   DEFAULT  '' COMMENT '第三方登录QQ的唯一标识',
  wechat_key         VARCHAR(64)  DEFAULT  '' COMMENT '第三方登录微信的唯一标识',
  blog_key           VARCHAR(64)  DEFAULT  '' COMMENT '第三方登录微博唯一标识',
  client               int(1)     DEFAULT '1' COMMENT '手机型号 1是苹果0是安卓',
  create_time         timestamp DEFAULT current_timestamp
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户登录信息表';


CREATE TABLE user_base_info(
  id                   int  PRIMARY KEY auto_increment COMMENT '编号',
  userId              int   not null   COMMENT '用户Id',
  userName            VARCHAR(50) not null  DEFAULT '' COMMENT '姓名',
  sex                 int(1)  null   COMMENT '性别 0为男，1为女，2为未知',
  birthday            VARCHAR(40)  DEFAULT '' COMMENT '出生日期',
  address             varchar(128)  DEFAULT '' COMMENT '地址',
  blood               varchar(8) DEFAULT '' COMMENT '血型',
  stature             varchar(10)   DEFAULT '' COMMENT '身高',
  weight              varchar(10)  DEFAULT '' COMMENT '体重',
  identityCardNum    varchar(20) DEFAULT '' COMMENT '身份证号',
  headPic             varchar(200) DEFAULT '' COMMENT '个人头像',
  userSmoking         VARCHAR (10)  DEFAULT '无'   COMMENT '有 或 无',
  create_time       timestamp DEFAULT current_timestamp,
  FOREIGN KEY (userId) REFERENCES user_db_info (userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户基本信息表';

/*患者排队信息表*/
CREATE TABLE user_line (
  id         int    AUTO_INCREMENT COMMENT '用户排队编号',
  doctorId   int   NOT NULL COMMENT '用户id',
  userId     int   NOT  NULL UNIQUE COMMENT '医生id',
  reportCardId  int  null UNIQUE  comment '自述卡Id',
  create_time timestamp DEFAULT current_timestamp,
  PRIMARY KEY (id),
  FOREIGN KEY (doctorId) REFERENCES doctor_info (doctorId),
  FOREIGN KEY (userId) REFERENCES user_db_info (userId),
  FOREIGN KEY (reportCardId) REFERENCES user_report_card (reportCardId)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户排队信息表';

CREATE TABLE version_update(
  id int PRIMARY KEY  AUTO_INCREMENT COMMENT '编号',
  content varchar(4000) NOT NULL DEFAULT '' COMMENT '解释更新的内容',
  name varchar(100) NOT NULL DEFAULT '云医视讯' COMMENT '版本名称',
  phoneModel int(1)  NOT NULL  DEFAULT 1 COMMENT '手机型号 1是苹果2是安卓',
  updateUrl varchar(200) NOT NULL COMMENT '升级链接',
  version varchar(32) NOT NULL  COMMENT '版本号',
  updateTime timestamp DEFAULT current_timestamp COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='版本升级表';

CREATE TABLE advertisement(
  id int PRIMARY KEY  AUTO_INCREMENT COMMENT '编号',
  advertId int not null   COMMENT '广告编号',
  advertImage varchar(200) NOT NULL  COMMENT '广告图片',
  advertURL varchar(200) NOT NULL  COMMENT '广告链接',
  isDel  int(1) not null DEFAULT 0 comment '是否删除 0为投放，1为不投放',
  join_time timestamp DEFAULT current_timestamp COMMENT '广告的加入时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='广告表';

CREATE TABLE attention_hospital(
  id int PRIMARY KEY  AUTO_INCREMENT COMMENT '编号',
  userId int not null   COMMENT '用户Id',
  hospitalId int NOT NULL  COMMENT '医院Id',
  attention_time timestamp DEFAULT current_timestamp COMMENT '关注时间',
  FOREIGN KEY (hospitalId) REFERENCES hospital_info (hospitalId),
  FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关注医院表';


CREATE TABLE attention_doctor(
  id int PRIMARY KEY  AUTO_INCREMENT COMMENT '编号',
  userId int not null   COMMENT '用户Id',
  doctorId int NOT NULL  COMMENT '医生Id',
  attention_time timestamp DEFAULT current_timestamp COMMENT '关注时间',
  FOREIGN KEY (doctorId) REFERENCES doctor_info (doctorId),
  FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关注医生表';


create table user_grade(
    id                    int     PRIMARY KEY     auto_increment comment '编号',
    userId               int      not null       unique   comment '用户id',
    userLevel            int      not null        comment '用户等级',
    userTotalMark       int       not null       comment '用户总经验值',
    foreign key (userId) references user_db_info (userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户等级表';

create table user_sign_in(
    id              int            primary  key  auto_increment  comment '编号',
    userId         int            not null           comment '用户Id',
    signIn         int            not null default 0           comment '用户签到  1 签到，0 未签到',
    signInDate     int           not null    comment '用户签到日期',
    foreign key (userId) references user_db_info (userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户签到表';


/*任务列表*/
create table task_info(
    taskId          int                 PRIMARY KEY     auto_increment comment '任务编号',
    taskContent    varchar(100)        not null         comment '任务详情',
    taskMark        int                 not null        comment '任务的经验值',
    taskType         varchar(20)        not null        comment '任务类型 daily newbie'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务列表';

insert into task_info(taskContent,taskMark,taskType) VALUES ('分享',10,'daily');
insert into task_info(taskContent,taskMark,taskType) VALUES ('关注10个医生',50,'daily');
insert into task_info(taskContent,taskMark,taskType) VALUES ('关注10家医院',50,'daily');
insert into task_info(taskContent,taskMark,taskType) VALUES ('绑定手机号',10,'newbie');
insert into task_info(taskContent,taskMark,taskType) VALUES ('填写信息',10,'newbie');

/*用户--任务关联表*/
create table user_task(
    id        int     PRIMARY KEY     auto_increment comment '编号',
    userId   int      not null        comment '用户id',
    taskId   int      not null        comment '任务id',
    taskState    int      not null        default  0       comment '任务完成情况 1是完成，0是未完成'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户—任务关联表';

/*标签表*/
create table label(
  labelId     int            auto_increment        primary key    comment '标签Id',
  labelName   varchar(30) not null          comment '标签名字'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='标签表';
INSERT INTO label(labelName) VALUES ('内科、');
INSERT INTO label(labelName) VALUES ('外科、');
INSERT INTO label(labelName) VALUES ('妇产科、');
INSERT INTO label(labelName) VALUES ('男科、');
INSERT INTO label(labelName) VALUES ('儿科、');
INSERT INTO label(labelName) VALUES ('五官科、');
INSERT INTO label(labelName) VALUES ('肿瘤科、');
INSERT INTO label(labelName) VALUES ('皮肤性病科、');
INSERT INTO label(labelName) VALUES ('中医科、');
INSERT INTO label(labelName) VALUES ('传染病科、');
INSERT INTO label(labelName) VALUES ('整形美容科、');
INSERT INTO label(labelName) VALUES ('营养科、');
INSERT INTO label(labelName) VALUES ('麻醉医学科、');
INSERT INTO label(labelName) VALUES ('骨科、');
INSERT INTO label(labelName) VALUES ('康复医学科、');
INSERT INTO label(labelName) VALUES ('介入医学科、');
INSERT INTO label(labelName) VALUES ('医学影像科、');
INSERT INTO label(labelName) VALUES ('精神心理科、');


/*自述表*/
create table user_report_card(
   reportCardId         int   auto_increment    primary key  comment '自述卡Id',
   userId                int           NOT  NULL comment '用户id',
   reportCardName       varchar(100)   not null  comment '自述卡名称',
   reportCardDescribe   varchar(1000)  null comment '病情自述',
   reportCardRemark     varchar(1000)   null   comment '备注说明',
   reportCardImage       varchar(1000)   null   comment '自述卡图片',
   FOREIGN KEY (userId) REFERENCES user_db_info (userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='自述卡';


/*就诊记录表*/
CREATE TABLE treat_record(
  treatRecordId                    int             AUTO_INCREMENT COMMENT '编号',
  userId            int            NOT  NULL        COMMENT '用户id',
  doctorId          int            NOT NULL         COMMENT '医生id',
  smokingHistory   varchar(10)    NOT  NULL        COMMENT '抽烟史',
  allergyHistory   varchar(10)    NOT  NULL        COMMENT '过敏史',
  userComplaint    varchar(1000)   NOT  NULL       DEFAULT '' COMMENT '主诉',
  userHPC          varchar(1000)   NOT  NULL        DEFAULT  '' COMMENT '现病史',
  userPMH          varchar(300)   NOT NULL         DEFAULT ''  comment '既往史',
  doctorSuggest    varchar(1000)   NOT  NULL        DEFAULT  '' COMMENT '医生建议',
  remark            varchar(500)   not null         default ''  comment '描述 掉线，超时未接等',
  reportCardDescribe   varchar(1000) not null     default '' comment '自述卡详情',
  reportCardRemark     varchar(100)  not null      default '' comment '自述卡描述',
  reportCardImage       varchar(1000)  not null     default ''  comment '自述卡图片',
  treatTime        timestamp      DEFAULT current_timestamp COMMENT '接诊日期 yyyy-MM-dd HH:mm:ss',
  PRIMARY KEY (treatRecordId),
  FOREIGN KEY (userId) REFERENCES user_db_info (userId),
  FOREIGN KEY (doctorId) REFERENCES doctor_info (doctorId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='就诊记录表';


/*角色表*/
create table role(
	roleId			 	      int	 			    auto_increment	 		primary key,
	roleName	 	        varchar(100) 	not null  unique         comment '权限类型'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色表';
insert into role (roleName)VALUES ('超级管理员');
insert into role (roleName)VALUES ('普通管理员');
insert into role (roleName)VALUES ('财务统计人员');

/*权限表*/
create table action(
    actionId     int             auto_increment   primary key  comment '权限Id',
    actionName        varchar(20)    not null  comment '权限名称'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限表';
insert into action(actionName)values('add_hospital');
insert into action(actionName)values('del_hospital');
insert into action(actionName)values('mod_hospital');

insert into action(actionName)values('add_doctor');
insert into action(actionName)values('del_doctor');

insert into action(actionName)values('add_manager');
insert into action(actionName)values('del_manager');
insert into action(actionName)values('mod_manager');

/*角色—权限表*/
create table role_action(
    roleId          int           not null          comment '角色Id',
    actionId        int           not null          comment '权限Id',
	  foreign key (roleId)    references      role(roleId),
	  foreign key (actionId)  references      action(actionId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色—权限表';

/*管理员表*/
create table manager_info(
	managerId			 	      int	 			    auto_increment	 		primary key,
	managerName	 	varchar(100) 	not null           comment '管理员姓名',
	password	 	    varchar(32) 	not null           comment '密码',
	isDel           int             not null DEFAULT  0 comment '是否删除，1为删除'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';
insert into manager_info(managerName,password)values('admin',md5('123456'));

/*管理员-医院-角色表*/
create table manager_hospital(
	managerId      int         	not null           comment '管理员Id，关联到manager_info表',
  hospitalId     int          NOT NULL           COMMENT '医院Id,关联hospital_info表',
  roleId          int           not null          comment '角色Id,关联role表',
  foreign key (managerId)     references      manager_info(managerId),
  foreign key (hospitalId)    references      hospital_info(hospitalId),
  foreign key (roleId)       references      role(roleId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员-医院-角色表';

/*操作类型表*/
create table operation_type(
  operationId int auto_increment primary key,
  operationName varchar(20) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作类型表';


/*管理员日志表*/
create table manager_log(
	id			 	      int	 			    auto_increment	 		primary key,
	managerId      int         	not null           comment '管理员Id',
	operationId     int          NOT NULL           COMMENT '操作Id,关联operation_type表',
	operationTime         timestamp      DEFAULT current_timestamp COMMENT '操作时间',
	operationContent      varchar(1000) not null           default '' comment '操作内容',
  isDel           int(1)       not null           default 0  comment '是否删除',
  foreign key (managerId)     references        manager_info(managerId),
  foreign key (operationId)     references      operation_type(operationId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员日志表';

/*视频记录表*/
CREATE TABLE video_history (
  id         int    AUTO_INCREMENT COMMENT '用户排队编号',
  doctorId   int   NOT NULL COMMENT '用户id',
  userId     int   NOT NULL COMMENT '医生id',
  videoDuration   varchar(20) not  null  DEFAULT ''  COMMENT '视频时长',
  create_time timestamp DEFAULT current_timestamp,
  PRIMARY KEY (id),
  FOREIGN KEY (doctorId) REFERENCES doctor_info (doctorId),
  FOREIGN KEY (userId) REFERENCES user_db_info (userId)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='视频记录表';

/*填写病历时的就诊卡，从传过来的就诊卡中取数据*/
create table treat_record_report_card(
    id         int    AUTO_INCREMENT  primary key  COMMENT '编号',
   reportCardId         int    not null comment '自述卡Id',
   userId                int           NOT  NULL comment '用户id',
   reportCardName       varchar(100)   not null  comment '自述卡名称',
   reportCardDescribe   varchar(1000)  null comment '病情自述',
   reportCardImage       varchar(1000)   null   comment '自述卡图片'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='填写病历时的就诊卡';

/*系统参数表*/
create table system_param(
    id         int    AUTO_INCREMENT  primary key  COMMENT '编号',
    paramName  varchar(20) not null UNIQUE comment '系统参数名称',
    paramValue varchar(20) not null comment '系统参数值',
    modifyTime  TIMESTAMP  DEFAULT  CURRENT_TIMESTAMP comment '参数修改时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统参数表';