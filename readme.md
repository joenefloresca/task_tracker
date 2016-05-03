## QDF Tasks Tracker

QDF Tasks Tracker - is a web-based application to track daily tasks of employees which can be viewed by
supervisors. You can add your tasks, assign it as daily or additional task and mark it as pending or done.

## Process

* Register for your account http://192.168.3.164/task_tracker/public/index.php/auth/login
* Login http://192.168.3.164/task_tracker/public/index.php/auth/login
* Upon login you will be directed to your tasks list page which has three sections
	* My Daily Tasks - Which contains all your tasks tagged as your daily tasks. All created tasks will be marked as pending and can be changed by clicking 'Details' button in the 'Action' column and a pop-up box will appear allowing you to change the status of the task.
	* My Additional Tasks - This is your additional tasks either added by you or added by supervisor and assigned to you.
	* Generate Report - This where you will submit your tasks to the supervisor. When you click the 'Generate' button it will get all your tasks and its tagged status within the last 12 hours from the current time. It will be auto-populated in the Generate Report table as an overview for you to see the report that you will send to the supervisor. Once generated. You can click the 'Send Report' button and the system will send your task report to the supervisor.


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
