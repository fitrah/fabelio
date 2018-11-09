# fabelio
Price Monitoring fo Fabelio.com

# installing
- clone/download all script
- put into your web server document root
- restore/export database from fabelio.sql
- edit database configuration on application/config/database.php
  change this line with your credentials
  'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'fabelio',
- done web app ready to go

# documentation
- add new 
  this page use for grab/scrape data from fabeli.com and save to our database
  please input only proudct detail url, ex : https://fabelio.com/ip/tromso-dining-table-c.html
- view data
  contain list data product that have beed scrape/added to web app
- cronjob
  create cronjob to update price history every hour
  example for linux server
  0 * * * * php /path/to/root/index.php monitoring/product_cron
