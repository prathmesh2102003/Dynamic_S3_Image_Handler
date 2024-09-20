# Dynamic S3 Image Handler
Description: Developed a web application for managing image uploads under 1MB, integrating seamless storage with AWS S3 and data tracking via RDS within a custom VPC environment.

Features
User-friendly Image Upload: A simple HTML interface allows users to upload images, which are then stored both locally and in AWS S3.
AWS S3 Integration: Uploaded images are securely stored in an S3 bucket with public-read access.
RDS for Metadata: Stores metadata (uploader's name and image URL) in an RDS MySQL database.
Custom VPC: Ensures secure communication between EC2 and RDS via custom security groups.
IAM Role Security: Implements IAM roles and policies to control access to AWS resources.
Project Architecture
EC2 Instance:

Hosts the web application on a LEMP stack (Linux, Nginx, MySQL, PHP).
Manages the form for image upload and communicates with AWS services.
Amazon S3:

Stores the uploaded image files.
Public-read ACL ensures the uploaded images are accessible via URLs.
Amazon RDS (MySQL):

Stores the image metadata (uploader name and S3 URL).
Connected to EC2 via security groups for secure database access.
IAM Roles:

Provides secure access to S3 for uploading images and to RDS for managing metadata.
VPC:

EC2 and RDS are configured within the same VPC to restrict network access and ensure security.
Setup and Installation
1. Launch EC2 Instance and Install LEMP Stack
Launch an EC2 instance in your AWS account and install the LEMP stack.
Set up a directory to store uploaded images locally.
2. Configure Amazon RDS
Create an RDS MySQL instance in the same region as your EC2 instance.
Ensure that RDS security groups allow inbound traffic from the EC2 instance.
Create a database to store metadata for uploaded images.
3. Create an S3 Bucket
Create an S3 bucket with ACL-enabled settings and configure it to allow public read access.
This bucket will store the images uploaded through the web application.
4. Install Composer and AWS SDK
Install Composer on the EC2 instance to manage PHP dependencies.
Use Composer to install the AWS SDK for PHP, which allows interaction with S3 and other AWS services programmatically.
5. Deploy Web Application
Set up the HTML form to allow users to upload images.
Implement PHP logic to handle file uploads, store images in the /uploads directory and the S3 bucket, and store metadata in the RDS database.
6. Access the Application
Access the web application using the public IP address of your EC2 instance.
Upload an image, which will be stored in S3 and have its metadata stored in RDS.
7. Verify Uploads
Check S3: Ensure that the image has been uploaded to the correct S3 bucket with public-read permissions.
Check RDS: Verify that the image metadata (name and URL) is correctly stored in the RDS MySQL database.
Troubleshooting
File Permissions: Ensure proper ownership and permissions for the uploads directory and PHP files.
Database Connectivity: Verify that the EC2 instance can communicate with the RDS instance by ensuring the security group settings are correct.
Composer Issues: Make sure Composer is installed properly to manage the required PHP packages, including the AWS SDK.
AWS Resources Used
EC2 Instance: Runs the web application and handles requests.
S3 Bucket: Stores the uploaded image files.
RDS MySQL: Stores metadata for uploaded images.
IAM Roles: Controls access to AWS services.
VPC: Provides a secure networking environment for EC2 and RDS communication.
Conclusion
S3SnapStore showcases how to integrate several AWS services into a full-stack web application. By leveraging S3 for scalable storage, RDS for metadata management, and IAM roles for security, this project highlights the essential principles of cloud architecture and demonstrates practical use of AWS SDK for interacting with these services.
