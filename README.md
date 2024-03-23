<h2>Setup</h2>
Instalar Wamp server, Git y Composer
</br><b>Wamp:</b> https://sourceforge.net/projects/wampserver/ (PHP 8.3) </br>
<b>Composer:</b> https://getcomposer.org/download/ (PHP 8.3)</br>
<b>Git: </b> https://git-scm.com/downloads
<hr>
Ejecutar Wamp y ir a la carpeta www, usar la consola de comandos para clonar el repositorio
<code>git clone https://github.com/Arturo1007/electiva-5-api.git</code>
<hr>
Inicializar el proyecto, ejectuar estos comandos en la consola dentro de la carpeta clonada:<br>
<code>composer install</code><br>
Cambiar el nombre archivo <code>.env.example</code> a <code>.env</code><br>
<code>php artisan key:generate</code><br>
<code>php artisan migrate</code><br>

Link Pagina: http://localhost/electiva-5-api/public/
