# About the project
This Car for rent project was build in 3 weeks by PHP and MySQL with the guide of Mr. Bang and Mr. Tinh. Following MVC structure and have many components build from scratch. Deployed on AWS EC2 and using S3 for file storage

## Installation
Install Nginx following this [article](https://www.digitalocean.com/community/tutorials/how-to-install-nginx-on-ubuntu-20-04).

Create account on [AWS](https://aws.amazon.com/) to use the S3 service.

Clone project 
```bash
$ git clone https://github.com/tringuyennfq/CarForRent.git
```
Install Composer
```bash
$ composer install
```

## Usage

Install PHP Dotenv

```bash
$ composer require vlucas/phpdotenv
```
Install PHP JWT

```bash
$ composer require firebase/php-jwt
```

Install AWS SDK for PHP
```bash
$ composer require aws/aws-sdk-php
```
Don't forget to create an .env file and edit 


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
