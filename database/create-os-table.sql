CREATE TABLE IF NOT EXISTS operating_systems (
  version_name   VARCHAR(48)  NOT NULL,
  release_name   VARCHAR(48)  NOT NULL,
  darwin         VARCHAR(8)   NOT NULL,
  url            VARCHAR(64)  DEFAULT NULL,
  comment        TINYTEXT     DEFAULT NULL,

  PRIMARY KEY (darwin)
);
