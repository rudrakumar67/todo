# Laravel assessment
## _Todo reminder with email notification_

## Features

- User registration and authentication
- Task management: Users can create, view, edit, and delete tasks in their to-do list.
- Users can change the status of their tasks. such as "to-do," "in progress," or "completed,".
- Users can prioritize their tasks, such as by setting a due date or marking a task as urgent.
- Reminders: Users can to set reminders for their tasks, such as by receiving email notifications or alert in Home page.

## Additional used packeges 
-   Laravel/ui for default authentication 

## Due date reminder via email

-   Tasks which is not completed and 1 day left to complete will be notified via email
-   Added dismissable alert in home page for the same 
-   Scheduler command is mentioned below

### Manual testing
```sh
php artisan auto:todoreminer
```

### For Cronjob
```sh
crontab -e
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1.
```
