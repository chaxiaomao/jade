/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/5/20 9:30:57                            */
/*==============================================================*/


drop index Index_2 on c2_city;

drop index Index_1 on c2_city;

drop table if exists c2_city;

drop index Index_3 on c2_config;

drop index Index_2 on c2_config;

drop index Index_1 on c2_config;

drop table if exists c2_config;

drop index Index_2 on c2_country;

drop index Index_1 on c2_country;

drop table if exists c2_country;

drop index Index_2 on c2_country_language;

drop index Index_1 on c2_country_language;

drop table if exists c2_country_language;

drop index Index_7 on c2_fe_user;

drop index Index_6 on c2_fe_user;

drop index Index_5 on c2_fe_user;

drop index Index_4 on c2_fe_user;

drop index Index_3 on c2_fe_user;

drop index Index_2 on c2_fe_user;

drop index Index_1 on c2_fe_user;

drop table if exists c2_fe_user;

drop index Index_1 on c2_fe_user_profile;

drop table if exists c2_fe_user_profile;

drop index Index_4 on c2_grp;

drop index Index_3 on c2_grp;

drop index Index_2 on c2_grp;

drop index Index_1 on c2_grp;

drop table if exists c2_grp;

drop index Index_2 on c2_grp_branch;

drop index Index_1 on c2_grp_branch;

drop table if exists c2_grp_branch;

drop index Index_1 on c2_grp_profile;

drop table if exists c2_grp_profile;

drop index Index_2 on c2_grp_station;

drop index Index_1 on c2_grp_station;

drop table if exists c2_grp_station;

drop index Index_2 on c2_grp_station_item;

drop index Index_1 on c2_grp_station_item;

drop table if exists c2_grp_station_item;

drop index Index_2 on c2_region;

drop index Index_1 on c2_region;

drop table if exists c2_region;

drop index Index_3 on c2_region_rs;

drop index Index_2 on c2_region_rs;

drop index Index_1 on c2_region_rs;

drop table if exists c2_region_rs;

drop index Index_5 on c2_user_kpi;

drop index Index_4 on c2_user_kpi;

drop index Index_3 on c2_user_kpi;

drop index Index_2 on c2_user_kpi;

drop index Index_1 on c2_user_kpi;

drop table if exists c2_user_kpi;

drop index Index_1 on c2_user_profit;

drop table if exists c2_user_profit;

drop index Index_3 on c2_user_profit_item;

drop index Index_2 on c2_user_profit_item;

drop index Index_1 on c2_user_profit_item;

drop table if exists c2_user_profit_item;

