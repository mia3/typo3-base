# TT Content Adjustments
CREATE TABLE tt_content (
    header_styles varchar(255) DEFAULT '' NOT NULL,
    header_semantic tinyint(4) unsigned DEFAULT '1' NOT NULL,
);

CREATE TABLE sys_file_reference (
	stretch_across_content tinyint(4) unsigned DEFAULT '0' NOT NULL,
);
