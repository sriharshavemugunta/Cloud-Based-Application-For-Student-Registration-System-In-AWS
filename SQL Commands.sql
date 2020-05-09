CREATE TABLE STUDENTS(   
  STUDENTID varchar(10) primary key,    
  STUDENTNAME  varchar(20),     
  EMAIL  varchar(20),     
);

CREATE TABLE COURSES(
    COURSEID varchar(5) primary key,
    COURSENAME  varchar(15),
    CREDITS int
);

CREATE TABLE ENROLLMENTS(
	STUDENTID varchar(10),
    COURSEID varchar(10)
);

CREATE TABLE DISENROLLMENTS(
	STUDENTID varchar(10),
    COURSEID varchar(10)
);
