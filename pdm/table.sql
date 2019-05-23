/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/5/23 23:57:24                           */
/*==============================================================*/


drop index Index_2 on c2_user_invite_code;

drop index Index_1 on c2_user_invite_code;

drop table if exists c2_user_invite_code;

drop index Index_5 on c2_user_kpi;

drop index Index_4 on c2_user_kpi;

drop index Index_3 on c2_user_kpi;

drop index Index_2 on c2_user_kpi;

drop index Index_1 on c2_user_kpi;

drop table if exists c2_user_kpi;

/*==============================================================*/
/* Table: c2_user_invite_code                                   */
/*==============================================================*/
create table c2_user_invite_code
(
   id                   bigint not null auto_increment,
   grp_id               bigint default 0,
   user_id              bigint,
   code                 decimal(10,2),
   expired_at           char(10),
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_user_invite_code
(
   user_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_user_invite_code
(
   grp_id
);

/*==============================================================*/
/* Table: c2_user_kpi                                           */
/*==============================================================*/
create table c2_user_kpi
(
   id                   bigint not null auto_increment,
   grp_id               bigint not null default 0,
   join_user_id         bigint not null default 0,
   invite_user_id       bigint,
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
   invite_user_id
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

