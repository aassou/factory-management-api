# Factory Management: API

This is a Symfony based project API, designed to manage small industrial factories.


## Requirements
    - PHP 8.0.5 Or above.
    - MySQl
## Getting Started
### 1. Clone the project
```bash
# Clone this repository
$ git clone https://gitlab.com/aassou/factory-management-api.git

# Go into the repository
$ cd factory-management-api

```

### 2. Install the dependencies
You can install the dependencies with this command

```bash
$ composer install
```

### 3. Create env file

Create an env file with the name ".env.local" and copy the content of ".env" to it. 
Then in your .env.local file change the database credentials with your ones:
<br />
```bash
mysql://username:password@127.0.0.1:3306/database_name?serverVersion=5.7
```

###4. Database creation:

Create the database by running the next command:

```bash
$ php bin/console doctrine:database:create
```

### 5. Create and Run Migrations
```bash
# Create migration
$ php bin/console make:migration

# Run migration
$ php bin/console doctrine:migrations:migrate

```

### 6. Generate JWT key
 ```bash
$ php bin/console lexik:jwt:generate-keypair
```

### 7. Start the server

```bash
$ symfony serve
```





