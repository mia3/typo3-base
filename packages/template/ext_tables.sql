create table tt_content
(
    header_style          varchar(30)         default '0' not null,
    header_color          tinyint             default '0' not null,
    tx_template_container tinytext            default ''  not null,
    subheader_above       tinyint(4) unsigned default '0' not null
);

create table sys_file_reference
(
    stretch_across_content tinyint(4) unsigned default '0' not null
);
