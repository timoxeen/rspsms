alter table `smsindia`.`fa_user_temp` 
   add column `dob` date NULL after `user_name`l
   
alter table `smsindia`.`fa_user_temp` 
   add column `gender` varchar(2) NULL after `dob`;