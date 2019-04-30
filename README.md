# laravel-libros-backend
Backend de prueba de concepto de comunicación de Laravel con Vue, manejando información de libros y autores

>NOTA: En caso de ejecutarse desde Vagrant es mejor
ejecutar todo desde una box fresca.
Digase ejecutar un ***$ vagrant destroy*** para destruir la vieja
instancia y despues un ***$ vagrant up*** para que se regenere la box
con el proyecto.

Para instalar el backend, es necesario:

* Hacer checkout del branch correcto a desplegar
  >$ git checkout master
* Configurar correctamente el archivo ".env", solo se incluye uno de 
ejemplo llamado ***.env.example***, ya que este contiene las 
configuraciones locales de la maquina donde se va a hospedar el backend,
como es el SGBD, el nombre de la base de datos, usuario y contraseña
de esta, etc.
  >$ cp .env.example .env
* Instalar las dependencias
  >$ composer install
* Ejecutar las migraciones de la base de datos
  >$ php artisan migrate:fresh
* Instalar y generar las llaves de Passport
  >$ php artisan passport:install
