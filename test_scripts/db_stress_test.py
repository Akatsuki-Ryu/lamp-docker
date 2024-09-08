#  pip install mysql-connector-python

import mysql.connector
import time
import random
from concurrent.futures import ThreadPoolExecutor, as_completed

# Database connection configuration
config = {
    'user': 'root',
    'password': 'root_password',
    'host': 'localhost',
    'database': 'lamp_db',
    'port': 3306,
    'ssl_disabled': True,
    'tls_versions': ['TLSv1.2']  # Add this line
}

# Test configuration
NUM_RECORDS = 10000
NUM_THREADS = 10
READ_RATIO = 0.8  # 80% reads, 20% writes

def create_table():
    conn = mysql.connector.connect(**config)
    cursor = conn.cursor()
    cursor.execute("""
    CREATE TABLE IF NOT EXISTS stress_test (
        id INT AUTO_INCREMENT PRIMARY KEY,
        data VARCHAR(255),
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
    """)
    conn.commit()
    cursor.close()
    conn.close()

def insert_record():
    conn = mysql.connector.connect(**config)
    cursor = conn.cursor()
    data = ''.join(random.choices('abcdefghijklmnopqrstuvwxyz', k=10))
    cursor.execute("INSERT INTO stress_test (data) VALUES (%s)", (data,))
    conn.commit()
    cursor.close()
    conn.close()

def read_record():
    conn = mysql.connector.connect(**config)
    cursor = conn.cursor()
    cursor.execute("SELECT * FROM stress_test ORDER BY RAND() LIMIT 1")
    result = cursor.fetchone()
    cursor.close()
    conn.close()
    return result

def worker():
    if random.random() < READ_RATIO:
        return read_record()
    else:
        return insert_record()

def run_stress_test():
    create_table()
    start_time = time.time()

    with ThreadPoolExecutor(max_workers=NUM_THREADS) as executor:
        futures = [executor.submit(worker) for _ in range(NUM_RECORDS)]
        for future in as_completed(futures):
            future.result()

    end_time = time.time()
    duration = end_time - start_time
    ops_per_second = NUM_RECORDS / duration

    print(f"Stress test completed in {duration:.2f} seconds")
    print(f"Operations per second: {ops_per_second:.2f}")

if __name__ == "__main__":
    run_stress_test()