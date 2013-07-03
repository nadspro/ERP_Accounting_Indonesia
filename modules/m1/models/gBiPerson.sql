CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `g_bi_person` AS 
select `a`.`id` AS `id`,
`a`.`employee_name` AS `employee_name`,
`a`.`birth_place` AS `birth_place`,
`a`.`birth_date` AS `birth_date`,

FLOOR(DATEDIFF(CURRENT_DATE, STR_TO_DATE(`a`.`birth_date`, "%Y-%m-%d"))/365) AS `age`,
`a`.`sex_id` AS `sex_id`,
`a`.`religion_id` AS `religion_id`,
`a`.`address1` AS `address1`,
`a`.`identity_address1` AS `identity_address1`,
`a`.`blood_id` AS `blood_id`,
`a`.`account_number` AS `account_number`,
`a`.`account_name` AS `account_name`,
`a`.`bank_name` AS `bank_name`,

`a`.`email` AS `email`,
`a`.`email2` AS `email2`,

`a`.`home_phone` AS `home_phone`,

`a`.`handphone` AS `handphone`,
`a`.`handphone2` AS `handphone2`,

(select `o`.`name` from `g_person_career` `c`
  left join a_organization o on o.id = c.company_id 
  where ((`a`.`id` = `c`.`parent_id`) and 
  (`c`.`status_id` in (1,2,3,4,5,6,15))) 
  order by `c`.`start_date` desc limit 1) AS `company`,

(select `o`.`name` from `g_person_career` `c` 
  left join a_organization o on o.id = c.department_id 
  where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` 
  in (1,2,3,4,5,6,15))) order by `c`.`start_date` 
  desc limit 1) AS `department`,

(select `o`.`name` from `g_person_career` `s` 
  left join g_param_level o on o.id = s.level_id 
  where (`s`.`parent_id` = `a`.`id`) order by `s`.`start_date` 
  desc limit 1) AS `level`,
  
(select `c`.`job_title` from `g_person_career` `c` 
  where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` 
  in (1,2,3,4,5,6,15))) order by `c`.`start_date` desc limit 1) 
  AS `job_title`,
  
(select `p`.`name` from `g_person_status` `s` 
  left join s_parameter p on p.code = s.status_id AND p.type = "AK" 
  where (`s`.`parent_id` = `a`.`id`) order by `s`.`start_date` 
  desc limit 1) AS `employee_status`,
 
(select `c`.`start_date` from `g_person_career` `c` 
  where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` 
  = 1)) order by `c`.`start_date` 
  desc limit 1) AS `join_date`,

FLOOR(DATEDIFF(CURRENT_DATE, STR_TO_DATE((select `c`.`start_date` from `g_person_career` `c` 
  where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` 
  = 1)) order by `c`.`start_date` 
  desc limit 1), "%Y-%m-%d"))/365) AS join_year, MOD(period_diff(date_format(now(), '%Y%m'), date_format((select `c`.`start_date` from `g_person_career` `c` 
  where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` 
  = 1)) order by `c`.`start_date` 
  desc limit 1), '%Y%m')),12) as join_month  
 
  
from `g_person` `a`