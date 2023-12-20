# Update und Upgrade des Systems
sudo apt update
sudo apt upgrade -y

# Installation NGINX
sudo apt install nginx -y

# Installation MySQL statt MariaDB
sudo apt-get install mysql-server -y

# PHP und verwandte Module
sudo apt install php php-fpm php-mysql -y

# Installation MySQL (falls notwendig)
sudo mysql_secure_installation

# Installation PHPMyAdmin
sudo apt install phpmyadmin -y

# NGINX-Konfiguration für PHPMyAdmin
echo "location /phpmyadmin {
    alias /usr/share/phpmyadmin;
    index index.php;
    try_files \$uri \$uri/ =404;
    fastcgi_pass unix:/var/run/php/php7.3-fpm.sock;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
}" | sudo tee -a /etc/nginx/sites-available/default

# NGINX neu starten
sudo service nginx restart

# PHP-FPM neu starten
sudo service php7.3-fpm restart
