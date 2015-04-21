# PHPAssignment

Make sure to set the corresponding permissions to example.csv (chmod 666 example.csv).

Api URL format:

The domain.com/endpoint URL format will only work if .htaccess files are enabled in Apache.
To do this set AllowOverride All in the directory tag in the apache config file. Also make sure the rewrite module is enabled (sudo a2enmod rewrite).
If this is not possible the URL should be domain.com/index.php/endpoint

Tests:

install phpUnit with composer (https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx):
    composer install
run tests:
    phpunit -- bootstrap bootstrap.php test