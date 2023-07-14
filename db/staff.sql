-- Query to create Databse 
CREATE DATABASE IF NOT EXISTS `time_master`;

CREATE TABLE IF NOT EXISTS `staff` (
    `id` INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL, 
    `employee_id` INT(11) NOT NULL,
    `address` VARCHAR(200) NOT NULL,
    `contact` VARCHAR(200) NOT NULL, 
    `contact_type` TINYINT(1) NOT NULL COMMENT "0 => phone, 1 => email",
    `time_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    `time_modified` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT `uk_staff_contact` UNIQUE KEY (`contact`)
);

CREATE TABLE IF NOT EXISTS staff_attendance (
	id INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    staff_id INT(11) UNSIGNED NOT NULL,
    `date` DATE DEFAULT NULL,
    attendance_status TINYINT(1) NOT NULL COMMENT "0 => absent, 1 => present",
    time_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    time_modified TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT `fk_staff_id` FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE
);

ALTER TABLE `staff` 
    ADD `salary` INT(11) NOT NULL DEFAULT "10000" AFTER `contact_type`;

INSERT INTO `staff` (`name`, `employee_id`, `address`, `contact`, `contact_type`) VALUES ('Shaman Joy', '10392', 'Ibadan', 'shaman@gmail.com', 1);
INSERT INTO `staff` (`name`, `employee_id`, `address`, `contact`, `contact_type`) VALUES ('Olaolu David', '10393', 'Lagos', 'olaoludave@gmail.com', 1);
INSERT INTO `staff` (`name`, `employee_id`, `address`, `contact`, `contact_type`) VALUES ('Adeleke Eniola', '10093', 'Russia', '0890246790', 0);
INSERT INTO `staff` (`name`, `employee_id`, `address`, `contact`, `contact_type`) VALUES ('Ibrahim Abibat', '11693', 'Calabar', '0132637280', 0);
INSERT INTO `staff` (`name`, `employee_id`, `address`, `contact`, `contact_type`) VALUES ('Adekalu James', '11693', 'Abuja', 'adekalu2494@gmail.com', 1);

ALTER TABLE `staff` RENAME TO `staffs`;
ALTER TABLE `staff_attendance` RENAME TO `staffs_attendance`;

