drop table attachments;

drop table mail_contents;

drop table mails;

drop table users;


create table users (
	id int primary key auto_increment,
	email varchar(128) not null,
	password varchar(256)
);

create table mails (
	id int primary key auto_increment,
	senderEmailAddress varchar(50) not null,
	senderName varchar(50) not null,
	subject varchar(200) not null,
	publication_date datetime not null,
	expiration_date datetime not null,
	public Boolean not null, 
	PASSWORD varchar(100),
	views int,
	user_id int not null
);

ALTER TABLE mails ADD CONSTRAINT 
     fk_mails FOREIGN KEY (user_id) 
           REFERENCES users(id) ON DELETE CASCADE;


create table mail_contents (
	id int primary key auto_increment,
	plainText mediumtext,
	htmlText mediumtext,
	mail_id int not null
);
ALTER TABLE mail_contents ADD CONSTRAINT 
     fk_mailContents FOREIGN KEY (mail_id) 
           REFERENCES mails(id) ON DELETE CASCADE;


create table attachments (
	id int primary key auto_increment,
	name varchar(50) not null,
	contentID varchar(50),
	mail_id int not null,
	relation varchar(50) not null
);

ALTER TABLE attachments ADD CONSTRAINT 
     fk_attachments FOREIGN KEY (mail_id) 
           REFERENCES mails(id) ON DELETE CASCADE;

