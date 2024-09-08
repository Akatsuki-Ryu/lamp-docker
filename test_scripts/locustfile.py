# pip install locust
# locust -f locustfile.py --host=http://localhost

# this is a simple load test for the website

from locust import HttpUser, task, between

class WebsiteUser(HttpUser):
    wait_time = between(1, 5)  # Wait 1-5 seconds between tasks

    @task(3)
    def index_page(self):
        self.client.get("/")

    # @task(1)
    # def phpmyadmin_page(self):
    #     self.client.get("/linux24phpmyadmin/")

    # @task(2)
    # def large_file_upload(self):
    #     with open("large_file.bin", "rb") as file:
    #         self.client.post("/upload", files={"file": file})