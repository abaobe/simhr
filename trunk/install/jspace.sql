CREATE TABLE wane_ad (
  aid smallint(6) unsigned NOT NULL auto_increment,
  context text NOT NULL,
  PRIMARY KEY  (aid)
) ;

CREATE TABLE wane_find_fav (
  id int(12) unsigned NOT NULL auto_increment,
  user_id varchar(50) NOT NULL default '',
  find_id int(12) unsigned NOT NULL default '0',
  addtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY user_id (user_id),
  KEY find_id (find_id),
  KEY id (id)
) ;

CREATE TABLE wane_findjob_chance (
  id int(12) unsigned NOT NULL auto_increment,
  tid smallint(6) unsigned NOT NULL default '0',
  username varchar(50) NOT NULL default '',
  job varchar(50) NOT NULL default '',
  puttime int(10) unsigned NOT NULL default '0',
  losetime int(10) unsigned NOT NULL default '0',
  contact_name varchar(10) NOT NULL default '',
  contact_phone varchar(30) NOT NULL default '',
  interest varchar(255) NOT NULL default '',
  well varchar(255) NOT NULL default '',
  jobtext text NOT NULL,
  work_address varchar(100) NOT NULL default '',
  sign tinyint(1) unsigned NOT NULL default '0',
  click int(12) unsigned NOT NULL default '0',
  htmlroot varchar(10) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY tid (tid),
  KEY username (username),
  KEY job (job),
  KEY sign (sign),
  KEY htmlroot (htmlroot)
);

CREATE TABLE wane_hunter_com (
  id int(12) unsigned NOT NULL auto_increment,
  username varchar(50) NOT NULL default '',
  job varchar(100) NOT NULL default '',
  job_text text NOT NULL,
  job_address varchar(255) NOT NULL default '',
  addtime int(10) unsigned NOT NULL default '0',
  losetime int(10) unsigned NOT NULL default '0',
  sign tinyint(1) NOT NULL default '0',
  click int(12) unsigned NOT NULL default '0',
  htmlroot varchar(10) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY username (username),
  KEY job (job),
  KEY sign (sign)
);

CREATE TABLE wane_hunter_info (
  id int(12) unsigned NOT NULL auto_increment,
  replies smallint(6) unsigned NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  itfrom varchar(100) NOT NULL default '',
  context mediumtext NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  htmlroot varchar(10) NOT NULL default '',
  click int(12) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY title (title),
  KEY htmlroot (htmlroot)
);

CREATE TABLE wane_hunter_info_re (
  id int(12) unsigned NOT NULL auto_increment,
  info_id int(12) unsigned NOT NULL default '0',
  context text NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY info_id (info_id)
);

CREATE TABLE wane_hunter_per (
  id int(12) unsigned NOT NULL auto_increment,
  username varchar(50) NOT NULL default '',
  truename varchar(16) NOT NULL default '',
  year_pay varchar(100) NOT NULL default '',
  industry varchar(250) NOT NULL default '',
  year_pay_for varchar(100) NOT NULL default '',
  position varchar(100) NOT NULL default '',
  for_position varchar(100) NOT NULL default '',
  mobile varchar(22) NOT NULL default '',
  address varchar(255) NOT NULL default '',
  phone varchar(20) NOT NULL default '',
  code varchar(12) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  linktime varchar(100) NOT NULL default '',
  sex varchar(10) NOT NULL default '',
  birth varchar(40) NOT NULL default '',
  sidcard varchar(36) NOT NULL default '',
  marry varchar(20) NOT NULL default '',
  hukou varchar(100) NOT NULL default '',
  living varchar(100) NOT NULL default '',
  forliving varchar(100) NOT NULL default '',
  edu varchar(40) NOT NULL default '',
  graedu varchar(50) NOT NULL default '',
  depart varchar(200) NOT NULL default '',
  train text NOT NULL,
  workexp text NOT NULL,
  enable text NOT NULL,
  context text NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  losetime int(10) unsigned NOT NULL default '0',
  sign tinyint(1) unsigned NOT NULL default '0',
  click int(12) unsigned NOT NULL default '0',
  htmlroot varchar(10) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY username (username),
  KEY truename (truename),
  KEY htmlroot (htmlroot),
  KEY sign (sign)
);

