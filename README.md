# ProveriProdavnica

![ProveriProdavnica Logo](screenshot.jpg)

"ProveriProdavnica" detects suspicious e-merchants, warns the consumer before every visit to a suspicious online store and visually displays the validity of the e-store itself through its automatic verification. The new web platform on the Macedonian market enables safer online shopping for consumers through automatic security checks on websites.

ProveriProdavnica is a platform developed by a team of five students from the Faculty of Economics and the Faculty of Information Sciences and Computer Engineering (FINKI). It was one of the three winning solutions at the hackathon for innovative solutions that help reduce the gray economy, organized by the Association for E-Trade of Macedonia (AETM) in May 2022.

## Table of Contents

- [Description](#description)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Contributors](#contributors)
- [License](#license)

## Description

ProveriProdavnica is a web platform aimed at combating the gray economy by providing a reliable way for consumers to verify the legitimacy of registered businesses. The platform allows users to search for and view verified businesses and their details, helping consumers make informed decisions while promoting legal and trustworthy trade.

The project is written in PHP and follows a modern web development approach. It utilizes a MySQL database to store business information and user data securely.

## Features

- Search for businesses based on various criteria (name, location, category, etc.).
- Display detailed information about each registered business.
- User registration and authentication system.
- Business registration and verification process.
- Admin panel to manage registered businesses and user accounts.
- Interactive and user-friendly interface.

## Installation

To set up ProveriProdavnica locally, follow these steps:

1. Clone the repository: `git clone https://github.com/simeonmarkoski/proveriprodavnica.git`
2. Navigate to the project directory: `cd proveriprodavnica`
3. Configure your web server (e.g., Apache) to serve the `public` directory as the document root.
4. Import the `database.sql` file into your MySQL database to create the necessary tables.
5. Configure the database connection settings in `config/database.php`.
6. Install dependencies using Composer: `composer install`

## Usage

1. Open your web browser and access your local ProveriProdavnica website.
2. Use the search bar to find registered businesses based on your criteria.
3. Click on a business to view its detailed information.
4. Users can register and log in to access additional features like adding reviews and ratings for businesses.
5. Business owners can register and verify their businesses through the platform's registration process.
6. Admins can access the admin panel to manage businesses and user accounts.

## Contributors

- Симеон Маркоски
- Фидан Стоименов
- Даниела Мурџеска
- Драгана Нелоска
- Габриела Козарова

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
