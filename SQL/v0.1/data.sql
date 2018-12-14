INSERT INTO `branch` (`id`, `name`) VALUES
(1, 'Java'),
(2, 'Angular');

INSERT INTO `coursemode` (`id`, `name`) VALUES
(1, 'publish');

INSERT INTO `coursesstatus` (`id`, `name`) VALUES
(1, 'Published'),
(2, 'Expired'),
(3, 'Draft');


INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Human Resources'),
(2, 'IT');

INSERT INTO `roles` (`id`, `name`, `mode`) VALUES
(1, 'Admin', '1'),
(2, 'Organisation', '1'),
(3, 'Employee', '1');

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Inactive'),
(2, 'Active');

INSERT INTO `subject` (`id`, `name`) VALUES
(1, 'Java');