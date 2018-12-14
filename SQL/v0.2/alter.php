ALTER TABLE `shirts` ADD FOREIGN KEY (`shirttypeid`) REFERENCES shirttype(`id`);
ALTER TABLE `shirts` ADD FOREIGN KEY (`statusid`) REFERENCES status(`id`)

ALTER TABLE `shirtcategories` ADD FOREIGN KEY (`shirtsid`) REFERENCES shirts(`id`)

ALTER TABLE `shirtcategories` ADD FOREIGN KEY (`shirtypeid`) REFERENCES shirtype(`id`)

--------shirtcategory
ALTER TABLE `shirtcategories` ADD FOREIGN KEY (`statusid`) REFERENCES status(`id`);
ALTER TABLE `shirtcategories` ADD FOREIGN KEY (`producttypeid`) REFERENCES producttype(`id`);
ALTER TABLE `shirtcategories` ADD FOREIGN KEY (`productstatusid`) REFERENCES productstatus(`id`);



-------17 aug
ALTER TABLE `shirtimages` ADD FOREIGN KEY (`newarrivalproductid`) REFERENCES newarrivalproduct(`id`);
ALTER TABLE `shirtimages` ADD FOREIGN KEY (`trenddingproductid`) REFERENCES trenddingproduct(`id`);
ALTER TABLE `shirtimages` ADD FOREIGN KEY (`shirtcategoriesid`) REFERENCES shirtcategories(`id`);



new arrival's
ALTER TABLE `newarrivalproduct` ADD `offer` INT NOT NULL AFTER `price`;
ALTER TABLE `newarrivalproduct` ADD `offerprice` FLOAT(9,2) NOT NULL AFTER `price`;

ALTER TABLE `user` ADD FOREIGN KEY (`status_id`) REFERENCES status(`id`)