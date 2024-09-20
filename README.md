# 📸 Dynamic S3 Image Handler

**Description**: A web application that enables image uploads under 1MB, with secure and scalable storage using AWS S3 and metadata management via RDS in a custom VPC. This application demonstrates efficient image handling while integrating multiple AWS services for a cloud-native architecture.

## 🌟 Features

- **User-friendly Image Upload**: A simple HTML interface for image uploads, which are stored both locally and in AWS S3.
- **AWS S3 Integration**: Secure storage of uploaded images in an S3 bucket with public-read access for easy retrieval via URLs.
- **RDS for Metadata**: Tracks metadata (uploader's name and image URL) in an RDS MySQL database.
- **Custom VPC**: Ensures secure communication between EC2 and RDS using custom security groups.
- **IAM Role Security**: Employs IAM roles and policies to securely manage access to AWS services.

## 🖼️ Project Architecture

### EC2 Instance:
- **LEMP Stack**: Hosts the web application using Linux, Nginx, MySQL, and PHP.
- **Image Upload Management**: Provides the form for image uploads and handles communication with AWS services.

### Amazon S3:
- **Image Storage**: Stores the uploaded image files securely.
- **Public-Read ACL**: Ensures uploaded images are accessible via public URLs.

### Amazon RDS (MySQL):
- **Metadata Storage**: Stores metadata such as uploader names and S3 URLs.
- **Secure Access**: EC2 and RDS communicate securely using VPC security groups.

### IAM Roles:
- **Access Control**: Controls access to S3 for image uploads and RDS for metadata management, using secure IAM roles and policies.

### VPC:
- **Network Isolation**: EC2 and RDS instances reside in the same VPC for secure and restricted communication.

## 🛠️ Setup and Installation

### 1. Launch EC2 Instance and Install LEMP Stack
- Launch an EC2 instance in your AWS account.
- Install the **LEMP stack** (Linux, Nginx, MySQL, PHP) to host the web application.
- Set up a directory on the EC2 instance for local image uploads.

### 2. Configure Amazon RDS
- Create an RDS MySQL instance in the same AWS region as your EC2 instance.
- Ensure the RDS security group allows inbound traffic from the EC2 instance.
- Create a database for storing metadata about uploaded images.

### 3. Create an S3 Bucket
- Create an S3 bucket with **public-read** access.
- Configure the bucket to store the images uploaded through the web application.

### 4. Install Composer and AWS SDK
- Install **Composer** on the EC2 instance for managing PHP dependencies.
- Use Composer to install the **AWS SDK for PHP** to interact with S3 and other AWS services programmatically.

### 5. Deploy the Web Application
- Set up the HTML form for image uploads.
- Implement PHP logic to:
  - Handle file uploads and store images in the `/uploads` directory.
  - Upload images to the S3 bucket.
  - Store metadata (uploader name, S3 URL) in the RDS database.

### 6. Access the Application
- Access the web application via the public IP of your EC2 instance.
- Upload an image and verify it is stored in both S3 and the local uploads directory.

### 7. Verify Uploads
- **Check S3**: Ensure the image is uploaded to the S3 bucket with public-read permissions.
- **Check RDS**: Verify the metadata (uploader name, image URL) is stored in the RDS MySQL database.

## 🚧 Troubleshooting

- **File Permissions**: Ensure correct ownership and permissions for the uploads directory and PHP files.
- **Database Connectivity**: Verify that the EC2 instance can communicate with RDS by checking the security group rules.
- **Composer Issues**: Ensure Composer is installed correctly and is managing the necessary PHP packages, including the AWS SDK.

## 🛠️ AWS Resources Used

- **EC2 Instance**: Runs the web application and handles user requests.
- **S3 Bucket**: Securely stores uploaded image files with public-read access.
- **RDS MySQL**: Stores metadata related to uploaded images.
- **IAM Roles**: Manages secure access to AWS services (S3 and RDS).
- **VPC**: Provides a secure networking environment for EC2-RDS communication.

## 📈 Benefits of the Application

- **Scalable Storage**: S3 provides scalable storage for uploaded images.
- **Secure Access**: IAM roles restrict access to AWS resources, ensuring secure interactions.
- **Easy Access to Images**: Public-read access allows for quick and easy image retrieval via URL.
- **Efficient Metadata Management**: RDS provides a reliable and secure way to store and manage metadata for uploaded images.

## 📝 Conclusion

**Dynamic S3 Image Handler** demonstrates the integration of several AWS services to create a scalable and secure image management solution. By leveraging **S3** for storage, **RDS** for metadata management, and **IAM roles** for security, this project showcases best practices in cloud architecture. The project highlights practical usage of the **AWS SDK** to interact with services programmatically.
