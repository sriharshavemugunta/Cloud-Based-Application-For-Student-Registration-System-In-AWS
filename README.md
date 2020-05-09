# Cloud-Based-Application-For-Student-Registration-System-In-AWS
The postman application is to handle the requests from students to enroll or disenroll from courses.
Amazon Simple Queuse Service (SQS) carries the message through a queue and triggers a lambda function.
The create, update and delete commands are directed to write lambda function and read queries are directed to query function.
The write lambda function consists of python code related to adding the information in the MySQL Server using Relational Database Service (RDS).
The query lambda function consists of python code related to retrieving the information from the MySQL Server using Relational Database Service (RDS).
The EC2 instance is used to create the databases schema in the RDS instance.
Cloud watch is used to monitor the students requests.