CREATE TABLE wane_index_news (
  id int(12) unsigned NOT NULL auto_increment,
  replies smallint(6) unsigned NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  context mediumtext NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  click int(12) unsigned NOT NULL default '0',
  htmlroot varchar(10) NOT NULL default '',
  itfrom varchar(100) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY title (title),
  KEY htmlroot (htmlroot)
);

CREATE TABLE wane_index_news_re (
  id int(12) unsigned NOT NULL auto_increment,
  news_id int(12) unsigned NOT NULL default '0',
  context text NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY news_id (news_id)
);

CREATE TABLE wane_jianli (
  id int(20) NOT NULL auto_increment,
  username varchar(50) NOT NULL default '',
  truename varchar(20) NOT NULL default '',
  sex varchar(10) NOT NULL default '',
  mingzu varchar(30) NOT NULL default '',
  birth varchar(20) NOT NULL default '',
  hukou varchar(255) NOT NULL default '',
  juzhudi varchar(255) NOT NULL default '',
  shengfengzhen varchar(36) NOT NULL default '',
  marry varchar(10) NOT NULL default '',
  social varchar(20) NOT NULL default '',
  height varchar(5) NOT NULL default '',
  weight varchar(5) NOT NULL default '',
  ear varchar(10) NOT NULL default '',
  jobtoknow varchar(10) NOT NULL default '',
  money varchar(9) NOT NULL default '',
  graedu varchar(100) NOT NULL default '',
  edu varchar(100) NOT NULL default '',
  graedutime varchar(30) NOT NULL default '',
  zhuanye varchar(100) NOT NULL default '',
  zhuanyename varchar(50) NOT NULL default '',
  phone varchar(22) NOT NULL default '',
  handphone varchar(22) NOT NULL default '',
  comphone varchar(22) NOT NULL default '',
  email varchar(50) NOT NULL default '',
  qq varchar(30) NOT NULL default '',
  address varchar(255) NOT NULL default '',
  youbian varchar(12) NOT NULL default '',
  homepage varchar(100) NOT NULL default '',
  jobpro varchar(50) NOT NULL default '',
  formoney varchar(20) NOT NULL default '',
  forjob varchar(50) NOT NULL default '',
  jobkind varchar(50) NOT NULL default '',
  compro varchar(80) NOT NULL default '',
  jobaddress varchar(255) NOT NULL default '',
  forhouse varchar(20) NOT NULL default '',
  leavejobtime varchar(20) NOT NULL default '',
  workjingli text NOT NULL,
  engname varchar(20) NOT NULL default '',
  engnengli varchar(20) NOT NULL default '',
  edujingli text NOT NULL,
  zhengshu text NOT NULL,
  itable text NOT NULL,
  jiangli text NOT NULL,
  edushijian text NOT NULL,
  shijiankind varchar(100) NOT NULL default '',
  shijianname varchar(100) NOT NULL default '',
  shijianjianjie text NOT NULL,
  techang text NOT NULL,
  pingjia text NOT NULL,
  mem_img varchar(100) NOT NULL default '',
  sign tinyint(1) unsigned NOT NULL default '0',
  clicked int(12) NOT NULL default '0',
  lastupdate int(10) unsigned NOT NULL default '10',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY username (username),
  KEY truename (truename),
  KEY sex (sex),
  KEY graedu (graedu),
  KEY edu (edu),
  KEY zhuanye (zhuanye),
  KEY zhuanyename (zhuanyename)
);

CREATE TABLE wane_jianliqy (
  qyid int(12) NOT NULL auto_increment,
  qyuser varchar(50) NOT NULL default '',
  qyname varchar(255) NOT NULL default '',
  qyaddress varchar(255) NOT NULL default '',
  qypro varchar(40) NOT NULL default '',
  qykind varchar(100) NOT NULL default '',
  qyman varchar(12) NOT NULL default '',
  contact_name varchar(20) NOT NULL default '',
  qyphone varchar(255) NOT NULL default '',
  qyemail varchar(150) NOT NULL default '',
  qyyoubian varchar(24) NOT NULL default '',
  qyweb varchar(100) NOT NULL default '',
  qyjianjie text NOT NULL,
  qy_img varchar(100) NOT NULL default '',
  sign tinyint(1) unsigned NOT NULL default '0',
  clicked int(12) NOT NULL default '0',
  lastupdate int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (qyid),
  KEY qyid (qyid),
  KEY qyuser (qyuser),
  KEY qyname (qyname),
  KEY qypro (qypro),
  KEY qykind (qykind),
  KEY sign (sign)
);

