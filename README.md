# PHP OOP Project: Login and Registration System

## Overview

This PHP OOP project is a simple yet robust login and registration system with administrative functionalities. The project incorporates essential security features such as password hashing and regular expression validation. MySQL is employed as the database to store user information, and sessions are utilized to maintain login states.

## Features

- **User Registration**: Users can register by providing a username, email, birthdate, and password. Passwords are hashed for added security.

- **User Login**: Registered users can log in using their email and password. Sessions are used to maintain login states.

- **Admin Access**: The system includes an admin role. Admins can register and log in using the provided functionality.

- **Dashboard**: Upon successful login, the admin is directed to the dashboard, which displays basic user information, including usernames and emails.

- **User Management**: Admins have the ability to view, edit, and delete user data directly from the dashboard.

## Security Measures

- **Password Hashing**: User passwords are hashed before storage in the database, enhancing security.

- **Password Strength Validation**: A regular expression (regex) is employed to validate password strength during registration.

- **Session Management**: Sessions are utilized to maintain login states, ensuring secure user interactions.

## Technology Stack

- **PHP**: The server-side scripting language used for backend logic.

- **MySQL**: The relational database management system used to store user information.

## Usage

1. **User Registration**:

   - Navigate to the registration page.
   - Provide a username, email, birthdate, and password.
   - Click the "Sign up" button to register.

2. **User Login**:

   - Access the login page.
   - Enter the registered email and password.
   - Click the "Login" button.

3. **Admin Access**:

   - Admins can register and log in using the designated admin functionality.

4. **Dashboard**:

   - Upon admin login, the dashboard displays user information and management options.

5. **User Management**:
   - Admins can view, edit, and delete user data from the dashboard.

## Security Recommendations

- Always use strong and unique passwords.
- Regularly update and patch server software.
- Implement SSL for secure data transmission.
- Regularly backup the database to prevent data loss.

## Contribution

Contributions are welcome! Feel free to fork the repository, make improvements, and submit pull requests.

## License

This project is licensed under the [MIT License](LICENSE).
