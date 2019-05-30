# Installation Instruction

```
Basic Environment Requirements:
- Ubuntu 18.04 LTS or Similar
- PHP 5.6 or above
- MySQL
```
- Place this folder in to `/var/www/`.
- Run `sudo gedit /etc/apache2/apache.conf` and place the code below after other directories.
```
<Directory /var/www/portal/>
	Options Indexes FollowSymlinks
	AllowOverride All
	Require all granted
</Directory>
```
- Change your current apache2 document root to `/var/www/portal`.
- Please make sure you enabled the apache2 `mod_rewrite`. If you have not enabled it please run `a2enmod rewrite`.
- Run `cd /var/www/portal/` and enter into your MySQL terminal by using `mysql -u root -p.`
- Run `source portal.sql` in your MySQL terminal.
- Restart your apache2 service by runing `sudo service apche2 restart`.
- Open your browser and navigate to 'localhost:80'(normally if you change the host name or port name please enter your own host name and port name which point to `/var/www/portal`)
- Log in with email:`admin@portal.com` and password `admin`
- If you want to import sample data for this web application, open your terminal, navigate to `/var/www/portal` and run `mysql -u portal -p portal < portal_sample_data.sql` with the password `portal`.

## 2. With Docker
```
Basic Environment Requirements:
- Docker
- Ubuntu 18.04 LTS or Similar
```
- Run `docker pull louleo/portal:latest`.
- Disable your local apache2 service.
-	Run `dokcer run -d -p 80:80 --name:portal --restart always louleo/portal:latest /usr/sbin/apache2ctl -D FOREGROUND`.
- Run `docker exec portal bash -c 'service msyql restart'`
- Open your browser and navigate to 'localhost:80', log in with email:`admin@portal.com` and password: `admin` or email: `member@portal.com` and password `member`.
