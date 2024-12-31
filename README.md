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

## Usage

After completing the installation steps, your local version of Stunning should be up and running. You can access it via your web browser:

-   **HTTP:** Port 80
-   **HTTPS:** Port 443
