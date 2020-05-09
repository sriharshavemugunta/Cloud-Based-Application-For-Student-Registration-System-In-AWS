import sys
import logging
import pymysql
import boto3
import json
import os
#rds settings
rds_host  = "mysqlserver.cmfds08voziu.us-east-1.rds.amazonaws.com"
name = "admin"
password = "password"
db_name = "STUDENTDB"

logger = logging.getLogger()
logger.setLevel(logging.INFO)

try:
    conn = pymysql.connect(rds_host, user=name, passwd=password, db=db_name, connect_timeout=5)
    print("Connected")
except pymysql.MySQLError as e:
    logger.error("ERROR: Unexpected error: Could not connect to MySQL instance.")
    logger.error(e)
    sys.exit()

logger.info("SUCCESS: Connection to RDS MySQL instance succeeded")
def handler(event, context):



    record = event["Records"][0]
    body = record["body"]
    command = body.split(" ")[0]
    if command=="register":
        studentid = body.split(" ")[1]
        name = body.split(" ")[2]
        email = body.split(" ")[3]
        with conn.cursor() as cur:
            cur.execute('INSERT INTO STUDENTS (STUDENTID, STUDENTNAME, STUDENTEMAIL) values(%s, %s , %s)',(studentid, name, email))
            conn.commit()
        conn.commit()
    if command=="enroll":
        studentid = body.split(" ")[1]
        courseid = body.split(" ")[2]
        with conn.cursor() as cur:
            cur.execute('INSERT INTO ENROLLMENTS (STUDENTID, COURSEID) values(%s, %s)',(studentid, courseid))
            conn.commit()
        conn.commit()
    if command=="disenroll":
        studentid = body.split(" ")[1]
        courseid = body.split(" ")[2]
        with conn.cursor() as cur:
            cur.execute('DELETE FROM ENROLLMENTS WHERE STUDENTID= %s AND COURSEID= %s;',(studentid, courseid))
            cur.execute('INSERT INTO DISENROLLMENTS (STUDENTID, COURSEID) values(%s, %s)',(studentid, courseid))
            conn.commit()
        conn.commit()
