# Corephp Contact Form

## Introduction
This is a simple web application that allows users to submit a contact form. The application is built with CorePHP and uses a MySQL database to store form submissions. It also sends an email notification to the site owner whenever a new form submission is received.

## Requirements
- PHP (minimum version 7.4 or greater)
- MySQL (minimum version 5.7 or greater)
- Web server (e.g., Apache, Nginx)

## Setup Instructions

### 1. Database Configuration
- Create a new MySQL database using a tool like phpMyAdmin or the MySQL command line.
- Navigate to the `contact_form.sql` file provided with this application.
- Import the SQL file into your newly created database. This will set up the necessary table for storing form submissions.

### 2. Application Configuration
- Clone this repository or download the source code as a ZIP file.
- Upload the files to your web server's document root directory (e.g., /var/www/html/ for Apache).
- Navigate to the `config.php` file in the root directory and update the following database connection parameters:
  - `$host`: The database host (usually 'localhost').
  - `$username`: Your MySQL username.
  - `$password`: Your MySQL password.
  - `$database`: The name of the database you created in step 1.

### 3. Run the Application
- After setting up the database and updating the configuration, you can access the application by navigating to your domain or server IP address.
- The main form page should be accessible at: `http://your-domain.com/test_form.html` or `http://your-ip-address/test_form.html`.

## Notes
- This application uses CorePHP without any frameworks or external libraries to handle form submissions and database interactions.
- For email notifications to work, ensure that the `mail()` function is correctly configured on your server.
