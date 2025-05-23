-- Drop existing tables first
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS tasks;

-- Create users table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `passwd` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
);

-- Create modified tasks table with user_id foreign key
CREATE TABLE IF NOT EXISTS `tasks` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `date` DATE NOT NULL,
    `priority` VARCHAR(20) NOT NULL,
    `status` VARCHAR(10) NOT NULL,
    `user_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- Insert sample users
INSERT INTO `users` (`id`, `name`, `passwd`) VALUES
(1, 'admin_usr', 'adminpasswd2025'),
(2, 'jclan', 'password'), 
(3, 'hon3ymelon', 'S3cret_P4ssword');

-- Insert sample tasks with user associations
INSERT INTO `tasks` (`id`, `name`, `date`, `priority`, `status`, `user_id`) VALUES
(1, 'complete project report', '2025-03-20', '!!! (High)', 'pending', 1),
(2, 'update section memo', '2004-05-12', '!! (Medium)', 'Complete', 2),
(3, 'write todo list', '2022-11-15', '! (Low)', 'pending', 2),
(4, 'wash dishes', '2025-05-08', '! (Low)', 'pending', 3);