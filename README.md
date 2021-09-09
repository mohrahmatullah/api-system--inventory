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
		

### Make seed
		
		php artisan db:seed
		

### Or export database on directory
		
		sql/inventory.sql
		

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
		http://localhost:1008/api/apiCategoryList

	authorization
	type: Bearer Token

## Penjelasan
Didalam API ini terdapat fitur-fitur berikut ini :

- Login
- 2 Role Admin dan Staff

- Dashboard
- Modul Category
1. Rest API CRUD

- Modul Product
1. Rest API CRUD
2. Qty product kosong karena harus ada transaksi product in

- Modul Customer
1. Rest API CRUD

- Modul User
1. Rest API CRUD

- Modul Supplier
1. Rest API CRUD

- Modul Product Out
1. Rest API CRUD
2. List product hanya qty product lebih dari nol
3. Akses approve hanya ada di admin
4. Ketika sudah di approve oleh admin Qty product akan berkurang

- Modul Product In
1. Rest API CRUD
2. Akses approve hanya ada di admin
3. Ketika sudah di approve oleh

- Modul Report Stock
1. Per hari
2. Per minggu
3. Per bulan
4. Per tahun

- Modul Report Product In
1. Per hari
2. Per minggu
3. Per bulan
4. Per tahun

- Modul Report Product Out
1. Per hari
2. Per minggu
3. Per bulan
4. Per tahun