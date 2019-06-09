/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/6/9 星期日 上午 9:09:57                      */
/*==============================================================*/


drop index Index_2 on c2_grp_branch;

drop index Index_1 on c2_grp_branch;

drop table if exists c2_grp_branch;

/*==============================================================*/
/* Table: c2_grp_branch                                         */
/*==============================================================*/
create table c2_grp_branch
(
   id                   bigint not null auto_increment,
   grp_id               bigint not null default 0,
   parent_id            bigint,
   type                 tinyint default 1,
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

