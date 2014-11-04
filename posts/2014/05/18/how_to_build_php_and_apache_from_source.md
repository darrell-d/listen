MAY 18 2014
#HOW TO BUILD PHP AND APACHE FROM SOURCE

All the cool new features for PHP are in the latest releases. You can't get to those easily from package managers. It takes package managers a while to update to the latest versions. If you want to get the latest version faster you'll need to build your own copy to get the latest and greatest and to help the open source community debug.

Here are some notes on how to get this done. (The instructions below assume basic linux terminal competency)

##Installing Apache from source

###Pre-requisites:
Make : `apt-get install make`

APR: `apt-get install libapr1-dev libaprutil1-dev`. Apr is needed for the error `checking for APR... no configure: error: APR not found.  Please read the documentation.`

###Installation

1. Download the source files: `wget http://www.bizdirusa.com/mirrors/apache//httpd/httpd-2.4.9.tar.gz`
2. Extract source files : `tar -zxvf httpd-2.4.9.tar.gz`
3. Configure the install: `./configure --prefix=/usr/local/apache --enable-so --enable-cgi --enable-info --enable-rewrite --enable-spelling --enable-usertrack --enable-deflate --enable-ssl --enable-mime-magic`
4. Make `make`
5. Make install `make install`
6. Start Apache. Navigate to `/usr/local/apache/bin` and run `./apachectl start`

You should now have a functioning Apache server

######Key commands from configuration script
`--prefix=/usr/local/apache`: This is where apache will be installed

`--enable-so`: This tells Apache to build `so` modules modules.

####Tip
You can alias the apachectl command so you can start it from anywhere.

1. Navigate to your home directory : `cd ~`
. Edit the `.bash_aliases` file: `vi .bash_aliases`
3. Make the alias `alias apache="/usr/local/apache/bin/apachectl"`
4. Depending on your environment you may need to alias the sudo command as well so it works with your newly created alias for Apache. Add this line before step 3: `alias su5. do="sudo "`
5. Logout of your terminal and log back in, you can now access apache via `apache <start> <restart> <stop> <status>`


##Installing PHP from source

###Pre-requisites:
libxml : `apt-get install libxml2-dev`

###Installation
1. Download the source files: `wget http://downloads.php.net/tyrael/php-5.6.0beta3.tar.gz`
2. Extract source files : `tar -zxvf php-5.6.0beta3.tar.gz`
3. Configure the install: `./configure --with-pear=/usr/share/php --with-bz2 --with-curl --with-gd --enable-calendar --enable-mbstring --enable-bcmath --enable-sockets --with-regex=php --with-zlib --with-regex=php --with-zlib --with-mysql --with-mysqli --with-apxs2=/usr/local/apache/bin/apxs`
4. Make `make`
5. Make install `make install`

######Key commands
`--with-apxs2=/usr/local/apache/bin/apxs`: This enables PHP to create libphp5.so. This mod is required so that Apache can rung PHP files.

###Congfiguration with Apache

Next PHP needs to be configured with Apache.

1. Navigate to `/usr/local/apache/conf` (or wherever your local Apache install is)
2. Open httpd.conf with your preferred editor. For example `vi httpd.conf` or `gedit httpd.conf`
3. Set the `Directory Index` to `index.php index.html` This makes `index.php` the default file loaded, then if `index.php` is missing `index.html` is loaded
4. Add `AddType application/x-httpd-php .php`
5. Ensure the libphp5.so module is loaded: `LoadModule php5_module        modules/libphp5.so`
6. Set the Handler for PHP files:

    `<FilesMatch \.php$>`
        `SetHandler application/x-httpd-php`

                `</FilesMatch>`

7. Restart Apache
