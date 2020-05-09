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
    if command=="student_list":
        with conn.cursor() as cur:
            select_stmt = "SELECT * FROM STUDENTS;"
            print(cur.execute(select_stmt))
            records = cur.fetchall()
            for row in records:
                print("STUDENTID = ", row[0], )
                print("STUDENTNAME = ", row[1])
                print("STUDENTEMAIL  = ", row[2], "\n")
            conn.commit()
        conn.commit()
    if command=="student_courses":
        studentid = body.split(" ")[1]
        with conn.cursor() as cur:

            cur.execute('SELECT * FROM ENROLLMENTS WHERE STUDENTID= %s;',studentid)
            records = cur.fetchall()
            for row in records:
                print("STUDENTID = ", row[0], )
                print("COURSEID = ", row[1], "\n")
            conn.commit()
        conn.commit()
