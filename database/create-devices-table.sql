CREATE TABLE IF NOT EXISTS devices (
    serial_number   VARCHAR(12)   NOT NULL,
    model_id        VARCHAR(24)   NOT NULL,
    darwin          VARCHAR(8)    NOT NULL,

    FOREIGN KEY (model_id) REFERENCES models(model_id),
    FOREIGN KEY (darwin) REFERENCES operating_systems(darwin),

    PRIMARY KEY(serial_number)
);