CREATE TABLE wane_job_chance (
  id int(12) unsigned NOT NULL auto_increment,
  tid smallint(6) unsigned NOT NULL default '0',
  username varchar(50) NOT NULL default '',
  job varchar(100) NOT NULL default '',
  man varchar(20) NOT NULL default '',
  address varchar(255) NOT NULL default '',
  job_pro varchar(10) NOT NULL default '',
  job_time varchar(20) NOT NULL default '',
  age varchar(20) NOT NULL default '',
  sex varchar(20) NOT NULL default '',
  height varchar(20) NOT NULL default '',
  weight varchar(20) NOT NULL default '',
  sight varchar(20) NOT NULL default '',
  social varchar(10) NOT NULL default '',
  edu varchar(10) NOT NULL default '',
  eng varchar(10) NOT NULL default '',
  depart varchar(100) NOT NULL default '',
  department varchar(20) NOT NULL default '',
  puttime int(10) NOT NULL default '0',
  losetime int(10) NOT NULL default '0',
  worktext text NOT NULL,
  money varchar(30) NOT NULL default '',
  sign tinyint(1) NOT NULL default '0',
  click int(12) NOT NULL default '1',
  htmlroot varchar(10) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY tid (tid),
  KEY username (username),
  KEY job (job),
  KEY sex (sex),
  KEY edu (edu),
  KEY department (department),
  KEY sign (sign)
);

CREATE TABLE wane_job_fav (
  id int(12) unsigned NOT NULL auto_increment,
  user_id varchar(50) NOT NULL default '',
  job_id int(12) unsigned NOT NULL default '0',
  addtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY user_id (user_id),
  KEY job_id (job_id)
);

CREATE TABLE wane_job_law (
  id int(12) unsigned NOT NULL auto_increment,
  replies smallint(6) unsigned NOT NULL default '0',
  itfrom varchar(100) NOT NULL default '',
  title varchar(100) NOT NULL default '',
  context mediumtext NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  click int(12) unsigned NOT NULL default '0',
  htmlroot varchar(10) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY title (title)
);

CREATE TABLE wane_job_law_re (
  id int(12) unsigned NOT NULL auto_increment,
  law_id int(12) unsigned NOT NULL default '0',
  context text NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY law_id (law_id)
);

CREATE TABLE wane_job_peixun (
  id int(12) unsigned NOT NULL auto_increment,
  username varchar(50) NOT NULL default '',
  lesson varchar(100) NOT NULL default '',
  leixing smallint(6) unsigned NOT NULL default '0',
  part varchar(100) NOT NULL default '',
  start_time varchar(100) NOT NULL default '',
  class_time varchar(100) NOT NULL default '',
  address varchar(255) NOT NULL default '',
  classs varchar(10) NOT NULL default '',
  teacher varchar(200) NOT NULL default '',
  money varchar(12) NOT NULL default '',
  direction text NOT NULL,
  content text NOT NULL,
  context text NOT NULL,
  contact_name varchar(20) NOT NULL default '',
  contact_phone varchar(50) NOT NULL default '',
  fax varchar(30) NOT NULL default '',
  email varchar(80) NOT NULL default '',
  url varchar(50) NOT NULL default '',
  puttime int(10) unsigned NOT NULL default '0',
  losetime int(10) unsigned NOT NULL default '0',
  click int(12) unsigned NOT NULL default '0',
  sign tinyint(1) unsigned NOT NULL default '0',
  htmlroot varchar(10) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY username (username),
  KEY lesson (lesson),
  KEY leixing (leixing)
);

CREATE TABLE wane_job_peixunkind (
  id smallint(6) unsigned NOT NULL auto_increment,
  title varchar(50) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY id (id)
);

CREATE TABLE wane_job_type (
  tid smallint(6) unsigned NOT NULL auto_increment,
  title varchar(50) NOT NULL default '',
  orderid mediumint(6) unsigned NOT NULL default '0',
  PRIMARY KEY  (tid),
  KEY tid (tid),
  KEY orderid (orderid)
);

