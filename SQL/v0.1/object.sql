--
ALTER TABLE `coursebranch`
  ADD CONSTRAINT `coursebranch_ibfk_3` FOREIGN KEY (`branchid`) REFERENCES `branch` (`id`),
  ADD CONSTRAINT `coursebranch_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `coursebranch_ibfk_2` FOREIGN KEY (`branchid`) REFERENCES `branch` (`id`);

--
-- Constraints for table `coursedepartment`
--
ALTER TABLE `coursedepartment`
  ADD CONSTRAINT `coursedepartment_ibfk_3` FOREIGN KEY (`deptid`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `coursedepartment_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `coursedepartment_ibfk_2` FOREIGN KEY (`deptid`) REFERENCES `department` (`id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_3` FOREIGN KEY (`coursemodeid`) REFERENCES `coursemode` (`id`),
  ADD CONSTRAINT `courses_ibfk_6` FOREIGN KEY (`coursesstatusid`) REFERENCES `coursesstatus` (`id`),
  ADD CONSTRAINT `courses_ibfk_7` FOREIGN KEY (`organisationid`) REFERENCES `organisation` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `userroles`
--
ALTER TABLE `userroles`
  ADD CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organisation` (`id`),
  ADD CONSTRAINT `userroles_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `userroles_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);