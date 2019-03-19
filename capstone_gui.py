##SQL CONNECTOR CAPSTONE
##If first time first do pip install mysql-connector in terminal or command prompt
##Change file path to your new csv file.
import mysql.connector
conn=mysql.connector.connect(user="root",password="",host="localhost",database="transfer")
mycursor=conn.cursor()
mycursor.execute("DROP TABLE DATA")
mycursor.execute("CREATE TABLE DATA (\
                 ORG_CODE_ID VARCHAR(255),\
                 SCHOOL VARCHAR(255),\
                 TRANSFER_COURSE VARCHAR(255),\
                 TRANSFER_TITLE VARCHAR(255),\
                 TRANSFER_SUB_TYPE VARCHAR(255),\
                 ARCADIA_COURSE VARCHAR(255),\
                 ARCADIA_SUB_TYPE VARCHAR(255),\
                 ARCADIA_TITLE VARCHAR(255),\
                 CURRICULAR_REQUIREMENT VARCHAR(255));")
mycursor.execute("""LOAD DATA INFILE '/Users/dylanpower/transferequivalencytable.csv'
                 INTO TABLE DATA
                 FIELDS TERMINATED BY ','
                 ENCLOSED BY '"'
                 LINES TERMINATED BY '\n'
                 IGNORE 1 ROWS;""")
mycursor.execute("SELECT * FROM DATA")
print(mycursor.fetchall())