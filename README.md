# endpoint-simulator

    <VirtualHost *:80>
        ServerName endpoint-simulator.dev
        CustomLog "/Users/user/Sites/logs/project.dev-access_log" combined
        ErrorLog "/Users/user/Sites/logs/project.dev-error_log"
        DocumentRoot /Users/user/Sites/endpoint-simulator/web
    
        RewriteEngine On
        RewriteCond %{HTTP:Authorization} ^(.*)
        RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
    
        <Directory /Users/user/Sites/endpoint-simulator/web/>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride None
            Order allow,deny
            allow from all
            <IfModule mod_rewrite.c>
                RewriteEngine On
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteRule ^(.*)$ /index.php [QSA,L]
            </IfModule>
        </Directory>
    </VirtualHost>