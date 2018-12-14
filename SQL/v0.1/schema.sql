CREATE TABLE IF NOT EXISTS `userroles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_id` (`org_id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(500) DEFAULT NULL,
  `username` varchar(700) DEFAULT NULL,
  `email` varchar(700) DEFAULT NULL,
  `password` varchar(700) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `image` varchar(700) DEFAULT NULL,
  `status_id` int(2) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isverify` int(1) DEFAULT '0',
  `mobverify` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(700) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mode` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `organisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orgname` varchar(500) DEFAULT NULL,
  `orgtype` varchar(100) DEFAULT NULL,
  `orgimage` varchar(700) DEFAULT NULL,
  `address1` varchar(700) DEFAULT NULL,
  `address2` varchar(700) DEFAULT NULL,
  `phone1` varchar(50) DEFAULT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `landmark` varchar(300) DEFAULT NULL,
  `pincode` varchar(500) DEFAULT NULL,
  `state` varchar(300) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `website` varchar(500) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `createdat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedat` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(700) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `coursesstatus` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `subject` varchar(200) NOT NULL,
  `coursesstatusid` int(5) NOT NULL,
  `coursemodeid` int(2) NOT NULL,
  `organisationid` int(11) NOT NULL,
  `publishdate` date NOT NULL,
  `expirydate` date NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fees` float(9,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coursemodeid` (`coursemodeid`),
  KEY `coursesstatusid` (`coursesstatusid`),
  KEY `organisationid` (`organisationid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `coursemode` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `coursedepartment` (
  `course_id` int(2) NOT NULL,
  `deptid` int(2) NOT NULL,
  KEY `course_id` (`course_id`),
  KEY `deptid` (`deptid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `coursecontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(2) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `displayorder` int(11) NOT NULL,
  `coursesstatus` int(5) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publishdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `coursebranch` (
  `course_id` int(5) NOT NULL,
  `branchid` int(5) NOT NULL,
  KEY `course_id` (`course_id`),
  KEY `branchid` (`branchid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;