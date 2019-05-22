/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/5/22 13:20:24                           */
/*==============================================================*/


drop index Index_2 on c2_user_grp_rs;

drop index Index_1 on c2_user_grp_rs;

drop table if exists c2_user_grp_rs;

/*==============================================================*/
/* Table: c2_user_grp_rs                                        */
/*==============================================================*/
create table c2_user_grp_rs
(
   id                   bigint not null auto_increment,
   grp_id               bigint not null default 0,
   user_id              bigint not null default 0,
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
create index Index_1 on c2_user_grp_rs
(
   user_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_user_grp_rs
(
   grp_id
);