CREATE TABLE wane_job_way (
  id int(12) unsigned NOT NULL auto_increment,
  replies smallint(6) unsigned NOT NULL default '0',
  itfrom varchar(100) NOT NULL default '',
  title varchar(100) NOT NULL default '',
  context mediumtext NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  click int(12) unsigned NOT NULL default '0',
  htmlroot varchar(10) NOT NULL default '',
  PRIMARY KEY  (id,click),
  KEY id (id),
  KEY title (title)
);

CREATE TABLE wane_job_way_re (
  id int(12) unsigned NOT NULL auto_increment,
  way_id int(12) unsigned NOT NULL default '0',
  context text NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
);


CREATE TABLE wane_links (
  id smallint(4) unsigned NOT NULL auto_increment,
  title varchar(50) NOT NULL default '',
  img varchar(80) NOT NULL default '',
  url varchar(80) NOT NULL default '',
  context varchar(50) NOT NULL default '',
  orderid smallint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY orderid (orderid)
);
INSERT INTO wane_links VALUES (1, 'SimPHP', 'http://www.php365.cn/logo.gif', 'http://www.php365.cn', 'SimHR πŸ∑Ω÷ß≥÷Õ¯’æ', 0);

CREATE TABLE wane_member (
  id int(12) unsigned NOT NULL auto_increment,
  username varchar(50) NOT NULL default '',
  password varchar(32) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  kind tinyint(2) NOT NULL default '0',
  vip tinyint(1) unsigned NOT NULL default '0',
  info_sign tinyint(1) NOT NULL default '0',
  question varchar(200) NOT NULL default '',
  answer varchar(200) NOT NULL default '',
  regtime int(10) unsigned NOT NULL default '0',
  losetime int(10) unsigned NOT NULL default '0',
  logins int(12) unsigned NOT NULL default '1',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY username (username),
  KEY password (password),
  KEY kind (kind),
  KEY vip (vip),
  KEY info_sign (info_sign)
);

CREATE TABLE wane_per_rec (
  id int(12) NOT NULL auto_increment,
  isnew tinyint(1) unsigned NOT NULL default '0',
  replies smallint(6) unsigned NOT NULL default '0',
  info_id int(12) NOT NULL default '0',
  user_id varchar(50) NOT NULL default '',
  per_id varchar(50) NOT NULL default '',
  find_id int(12) unsigned NOT NULL default '0',
  author varchar(50) NOT NULL default '',
  title varchar(100) NOT NULL default '',
  context mediumtext NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY isnew (isnew),
  KEY id (id),
  KEY info_id (info_id),
  KEY user_id (user_id),
  KEY per_id (per_id),
  KEY replies (replies)
);

CREATE TABLE wane_per_send (
  id int(12) unsigned NOT NULL auto_increment,
  isnew tinyint(1) unsigned NOT NULL default '0',
  replies smallint(6) unsigned NOT NULL default '0',
  info_id int(12) unsigned NOT NULL default '0',
  user_id varchar(50) NOT NULL default '',
  com_id varchar(50) NOT NULL default '',
  job_id int(12) unsigned NOT NULL default '0',
  author varchar(50) NOT NULL default '',
  title varchar(100) NOT NULL default '',
  context mediumtext NOT NULL,
  addtime int(10) NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY isnew (isnew),
  KEY replies (replies),
  KEY info_id (info_id),
  KEY user_id (user_id),
  KEY com_id (com_id),
  KEY job_id (job_id)
);

CREATE TABLE wane_pxschool (
  id int(12) unsigned NOT NULL auto_increment,
  username varchar(50) NOT NULL default '',
  schkind smallint(6) unsigned NOT NULL default '0',
  sname varchar(100) NOT NULL default '',
  context text NOT NULL,
  content text NOT NULL,
  sign_content text NOT NULL,
  contact_name varchar(50) NOT NULL default '',
  contact_phone varchar(80) NOT NULL default '',
  fax varchar(80) NOT NULL default '',
  address varchar(255) NOT NULL default '',
  code varchar(12) NOT NULL default '',
  email varchar(80) NOT NULL default '',
  url varchar(50) NOT NULL default '',
  click int(12) NOT NULL default '0',
  addtime int(10) NOT NULL default '0',
  sign tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY username (username),
  KEY schkind (schkind),
  KEY sname (sname)
);

