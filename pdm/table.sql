/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/6/12 星期三 下午 1:56:24                     */
/*==============================================================*/


drop index Index_1 on c2_user_sum_apply;

drop table if exists c2_user_sum_apply;

/*==============================================================*/
/* Table: c2_user_sum_apply                                     */
/*==============================================================*/
create table c2_user_sum_apply
(
   id                   bigint not null auto_increment,
   type                 tinyint default 0,
   user_id              bigint,
   apply_sum            decimal(10,2),
   bank_name            varchar(255),
   hash                 varchar(255),
   confirmed_at         datetime,
   name                 varchar(255),
   mobile_number        varchar(255),
   brank_card_number    varchar(255),
   transfer_rate        decimal(10,2),
   received_sum         decimal(10,2),
   state                tinyint,
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_user_sum_apply
(
   user_id
);

