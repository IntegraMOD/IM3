BEGIN;

/*
	Table: 'phpbb_blogs_attachment'
*/
CREATE SEQUENCE phpbb_blogs_attachment_seq;

CREATE TABLE phpbb_blogs_attachment (
	attach_id INT4 DEFAULT nextval('phpbb_blogs_attachment_seq'),
	blog_id INT4 DEFAULT '0' NOT NULL CHECK (blog_id >= 0),
	reply_id INT4 DEFAULT '0' NOT NULL CHECK (reply_id >= 0),
	poster_id INT4 DEFAULT '0' NOT NULL CHECK (poster_id >= 0),
	is_orphan INT2 DEFAULT '1' NOT NULL CHECK (is_orphan >= 0),
	physical_filename varchar(255) DEFAULT '' NOT NULL,
	real_filename varchar(255) DEFAULT '' NOT NULL,
	download_count INT4 DEFAULT '0' NOT NULL CHECK (download_count >= 0),
	attach_comment varchar(4000) DEFAULT '' NOT NULL,
	extension varchar(100) DEFAULT '' NOT NULL,
	mimetype varchar(100) DEFAULT '' NOT NULL,
	filesize INT4 DEFAULT '0' NOT NULL CHECK (filesize >= 0),
	filetime INT4 DEFAULT '0' NOT NULL CHECK (filetime >= 0),
	thumbnail INT2 DEFAULT '0' NOT NULL CHECK (thumbnail >= 0),
	PRIMARY KEY (attach_id)
);

CREATE INDEX phpbb_blogs_attachment_blog_id ON phpbb_blogs_attachment (blog_id);
CREATE INDEX phpbb_blogs_attachment_reply_id ON phpbb_blogs_attachment (reply_id);
CREATE INDEX phpbb_blogs_attachment_filetime ON phpbb_blogs_attachment (filetime);
CREATE INDEX phpbb_blogs_attachment_poster_id ON phpbb_blogs_attachment (poster_id);
CREATE INDEX phpbb_blogs_attachment_is_orphan ON phpbb_blogs_attachment (is_orphan);


COMMIT;