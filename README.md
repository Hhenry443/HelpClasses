# Helper Files Collection

A collection of utility functions and database helper classes that can be used in various projects. These helper files are written in PHP and provide a range of useful methods to streamline development, including functions for string manipulation, database operations, and more.

## Overview

This repository contains PHP helper classes that can be used across different projects. Some key features include:

- **Utility Class**: A collection of helper methods for tasks like redirecting URLs, inspecting variables, sanitizing input, and more.
- **DatabaseHelper Class**: A class for performing common database operations like SELECT, INSERT, UPDATE, DELETE, and counting records with PDO.

## Files

### `Utility.php`

A utility class with commonly used methods:

- **`basePath()`**: Get the base path of the project.
- **`inspect()`**: Display a variable's contents in a human-readable format.
- **`inspectAndDie()`**: Inspect a variable and terminate the script.
- **`formatSalary()`**: Format salary as currency.
- **`sanitise()`**: Sanitize a string for safe use in HTML or SQL.
- **`redirect()`**: Redirect the user to a different URL.
- **`randomString()`**: Generate a random string of a given length.
- **`isJson()`**: Check if a string is valid JSON.
- **`formatDate()`**: Format a date string.
- **`logDebug()`**: Log debugging messages to a file.
- **`contains()`**: Check if a string contains a specific substring.
- **`sanitiseArray()`**: Sanitize an array of data.
- **`pluralize()`**: Return the plural form of a word based on the count.

### `DatabaseHelper.php`

A class for interacting with a MySQL database using PDO:

- **`basicSelectAll()`**: Perform a simple SELECT query to retrieve all records from a table.
- **`basicSelectAllWhere()`**: Perform a SELECT query with a WHERE condition.
- **`insertRecord()`**: Insert a new record into a table.
- **`updateRecord()`**: Update a record in a table.
- **`deleteRecord()`**: Delete a record from a table.
- **`countRecords()`**: Count the number of records in a table.
- **`searchRecords()`**: Search for records with optional pagination.

## Installation

1. Clone the repository to your local machine:
   ```bash
   git clone https://github.com/Hhenry443/HelpClasses.git
   ```
2. Include the helper classes in your PHP project:
   ```
   require_once 'path/to/helperClass.php';
   require_once 'path/to/sqlHelpClass.php';
   ```
4. Use the classes as needed in your projects:
  - To use methods from the `Utility` class:
    
    ```php
    Utility::redirect('https://example.com');
    ```
  - To use methods from the `DatabaseHelper` class:

    ```php
    $dbHelper = new DatabaseHelper();
    $users = $dbHelper->basicSelectAll('users');
    ```
## Usage

### Utility Class

### Example Usage for `Utility.php`:

```php
<?php
require_once 'Utility.php';

Utility::inspect($data); // Inspect a variable
Utility::redirect('https://example.com'); // Redirect to another URL
```
### Example Usage for `DatabaseHelper.php`:

```php
<?php
require_once 'DatabaseHelper.php';

$dbHelper = new DatabaseHelper();
$users = $dbHelper->basicSelectAll('users'); // Get all users
$newUserId = $dbHelper->insertRecord('users', ['name' => 'John Doe', 'email' => 'john@example.com']); // Insert new user
```