CREATE TABLE wane_pxschool_kind (
  id smallint(6) unsigned NOT NULL auto_increment,
  title varchar(50) NOT NULL default '',
  orderid smallint(6) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY orderid (orderid)
) ;

CREATE TABLE wane_send_hunter_com (
  id int(12) unsigned NOT NULL auto_increment,
  isnew tinyint(1) unsigned NOT NULL default '0',
  replies smallint(6) unsigned NOT NULL default '0',
  info_id int(12) unsigned NOT NULL default '0',
  job_id int(12) unsigned NOT NULL default '0',
  rec varchar(50) NOT NULL default '',
  send varchar(50) NOT NULL default '',
  author varchar(50) NOT NULL default '',
  title varchar(100) NOT NULL default '',
  context text NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY isnew (isnew),
  KEY replies (replies),
  KEY info_id (info_id),
  KEY job_id (job_id),
  KEY rec (rec),
  KEY send (send)
);

CREATE TABLE wane_send_hunter_per (
  id int(12) unsigned NOT NULL auto_increment,
  isnew tinyint(1) NOT NULL default '0',
  replies smallint(6) NOT NULL default '0',
  info_id int(12) unsigned NOT NULL default '0',
  find_id int(12) unsigned NOT NULL default '0',
  rec varchar(50) NOT NULL default '',
  send varchar(50) NOT NULL default '',
  author varchar(50) NOT NULL default '',
  title varchar(100) NOT NULL default '',
  context mediumtext NOT NULL,
  addtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY isnew (isnew),
  KEY replies (replies),
  KEY info_id (info_id),
  KEY find_id (find_id),
  KEY rec (rec),
  KEY send (send)
) ;

CREATE TABLE wane_session (
  id int(12) unsigned NOT NULL auto_increment,
  sessid varchar(32) NOT NULL default '',
  username varchar(50) NOT NULL default '',
  activetime int(10) unsigned NOT NULL default '0',
  linkurl varchar(100) NOT NULL default '',
  ipadd varchar(16) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY sessid (sessid),
  KEY username (username),
  KEY activetime (activetime)
) ;

CREATE TABLE wane_teacher_find (
  id int(12) unsigned NOT NULL auto_increment,
  username varchar(50) NOT NULL default '',
  title varchar(200) NOT NULL default '',
  truename varchar(20) NOT NULL default '',
  sex varchar(4) NOT NULL default '',
  edu varchar(30) NOT NULL default '',
  depart varchar(50) NOT NULL default '',
  living varchar(255) NOT NULL default '',
  job varchar(100) NOT NULL default '',
  context text NOT NULL,
  phone varchar(40) NOT NULL default '',
  email varchar(50) NOT NULL default '',
  puttime int(10) unsigned NOT NULL default '0',
  losetime int(10) unsigned NOT NULL default '0',
  sign tinyint(1) unsigned NOT NULL default '0',
  htmlroot varchar(10) NOT NULL default '',
  click int(12) unsigned NOT NULL default '1',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY username (username),
  KEY title (title),
  KEY truename (truename),
  KEY sex (sex),
  KEY edu (edu),
  KEY depart (depart),
  KEY job (job)
);

CREATE TABLE wane_teacher_job (
  id int(12) unsigned NOT NULL auto_increment,
  username varchar(50) NOT NULL default '',
  title varchar(200) NOT NULL default '',
  sex varchar(8) NOT NULL default '',
  edu varchar(20) NOT NULL default '',
  depart varchar(50) NOT NULL default '',
  content text NOT NULL,
  context text NOT NULL,
  address varchar(255) NOT NULL default '',
  contact_name varchar(50) NOT NULL default '',
  contact_phone varchar(50) NOT NULL default '',
  email varchar(50) NOT NULL default '',
  puttime int(10) unsigned NOT NULL default '0',
  losetime int(10) unsigned NOT NULL default '0',
  sign tinyint(1) unsigned NOT NULL default '0',
  htmlroot varchar(10) NOT NULL default '',
  click int(12) unsigned NOT NULL default '1',
  PRIMARY KEY  (id),
  KEY id (id),
  KEY username (username),
  KEY title (title),
  KEY sex (sex),
  KEY edu (edu),
  KEY depart (depart)
);
