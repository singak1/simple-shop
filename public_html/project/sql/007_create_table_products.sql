CREATE TABLE IF NOT EXISTS `Products`
(
    `id`            int auto_increment not null PRIMARY KEY,
    `name`          varchar(32) not null unique,
    `description`   varchar(100) default ' ',
    `category`      varchar(32),
    `stock`         int default 0, 
    `created`       timestamp default current_timestamp,
    `modified`      timestamp default current_timestamp on update current_timestamp,
    `unit_price`    int default 99999,
    `visibility`    varchar(5) default 'false' not null,
    check (stock >= 0 ),
    check (unit_price > 0)
)