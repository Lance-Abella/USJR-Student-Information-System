CREATE SCHEMA IF NOT EXISTS `usjr` DEFAULT CHARACTER SET utf8;

USE `usjr`;

DROP TABLE IF EXISTS `usjr`.`students`;
DROP TABLE IF EXISTS `usjr`.`programs`;
DROP TABLE IF EXISTS `usjr`.`departments`;
DROP TABLE IF EXISTS `usjr`.`colleges`;

CREATE TABLE `usjr`.`colleges` (
  `collid` INT NOT NULL,
  `collfullname` VARCHAR(100) NOT NULL,
  `collshortname` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`collid`));

CREATE TABLE `usjr`.`departments`(
  `deptid` INT NOT NULL,
  `deptfullname` VARCHAR(100) NOT NULL,
  `deptshortname` VARCHAR(20),
  `deptcollid` INT NOT NULL, 
  PRIMARY KEY (`deptid`),
  CONSTRAINT `fk_department_college_id`
     FOREIGN KEY (`deptcollid`) 
     REFERENCES `usjr`.`colleges` (`collid`)
     ON DELETE CASCADE
     ON UPDATE CASCADE
  );

CREATE TABLE `usjr`.`programs` (
  `progid` INT NOT NULL,
  `progfullname` VARCHAR(100) NOT NULL,
  `progshortname` VARCHAR(20),
  `progcollid` INT NOT NULL,
  `progcolldeptid` INT NOT NULL,
  PRIMARY KEY (`progid`),
  CONSTRAINT `fk_program_college_id`
     FOREIGN KEY (`progcollid`)
     REFERENCES `usjr`.`colleges` (`collid`)
     ON DELETE CASCADE
     ON UPDATE CASCADE,
  CONSTRAINT `fk_program_college_department_id`
     FOREIGN KEY (`progcolldeptid`)
     REFERENCES `usjr`.`departments` (`deptid`)
     ON DELETE CASCADE
     ON UPDATE CASCADE
);

CREATE TABLE `usjr`.`students` (
  `studid` INT NOT NULL,
  `studfirstname` VARCHAR(50) NOT NULL,
  `studlastname` VARCHAR(50) NOT NULL,
  `studmidname` VARCHAR(50) NULL,
  `studprogid` INT NOT NULL,
  `studcollid` INT NOT NULL,
  `studyear` INT NOT NULL,
  PRIMARY KEY (`studid`),
  CONSTRAINT `fk_student_college_id`
     FOREIGN KEY (`studcollid`)
     REFERENCES `usjr`.`colleges` (`collid`)
     ON DELETE CASCADE
     ON UPDATE CASCADE
);

INSERT INTO `usjr`.`colleges` VALUES (1,'School of Business and Management','SBM');
INSERT INTO `usjr`.`colleges` VALUES (2,'School of Arts and Sciences','SAS');
INSERT INTO `usjr`.`colleges` VALUES (3,'School of Engineering','SoENG');
INSERT INTO `usjr`.`colleges` VALUES (4,'School of Education','SED');
INSERT INTO `usjr`.`colleges` VALUES (5,'School of Computer Studies','SCS');
INSERT INTO `usjr`.`colleges` VALUES (6,'School of Allied Medical Sciences','SAMS');

INSERT INTO `usjr`.`departments` VALUES(1001,'Accountancy and Finance Department',null,1);
INSERT INTO `usjr`.`departments` VALUES(1002,'Business and Entrepreneurship Department',null,1);
INSERT INTO `usjr`.`departments` VALUES(1003,'Marketing and Human Resource Management Department',null,1);
INSERT INTO `usjr`.`departments` VALUES(1004,'Tourism and Hospitality Management Department','THMD',1);
INSERT INTO `usjr`.`departments` VALUES(2001,'Department of Communications, Language and Literature','DLL',2);
INSERT INTO `usjr`.`departments` VALUES(2002,'Department of Mathematics and Sciences','DMS',2);
INSERT INTO `usjr`.`departments` VALUES(2003,'Department of Social Sciences and Philiosophy','DSSP',2);
INSERT INTO `usjr`.`departments` VALUES(2004,'Department of Psychology and Library Information Science','DPLIS',2);
INSERT INTO `usjr`.`departments` VALUES(3001,'Department of Civil Engineering',null,3);
INSERT INTO `usjr`.`departments` VALUES(3002,'Department of Computer Engineering',null,3);
INSERT INTO `usjr`.`departments` VALUES(3003,'Department of Electronics and Communications Engineering',null,3);
INSERT INTO `usjr`.`departments` VALUES(3004,'Department of Electrical Engineering',null,3);
INSERT INTO `usjr`.`departments` VALUES(3005,'Department of Industrial Enginering',null,3);
INSERT INTO `usjr`.`departments` VALUES(3006,'Department of Mechanical Engineering',null,3);
INSERT INTO `usjr`.`departments` VALUES(4001,'Department of Teacher Education',null,4);
INSERT INTO `usjr`.`departments` VALUES(4002,'Department of Physical Education',null,4);
INSERT INTO `usjr`.`departments` VALUES(4003,'Department of Special Education',null,4);
INSERT INTO `usjr`.`departments` VALUES(5001,'CS/IT Department',null,5);
INSERT INTO `usjr`.`departments` VALUES(6001,'Department of Nursing',null,6);

