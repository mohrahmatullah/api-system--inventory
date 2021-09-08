## DOKUMENTASI INSTALL

## Membangun API System Inventory Barang Menggunakan : 
	- Framework Laravel 7.29
	- PHP php:7.3-apache
	- MYSQL 5.7.34

## Project inventory Barang
Please make sure it is connected to the internet

### Project install

	git clone https://github.com/mohrahmatullah/api-system--inventory

### Database connection
Create database
		
		Example name database : inventory

enter your information to .env 

		
		DB_DATABASE=inventory
		DB_USERNAME=root
		DB_PASSWORD=123
		

### Cache clear
		
		php artisan config:cache
		
### If Use Docker
		
		docker exec -it container_id bash

### Make migrate
		
		php artisan migrate
		
### APP_KEY

		php artisan key:generate

### Make seed
		
		php artisan db:seed
		

### Or export database on directory
		
		sql/apps-inventory.sql
		

### If use linux

		php artisan route:clear
		php artisan config:clear
		php artisan cache:clear
		chmod -R 777 storage
		chmod -R 777 bootstrap/cache

### Run project
		
		php artisan serve
		  
### Request Login info for admin

		email    : admin@email.com
		password : 123456

		Header
			key : Content-Type
			value : application/json
		
		
		
### Request Login info for user
		
		email    : user@email.com
		password : 123456
		
		Header
			key : Content-Type
			value : application/json

### Request all modul example
	Category list :
		http://localhost:1008/api-inven/public/api/apiCategoryList

	authorization
	type: Bearer Token
## Penjelasan
Didalam aplikasi ini terdapat fitur-fitur berikut ini :

- Login
- 2 Role Admin dan Staff

- Dashboard
- Modul Category
1. CRUD menggunakan AJAX JQUERY dengan menggunakan modal bootstrap
2. Export Ke PDF 
3. Export Ke Excel

- Modul Product
1. CRUD menggunakan AJAX JQUERY dengan menggunakan modal bootstrap
2. Qty product kosong karena harus ada transaksi product in

- Modul Customer
1. CRUD menggunakan AJAX JQUERY dengan menggunakan modal bootstrap
2. Export PDF 
3. Export Ke Excel
4. Import Ke Data Dari Excel Ke Sistem

- Modul User
1. CRUD menggunakan AJAX JQUERY dengan menggunakan modal bootstrap
2. Modul user hanya ada di akses admin saja

- Modul Supplier
1. CRUD menggunakan AJAX JQUERY dengan menggunakan modal bootstrap
2. Export PDF 
3. Export Ke Excel
4. Import Dari Excel Ke Sistem

- Modul Product Out
1. CRUD menggunakan AJAX JQUERY dengan menggunakan modal bootstrap
2. Export PDF 
3. Export Excel
4. Export Invoice Product Out
		
		Export invoice hanya status yang sudah di approve oleh admin

5. List product hanya qty product lebih dari nol
6. Akses approve hanya ada di admin
7. Ketika sudah di approve oleh admin Qty product akan berkurang

- Modul Product In
1. CRUD menggunakan AJAX JQUERY dengan menggunakan modal bootstrap
2. Export PDF 
3. Export Excel
4. Export Invoice Product In 

		Export invoice hanya status yang sudah di approve oleh admin
		
5. Akses approve hanya ada di admin
6. Ketika sudah di approve oleh