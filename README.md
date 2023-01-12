## Introduction

Vacation manager is a simple application that is supposed to demonstrate the process of managing vacations and vacation requests within a single company.

Within the company, there are multiple teams. There is no limit to number of members within a team. Each team must have exactly one *project leader* and exactly one *team leader*. All other team members can only be employees. 

Employees make *vacation requests*, review previous requests and cancel pending requests. In order for vacation request to be approved, both project leader and team leader have to approve it. If one of them declines it, vacation request is automatically declined.

## 1.Usage 
### 1.1 Login
Upon opening the application, user is first prompted to login. 
There are three types of users, in regard of their roles:
#### Employee
Represents simple employee within a firm. Employee belongs to only one team. Employee can review all his requests, make new requests and cancel existing requests.
#### Approver
Approvers are users that are team leaders or project leaders. They do not make requests. They can review, approve or decline vacation requests that are created by members of their team.
#### Admin
Application administrator. Admin can add new users, edit roles of existing users and review all users within the app and their requests. Admin cannot approve or decline requsts.
### 1.2 Dashboard
Depending on the role, users have different dashboards that are reached after logging in. 

*Employee* can only access his own dashboard. 

*Approver* has his own dashboard and can access *Employee* dashboards of his team members, but with limited privileges.

*Admin* has his own dashboard and can access dashboards of all users, but with limited privileges.

## 2. Demo use
XAMPP is needed in order to run a mysql server and a designated database needs to be created on that server.
After that, using artisan tool, you need to first make migrations and seed the database.
After those preparations, you can serve the app using artisan tool.

Login with credentials of any user that is seeded in the database, or create your own(Add to DatabaseSeeder.php, Add to database using phpmyadmin, or add with admin user).

### Note
App is primarily designed to demonstrate backend features, so the frontend part of the app is not particularily refined.

