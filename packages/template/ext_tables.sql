create table tt_content
(
    header_style          tinyint             default '0' not null,
    header_color          tinyint             default '0' not null,
    tx_template_container tinytext            default ''  not null,
    text_columns          tinyint(4)          default '0' not null,
);

create table sys_file_reference
(
    stretch_across_content tinyint(4) unsigned default '0' not null,
);
