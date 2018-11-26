Demo Project - To Do List

```
todo_db
```

```
CREATE TABLE `tasks` (
  `task_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) NOT NULL,
  `task_description` varchar(500) NOT NULL,
  `task_date` varchar(25) NOT NULL,
  `task_user` varchar(255) NOT NULL,
  `task_status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```
