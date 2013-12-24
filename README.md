laravel-firstapp
================

Trying out the Laravel framework.

# Notes on installing and configuring

Following directions at http://laravel.com/docs/installation, installing and configuring prerequisites was relatively painless. Didn't have to bother with building php myself, as installing with apt-get seems to have worked fine (with one caveat, which I'll explain), and yielded PHP 5.5.3-1ubuntu2.1 (cli) on Ubuntu 13.10, and installing composer globally in /usr/local/bin/ worked as advertized.

The first hitch came about upon running composer create project, when it failed with an error complaining of a missing mcrypt depencency, even though everything it was asking for is installed. The fix wasn't too had to come up with, but I had to adapt this one http://askubuntu.com/questions/360646/cant-use-php-extension-mcrypt-in-ubuntu-13-10-nginx-php-fpm

For some reason mcrypt.ini gets installed to /etc/php5/conf.d/ instead of direcly into /etc/php5/mods-available/, so never get loaded. To fix:

cd <project-name>
php composer update --no-scripts
sudo ln -s /etc/php5/conf.d/mcrypt.ini /etc/php5/mods-available/mcrypt.ini  # to put it where the laravel scripts will look for it
sudo ln -s /etc/php5/mods-available/mcrypt.ini /etc/php5/apache2/conf.d/20-mcrypt.ini # to give it a slot in the apache init sequence
sudo ln -s /etc/php5/mods-available/mcrypt.ini /etc/php5/cli/conf.d/20-mcrypt.ini # to do the same for the php cli
sudo php5enmod mcrypt # enable mod mcrypt
php composer update # to re-run the laravel init scripts
sudo service apache2 restart

The second hitch came about from my decision to install using composer create-project rather than using the laravel installer .phar file. The instructions on this page under "Install Laravel", unlike those in the Quickstart guide, leave out the <project-name> argument, so what I ended up with at first is a project called laravel, with a sibling vendor folder at the same level, loose in the root of my php-projects folder.


