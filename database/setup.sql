\W -- Enable all warnings

DROP DATABASE IF EXISTS `computer_inventory`;
CREATE DATABASE IF NOT EXISTS `computer_inventory` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci;

CREATE USER IF NOT EXISTS 'computer_inventory_manager'@'localhost' IDENTIFIED BY 'b(79yKo8Ei';
GRANT ALL PRIVILEGES ON computer_inventory.* TO 'computer_inventory_manager'@'localhost';

USE computer_inventory;

-- create tables
SOURCE create-os-table.sql;
SOURCE create-dates-table.sql;
SOURCE create-models-table.sql;
SOURCE create-devices-table.sql;

-- populate tables
SOURCE populate-os-table.sql;
SOURCE populate-dates-table.sql;