INSERT INTO `usjr`.`programs` VALUES(1001,'Bachelor of Science in Accountancy','BSA',1,1001);
INSERT INTO `usjr`.`programs` VALUES(1002,'Bachelor of Science in Management Accounting','BSMA',1,1001);
INSERT INTO `usjr`.`programs` VALUES(1003,'Bachelor of Science in Business Administration Major in Operation Management','BSBA-OM',1,1003);
INSERT INTO `usjr`.`programs` VALUES(1004,'Bachelor of Science in Business Administration Major in Human Resource Development Management','BSBA-HRDM',1,1003);
INSERT INTO `usjr`.`programs` VALUES(1005,'Bachelor of Science in Business Administration Major in Marketing Management','BSBA-MM',1,1003);
INSERT INTO `usjr`.`programs` VALUES(1006,'Bachelor of Science in Business Administration Major in Finanacial Management','BSBA-FM',1,1001);
INSERT INTO `usjr`.`programs` VALUES(1007,'Bachelor of Science in Entrepreneurship','BS-Entrepreneurship',1,1002);
INSERT INTO `usjr`.`programs` VALUES(1008,'Bachelor of Science in Hospitality Management','BSHM',1,1004);
INSERT INTO `usjr`.`programs` VALUES(1009,'Bachelor of Science in Hospitality Management Major in Food and Beverage','BSHM-FB',1,1004);
INSERT INTO `usjr`.`programs` VALUES(1010,'Associate in Hospitality Management','AHM',1,1004);
INSERT INTO `usjr`.`programs` VALUES(1011,'Associate in Tourism','ATourism',1,1004);
INSERT INTO `usjr`.`programs` VALUES(2001,'Bachelor of Arts in Communication','ABComm',2,2001);
INSERT INTO `usjr`.`programs` VALUES(2002,'Bachelor of Arts in English Language Studies','ABELS',2,2001);
INSERT INTO `usjr`.`programs` VALUES(2003,'Bachelor of Arts in Journalism','ABJournalism',2,2001);
INSERT INTO `usjr`.`programs` VALUES(2004,'Bachelor of Arts in Marketing Communication','ABMarComm',2,2001);
INSERT INTO `usjr`.`programs` VALUES(2005,'Bachelor of Science in Biology Major in Medical Biology','BSBio-MB',2,2002);
INSERT INTO `usjr`.`programs` VALUES(2006,'Bachelor of Science in Biology Major in Microbiology','BSBio-Microbio',2,2002);
INSERT INTO `usjr`.`programs` VALUES(2007,'Bachelor of Arts in Political Science','ABPolSci',2,2003);
INSERT INTO `usjr`.`programs` VALUES(2008,'Bachelor of Arts in International Studies','ABIS',2,2003);
INSERT INTO `usjr`.`programs` VALUES(2009,'Bachelor of Arts in Philosophy','ABPhilo',2,2003);
INSERT INTO `usjr`.`programs` VALUES(2010,'Bachelor of Science in Psychology','BSPsych',2,2004);
INSERT INTO `usjr`.`programs` VALUES(3001,'Bachelor of Science in Civil Engineering','BSCE',3,3001);
INSERT INTO `usjr`.`programs` VALUES(3002,'Bachelor of Science in Computer Engineering','BSCpE',3,3002);
INSERT INTO `usjr`.`programs` VALUES(3003,'Bachelor of Science in Electronics and Communications Engineering','BSECE',3,3003);
INSERT INTO `usjr`.`programs` VALUES(3004,'Bachelor of Science in Electrical Engineering','BSEE',3,3004);
INSERT INTO `usjr`.`programs` VALUES(3005,'Bachelor of Science in Industrial Engineering','BSIE',3,3005);
INSERT INTO `usjr`.`programs` VALUES(3006,'Bachelor of Science in Mechanical Engineering','BSME',3,3006);
INSERT INTO `usjr`.`programs` VALUES(4001,'Bachelor of Elementary Education','BEEEd',4,4001);
INSERT INTO `usjr`.`programs` VALUES(4002,'Bachelor of Early Childhood Education','BECE',4,4001);
INSERT INTO `usjr`.`programs` VALUES(4003,'Bachelor of Physical Education','BPE',4,4002);
INSERT INTO `usjr`.`programs` VALUES(4004,'Bachelor of Secondary Education Major in English','BSEd-English',4,4001);
INSERT INTO `usjr`.`programs` VALUES(4005,'Bachelor of Secondary Education Major in Filipino','BSEd-Filipino',4,4001);
INSERT INTO `usjr`.`programs` VALUES(4006,'Bachelor of Secondary Education Major in Mathematics','BSEd-Mathematics',4,4001);
INSERT INTO `usjr`.`programs` VALUES(4007,'Bachelor of Secondary Education Major in Science','BSEd-Science',4,4001);
INSERT INTO `usjr`.`programs` VALUES(4008,'Bachelor of Special Needs Education - Generalist','BSNE-General',4,4003);
INSERT INTO `usjr`.`programs` VALUES(4009,'Bachelor of Special Needs Education Major in Early Childhood Education','BSNE-ECE',4,4003);
INSERT INTO `usjr`.`programs` VALUES(4010,'Bachelor of Special Needs Education Major in Elementary School Teaching','BSNE-EST',4,4003);
INSERT INTO `usjr`.`programs` VALUES(5001,'Bachelor of Science in Computer Science','BSCS',5,5001);
INSERT INTO `usjr`.`programs` VALUES(5002,'Bachelor of Science in Information Technology','BSIT',5,5001);
INSERT INTO `usjr`.`programs` VALUES(5003,'Bachelor of Science in Information Systems','BSIS',5,5001);
INSERT INTO `usjr`.`programs` VALUES(5004,'Bachelor of Science in Entertainment and Multimedia Computing','BSEMC',5,5001);
INSERT INTO `usjr`.`programs` VALUES(6001,'Bachelof of Science in Nursing','BSN',6,6001);