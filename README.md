# Drivethru

adalah aplikasi untuk memudahkan pihak mengambil produk Pengadilan Agama dengan cara Drive Thru. Sehingga pihak tidak perlu mengantri di layanan PTSP.

## Instalasi

1. Pindahkan folder ke server.
2. Buat database dengan nama `drivethru`.
3. Silahkan import file sql yang ada di folder ini.
4. Buka file `application/config/database.php`.
5. Sesuaikan username, password, dan databasenya.
```
$db['default'] = array(
	...
	'username' => '',
	'password' => '',
	'database' => 'drivethru',
	...
);

```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)