<p align="center">
  <a href="https://boxity.id">
    <img src="https://res.cloudinary.com/boxity-id/image/upload/v1634111737/powered_by_gdxnxg.png" width="318px" alt="Boxity logo" />
  </a>
</p>

### Installation
1. Clone the repository first
   ```sh
   git clone https://github.com/The-Boring-Organizations/boxity-app
   ```
2. Make sure the ```npm or yarn package``` was installed on your root server.
3. Run the ```npm install``` to install the npm package of the project.
3. Then you can run ```npm run production``` to ensure your project establishes.
3. Copy env File to the directory
    ```
    cp .env.example .env
    ```
    and then
    ```
    nano .env
    ``
4. Dont forget to set the .env file,
    ```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1 <- Your site IP
    DB_PORT=3306 <- Dont forget the port of your hosting databases
    DB_DATABASE= (Your database name)
    DB_USERNAME= (Your database username connection)
    DB_PASSWORD= (Your database password if exist)
    
    SET MAILER CONFIG
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io <- Your email host
    MAIL_PORT=2525
    MAIL_USERNAME=de6b1c11b67b43 <- Your mail username / email
    MAIL_PASSWORD=7badd9a3876f36 <- Your mail password
    MAIL_ENCRYPTION=tls
    ```
5. Install composer by running
    ```sh
    composer install
    ```
5. Run the app key, migrate the database and also optimize the artisan
    ```
    php artisan key:generate
    ```
    ```
    php artisan migrate
    ```
    ```
    php artisan db:seed
    ```
    ```
    php artisan optimize:clear
    ```
