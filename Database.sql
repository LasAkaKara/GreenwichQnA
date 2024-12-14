-- Database configuration
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION; ---To execute multiple queries as a single unit, avoid partial execution
SET time_zone = "+00:00";

CREATE TABLE users(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255),
    isAdmin TINYINT(1) NOT NULL, --boolean equivalent in SQL
    isDeleted TINYINT(1) NOT NULL DEFAULT 0,
    profile_picture VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Users table: Stores user information
-- user_id: Unique identifier for each user
-- username: User's display name
-- email: User's email (unique)
-- password: Hashed password
-- isAdmin: Boolean flag for admin privileges
-- isDeleted: Soft delete flag
-- profile_picture: Path to user's avatar

-- Sample user data with different roles
INSERT INTO users(username, email, password, isAdmin, isDeleted, profile_picture) VALUES
('laskara', 'bachhlgcs230324@fpt.edu.vn', 'b26d5c34979df26cf5aec1e4c6d4bd59', 1, 0,'uploads/avatar/las.jpg'),
('lethanhminh', 'minh@gmail.com', '616a1287fd70fd0e5feecef121abb685', 0, 0,'uploads/avatar/minh.jpg'),
('nhanbui', 'nhan@gmail.com', '43ef63b23b5ddbd8dc0b2805da15aca0', 0, 0,'uploads/avatar/nhan.jpg'),
('justinnam', 'justin@gmail.com', 'a160e83d348a1d0e4a009e3e44908ebb', 0, 0,'uploads/avatar/nam.jpg'),
('Oniks', 'oniksle@gmail.com', 'a1e3b27598f12079e9b6e59082e63e6d', 0, 0,'uploads/avatar/oniks.png');

