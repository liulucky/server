## SSE实战例子

当后台发布了新的公告，就将公告推送给客户端。如果没有新的公告，就不推送。



## 创建数据表

create table news(
	id int not null auto_increment,
	title varchar(100) not null comment '公告标题',
	content varchar(20000) not null comment '公告内容',
	status tinyint not null default 1 comment '公告状态 1 未发布 2已发布',
	primary key(id)
)engine=innodb default charset=utf8;

insert into news(title,content) values('测试1','内容1'),('测试2','内容2');
