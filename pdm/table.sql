/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/5/28 0:19:18                            */
/*==============================================================*/


drop index Index_3 on c2_grp_station_item;

drop index Index_2 on c2_grp_station_item;

drop index Index_1 on c2_grp_station_item;

drop table if exists c2_grp_station_item;

/*==============================================================*/
/* Table: c2_grp_station_item                                   */
/*==============================================================*/
create table c2_grp_station_item
(
   id                   bigint not null auto_increment,
   grp_station_id       bigint not null default 0,
   grp_id               bigint,
   user_id              bigint not null default 0,
   "label"              varchar(255),
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
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_grp_station_item
(
   grp_id
);