CREATE TABLE modules(
    module_id VARCHAR(50) NOT NULL PRIMARY KEY,
    module_name VARCHAR(255) NOT NULL,
    lecturer VARCHAR(255),
    isDeleted TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Modules table: Stores course module information
-- module_id: Unique identifier for each module
-- module_name: Name of the module
-- lecturer: Name of module lecturer
-- isDeleted: Soft delete flag


-- Sample module data
INSERT INTO modules(module_id, module_name, lecturer, isDeleted) VALUES
('COMP1773', 'UI/UX Design', 'Ms Chi', 0),
('COMP1770', 'Project Management', 'Mrs Duong', 0),
('COMP1841', 'Web Development 1', 'Mr Khanh', 0);


CREATE TABLE posts(
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    post_content TEXT NOT NULL,
    isDeleted TINYINT(1) NOT NULL DEFAULT 0,
    time TIMESTAMP DEFAULT current_timestamp,
    author INT NOT NULL,
    module VARCHAR(50) NOT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (author) REFERENCES users(user_id),
    FOREIGN KEY (module) REFERENCES modules(module_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Posts table: Stores user questions/posts
-- post_id: Unique identifier for each post
-- title: Post title
-- post_content: Main content of the post
-- isDeleted: Soft delete flag
-- time: Timestamp of post creation
-- author: Foreign key to users table
-- module: Foreign key to modules table
-- image_path: Path to attached image


-- Sample post data
INSERT INTO posts(title, isDeleted, time, author, module, post_content, image_path) VALUES
('Do we have class this week?', 0, '2024-12-3 14:34:42', 3, 'COMP1770', 'tomorrow class is not on the timetable. Did miss Duong said we are not going to class this week? I dont remember her saying anythign last time', 'uploads/posts/timetable.jpg'),
('How do yall make a Gantt Chart', 0, '2024-11-14 13:00:00', 2, 'COMP1770', 'We talked about Gantt Chart Last week but I was missing. How do we do this again? Any ideas?', 'uploads/posts/gantt.png'),
('When is the Deadline', 0, '2024-12-5 15:00:00', 4, 'COMP1773', 'I cannot access module the last few days, i forgot when is the deadline for the coursework, any ideas?', 'uploads/posts/moodle.png'),
('Class Exchange', 0, '2024-11-3 14:34:42', 5, 'COMP1773', 'my schedule is currently having UID on tuesday afternoon. does anyone wanna exchange this class with me? im having a prt-time job on tuesday afternoon already...', 'uploads/posts/coursework.png'),
('Progress Coursework', 0, '2024-12-3 14:34:42', 3, 'COMP1841', 'nothing much, just asking how far have everyone gotten in the coursework.', 'uploads/posts/progress.jpg');

CREATE TABLE answers(
    answer_id INT AUTO_INCREMENT PRIMARY KEY,
    answer_content TEXT NOT NULL,
    isDeleted TINYINT(1) NOT NULL DEFAULT 0,
    time TIMESTAMP default current_timestamp,
    author INT NOT NULL,
    post INT NOT NULL,
    FOREIGN KEY (author) REFERENCES users(user_id),
    FOREIGN KEY (post) REFERENCES posts(post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Answers table: Stores responses to posts
-- answer_id: Unique identifier for each answer
-- answer_content: Content of the answer
-- isDeleted: Soft delete flag
-- time: Timestamp of answer creation
-- author: Foreign key to users table
-- post: Foreign key to posts table


-- Sample answer data
INSERT INTO answers(isDeleted, time, author, post, answer_content) VALUES
(0, '2024-12-3 15:00:00', 2, 1, 'nah we dont'),
(0, '2024-12-3 15:45:00', 4, 1, 'i think we do, i still see it on the ap web'),
(0, '2024-11-15 14:00:00', 3, 2, 'have you asked ChatGPT haha'),
(0, '2024-11-15 17:43:00', 4, 2, 'we have class videos replay, try watching it'),
(0, '2024-11-15 14:00:00', 5, 2, 'I think Dung understands it pretty well, ask him!');

CREATE TABLE comments(
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    comment_content TEXT NOT NULL,
    isDeleted TINYINT(1) NOT NULL DEFAULT 0,
    time TIMESTAMP default current_timestamp,
    author INT NOT NULL,
    answer INT NOT NULL,
    FOREIGN KEY (author) REFERENCES users(user_id),
    FOREIGN KEY (answer) REFERENCES answers(answer_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Comments table: Stores comments on answers
-- comment_id: Unique identifier for each comment
-- comment_content: Content of the comment
-- isDeleted: Soft delete flag
-- time: Timestamp of comment creation
-- author: Foreign key to users table
-- answer: Foreign key to answers table


-- Sample comment data
INSERT INTO answers(isDeleted, time, author, answer, comment_content) VALUES
(0, '2024-12-3 15:10:00', 4, 1, 'what? i thought we do'),
(0, '2024-12-3 15:11:00', 2, 1, 'wait lemme check it again'),
(0, '2024-12-3 15:14:00', 2, 1, 'oh dang, we actually do'),
(0, '2024-12-3 16:14:00', 4, 1, 'why so sad hahaha'),
(0, '2024-11-15 15:46:24', 3, 2, 'okay thanks'),
(0, '2024-11-15 15:46:50', 3, 2, 'guess mine just doesnt work'),
(0, '2024-11-15 19:20:00', 5, 3, 'i think we all use it (to some extent)'),
(0, '2024-11-15 20:43:00', 3, 3, 'haha true'),
(0, '2024-11-15 20:47:00', 2, 3, 'this is not funny guys');

CREATE TABLE admin_messages (
  message_id INT AUTO_INCREMENT PRIMARY KEY,
  user INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  message_content TEXT NOT NULL,
  time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user) REFERENCES users(user_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Admin messages table: Stores user messages to admins
-- message_id: Unique identifier for each message
-- user: Foreign key to users table
-- title: Message title
-- message_content: Content of the message
-- time: Timestamp of message creation


-- Sample admin message data
INSERT INTO admin_messages (user, title, message_content, time) VALUES
(3, 'Technical Issue with Image Upload', 'Hello, I''ve been trying to upload an image to my post but keep getting an error. The image is under 5MB and is a JPG file. Could you please look into this?', '2024-03-14 14:22:15'),
(4, 'Request for New Module Addition', 'Could we get a new module added for Mobile App Development? Many students have expressed interest in this topic.', '2024-03-13 11:45:30'),
(4, 'Account Deletion Request', 'I''d like to request my account to be deleted as I''m transferring to a different university. How can we proceed with this?', '2024-03-09 15:30:45'),
(5, 'Module Access Problem', 'Hi admin, I should have access to COMP1773 but it''s not showing up in my module list. My student ID is ST12345.', '2024-03-08 09:10:30');

CREATE TABLE likes(
    user INT NOT NULL,
    post INT NOT NULL,
    isLike TINYINT(1) DEFAULT NULL, /*1=like, 2=dislike, null=no interactions*/
    FOREIGN KEY (user) REFERENCES users(user_id),
    FOREIGN KEY (post) REFERENCES posts(post_id),
    PRIMARY KEY (user, post)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Likes table: Stores user likes/dislikes on posts
-- user: Foreign key to users table
-- post: Foreign key to posts table
-- isLike: 1 for like, 0 for dislike, null for no interaction


COMMIT;
