# Stunning

## Installation

Follow these steps to set up the project:

1. Clone the repository:

    ```bash
    git clone git@github.com:AztyMatt/stunning.git
    ```

2. Navigate to the project directory:

    ```bash
    cd stunning
    ```

3. Start the Docker containers:

    ```bash
    docker compose up -d
    ```

4. Access the PHP container:

    ```bash
    docker compose exec -ti php bash
    ```

5. Install the project dependencies:

    ```bash
    composer install
    ```

6. Set the application secret:

    ```bash
    php bin/console secrets:set APPSECRET
    ```

7. Load the database fixtures:
    ```bash
    php bin/console doctrine:fixtures:load -n
    ```

## Credentials

After loading the database fixtures, you can use the following credentials to log in:

### Users:
- **alice@example.com** / stunning
- **bob@example.com** / stunning
- **charlie@example.com** / stunning
- **dave@example.com** / stunning
- **eve@example.com** / stunning
- **frank@example.com** / stunning
- **grace@example.com** / stunning
- **heidi@example.com** / stunning
- **ivan@example.com** / stunning
- **judy@example.com** / stunning

### Admin Account:
- **admin@stunning.com** / $stunning$

## MailHog

If you don't modify the email configuration, you can view the emails sent by the application through **MailHog** by visiting:

- **URL**: [http://localhost:8025/](http://localhost:8025/)

This allows you to inspect the emails that would be sent in a real environment without actually sending them.

## Usage

After completing the installation steps, your local version of Stunning should be up and running. You can access it via your web browser:

-   **HTTP:** Port 80
-   **HTTPS:** Port 443

## Requirements

There is a requirements document available in the repository, named **CAHIER-DES-CHARGES.md**. You can find detailed information about the project's specifications and requirements there. Feel free to consult it for further details.