# Laravel assessment
## _Todo application with email notification_

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
Project Screenshots screenshot attached below please take a look

![image](https://user-images.githubusercontent.com/122020483/221417620-c6ef3e68-b125-4759-a306-49c4194e64d6.png)
![image](https://user-images.githubusercontent.com/122020483/221417636-e56e7e98-6c95-4391-8957-b44e0824ca89.png)
![image](https://user-images.githubusercontent.com/122020483/221417647-c34dff8f-6ffd-45b8-87a2-f034a1faadbf.png)
![image](https://user-images.githubusercontent.com/122020483/221417668-5bbb18d0-fbd2-47e0-8aad-fbdee9419ebc.png)
![image](https://user-images.githubusercontent.com/122020483/221417682-58e860dd-0b12-41a6-a011-25f9892aa61f.png)
![image](https://user-images.githubusercontent.com/122020483/221417701-273aca75-503d-44cf-920b-2b55816e469c.png)
![image](https://user-images.githubusercontent.com/122020483/221417736-4e6da185-e7fb-49f6-9bab-ac09c33fc31e.png)
