create table tt_content
(
    header_styles   varchar(255)        default ''  not null,
    header_semantic tinyint(4) unsigned default '1' not null
);

create table sys_file_reference
(
    stretch_across_content tinyint(4) unsigned default '0' not null
);
