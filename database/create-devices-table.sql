CREATE TABLE IF NOT EXISTS devices (
    serial_number VARCHAR(12) NOT NULL,
    part_number VARCHAR(24) NOT NULL,
    darwin VARCHAR(8) NOT NULL,
    FOREIGN KEY (part_number) REFERENCES models(part_number),
    FOREIGN KEY (darwin) REFERENCES operating_systems(darwin),

    PRIMARY KEY(serial_number)
);