/*==============================================================*/
/* Table: c2_city                                               */
/*==============================================================*/
create table c2_city
(
   id                   bigint not null auto_increment,
   name                 char(35),
   country_code         char(3),
   district             char(20),
   population           int(11),
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_city
(
   name
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_city
(
   country_code
);

/*==============================================================*/
/* Table: c2_config                                             */
/*==============================================================*/
create table c2_config
(
   id                   bigint not null auto_increment,
   type                 tinyint default 0,
   code                 varchar(255),
   label              varchar(255) not null,
   default_value        text,
   custom_value         text,
   memo                 tinytext,
   created_by           bigint default 0,
   updated_by           bigint default 0,
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_config
(
   code
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_config
(
   label
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_config
(
   type
);

/*==============================================================*/
/* Table: c2_country                                            */
/*==============================================================*/
create table c2_country
(
   id                   bigint not null auto_increment,
   code                 char(3),
   name                 char(52),
   continent            enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America'),
   region               char(26),
   surface_area         float(10,2),
   indep_year           smallint(6),
   population           int(11),
   life_expectancy      float(3,1),
   gnp_old              float(10,2),
   local_name           char(45),
   government_form      char(45),
   head_of_state        char(60),
   capital              int(11),
   code2                char(2),
   gnp                  float(10,2),
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_country
(
   code
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_country
(
   name
);

/*==============================================================*/
/* Table: c2_country_language                                   */
/*==============================================================*/
create table c2_country_language
(
   id                   bigint not null auto_increment,
   country_code         char(3),
   language             varchar(255),
   is_official          enum('T','F'),
   percentage           float(4,1),
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_country_language
(
   country_code
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_country_language
(
   language
);

/*==============================================================*/
/* Table: c2_fe_user                                            */
/*==============================================================*/
create table c2_fe_user
(
   id                   bigint not null auto_increment,
   type                 int default 0,
   attributeset_id      bigint default 0,
   username             varchar(255) not null,
   email                varchar(255),
   password_hash        varchar(255),
   auth_key             varchar(255),
   confirmed_at         datetime,
   unconfirmed_email    varchar(255),
   blocked_at           datetime,
   registration_ip      varchar(255),
   registration_src_type tinyint default 100,
   flags                int,
   level                tinyint,
   last_login_at        datetime,
   last_login_ip        varchar(255),
   open_id              varchar(255),
   wechat_union_id      char(10),
   wechat_open_id       varchar(255),
   mobile_number        varchar(255),
   sms_receipt          varchar(255),
   access_token         varchar(255),
   password_reset_token varchar(255),
   district_id          bigint,
   province_id          bigint default 0,
   city_id              bigint default 0,
   created_by           bigint default 0,
   updated_by           bigint default 0,
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_fe_user
(
   username
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_fe_user
(
   email
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_fe_user
(
   type
);

/*==============================================================*/
/* Index: Index_4                                               */
/*==============================================================*/
create index Index_4 on c2_fe_user
(
   open_id
);

/*==============================================================*/
/* Index: Index_5                                               */
/*==============================================================*/
create index Index_5 on c2_fe_user
(
   wechat_open_id
);

/*==============================================================*/
/* Index: Index_6                                               */
/*==============================================================*/
create index Index_6 on c2_fe_user
(
   access_token,
   status
);

/*==============================================================*/
/* Index: Index_7                                               */
/*==============================================================*/
create index Index_7 on c2_fe_user
(
   mobile_number
);

/*==============================================================*/
/* Table: c2_fe_user_profile                                    */
/*==============================================================*/
create table c2_fe_user_profile
(
   id                   bigint not null auto_increment,
   user_id              bigint,
   name                 varchar(255),
   wechat_number        varchar(255),
   public_email         varchar(255),
   gravatar_email       varchar(255),
   gravatar_id          varchar(255),
   location             varchar(255),
   website              varchar(255),
   bio                  text,
   timezone             varchar(255),
   firstname            varchar(255),
   lastname             varchar(255),
   birthday             datetime,
   avatar               varchar(255),
   id_number            varchar(255),
   address              varchar(255),
   terms                tinyint default 0,
   qr_code              varchar(255),
   qr_code_image        varchar(255),
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_fe_user_profile
(
   user_id
);

/*==============================================================*/
/* Table: c2_grp                                                */
/*==============================================================*/
create table c2_grp
(
   id                   bigint not null auto_increment,
   type                 tinyint default 0,
   attributeset_id      bigint default 0,
   province_id          bigint default 0,
   city_id              bigint default 0,
   district_id          bigint default 0,
   code                 varchar(255),
   label              varchar(255) not null,
   geo_longitude        varchar(255),
   geo_latitude         varchar(255),
   geo_marker_color     varchar(255),
   created_by           bigint default 0,
   updated_by           bigint default 0,
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_grp
(
   geo_latitude,
   geo_longitude
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_grp
(
   label
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_grp
(
   type
);

/*==============================================================*/
/* Index: Index_4                                               */
/*==============================================================*/
create index Index_4 on c2_grp
(
   province_id,
   city_id,
   district_id
);

/*==============================================================*/
/* Table: c2_grp_branch                                         */
/*==============================================================*/
create table c2_grp_branch
(
   id                   bigint not null auto_increment,
   grp_id               bigint not null default 0,
   parent_id            bigint,
   type                 tinyint,
   state                tinyint default 1,
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_grp_branch
(
   grp_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_grp_branch
(
   parent_id
);

/*==============================================================*/
/* Table: c2_grp_profile                                        */
/*==============================================================*/
create table c2_grp_profile
(
   id                   bigint not null auto_increment,
   grp_id               bigint,
   name                 varchar(255),
   public_email         varchar(255),
   gravatar_email       varchar(255),
   gravatar_id          varchar(255),
   location             varchar(255),
   address              varchar(255),
   website              varchar(255),
   bio                  text,
   timezone             varchar(255),
   avatar               varchar(255),
   terms                tinyint default 0,
   qr_code              varchar(255),
   qr_code_image        varchar(255),
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_grp_profile
(
   grp_id
);

/*==============================================================*/
/* Table: c2_grp_station                                        */
/*==============================================================*/
create table c2_grp_station
(
   id                   bigint not null auto_increment,
   grp_id               bigint not null default 0,
   type                 tinyint,
   name                 varchar(255),
   label              varchar(255),
   parent_station_id    bigint,
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_grp_station
(
   grp_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_grp_station
(
   parent_station_id
);

/*==============================================================*/
/* Table: c2_grp_station_item                                   */
/*==============================================================*/
create table c2_grp_station_item
(
   id                   bigint not null auto_increment,
   grp_station_id       bigint not null default 0,
   user_id              bigint not null default 0,
   label              varchar(255),
   state                tinyint default 1,
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_grp_station_item
(
   user_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_grp_station_item
(
   grp_station_id
);

/*==============================================================*/
/* Table: c2_region                                             */
/*==============================================================*/
create table c2_region
(
   id                   bigint not null auto_increment,
   type                 tinyint default 0,
   code                 varchar(255),
   label              varchar(255),
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_region
(
   type,
   label
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_region
(
   type,
   code
);

/*==============================================================*/
/* Table: c2_region_rs                                          */
/*==============================================================*/
create table c2_region_rs
(
   id                   bigint not null auto_increment,
   parent_id            bigint default 0,
   child_id             bigint default 0,
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_region_rs
(
   parent_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_region_rs
(
   child_id
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_region_rs
(
   parent_id,
   child_id
);

/*==============================================================*/
/* Table: c2_user_kpi                                           */
/*==============================================================*/
create table c2_user_kpi
(
   id                   bigint not null auto_increment,
   grp_id               bigint not null default 0,
   join_user_id         bigint not null default 0,
   rcd_user_id          bigint,
   grp_station_id       bigint,
   c1_id                bigint,
   dues                 decimal(10,2),
   type                 tinyint,
   state                tinyint default 1,
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_user_kpi
(
   join_user_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_user_kpi
(
   grp_id
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_user_kpi
(
   rcd_user_id
);

/*==============================================================*/
/* Index: Index_4                                               */
/*==============================================================*/
create index Index_4 on c2_user_kpi
(
   c1_id
);

/*==============================================================*/
/* Index: Index_5                                               */
/*==============================================================*/
create index Index_5 on c2_user_kpi
(
   c1_id
);

/*==============================================================*/
/* Table: c2_user_profit                                        */
/*==============================================================*/
create table c2_user_profit
(
   id                   bigint not null auto_increment,
   type                 int default 0,
   user_id              bigint,
   income               decimal(10,2),
   state                tinyint,
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_user_profit
(
   user_id
);

/*==============================================================*/
/* Table: c2_user_profit_item                                   */
/*==============================================================*/
create table c2_user_profit_item
(
   id                   bigint not null auto_increment,
   type                 tinyint default 1,
   kpi_id               bigint,
   grp_id               bigint default 0,
   user_id              bigint,
   income               decimal(10,2),
   state                tinyint,
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_user_profit_item
(
   user_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_user_profit_item
(
   kpi_id
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_user_profit_item
(
   grp_id
);

