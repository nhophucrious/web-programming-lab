# generate dummy course data to test pagination
# Usage: python generate_course.py
import mysql.connector
from faker import Faker
import random
from datetime import datetime, timedelta

# establish connection to MySQL
cnx = mysql.connector.connect(user='root', password='',
                              host='127.0.0.1',
                              database='web_programming_lab')

# create a cursor object
cursor = cnx.cursor()

# create a Faker instance
fake = Faker()

def generate_course():
    # generate fake course data
    course_name = fake.word().capitalize() + " " + fake.word().capitalize()
    course_price = round(random.uniform(50, 500), 2)
    description = fake.text()
    date_added = fake.date_between(start_date='-1y', end_date='today')

    # image
    image_id = fake.random_int(min=1, max=1084)
    url = "https://picsum.photos/id/" + str(image_id) + "/200/200"

    return (course_name, course_price, description, url, date_added)

# generate 200 courses
for _ in range(10):
    course = generate_course()
    add_course = ("INSERT INTO courses "
                  "(course_name, course_price, description, url, date_added) "
                  "VALUES (%s, %s, %s, %s, %s)")
    cursor.execute(add_course, course)

# commit the changes
cnx.commit()

# close the cursor and connection
cursor.close()
cnx.close()