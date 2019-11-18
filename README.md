Webpack Encore: SymfonyCon!
===========================

Hi there!

## Setup

To get it working, follow these steps:

**Download Composer dependencies**

Make sure you have [Composer installed](https://getcomposer.org/download/)
and then run:

```
composer install
```

**Setup .env.local**

If the `DATABASE_DSN` in `.env` doesn't work for you, create a new `.env.local`
file and override it there.

**Setup the Database**

Again, make sure `.env.local` is setup for your computer if needed. Then, create
the database and the schema!

```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

If you get an error that the database exists, that should
be ok. But if you have problems, completely drop the
database (`doctrine:database:drop --force`) and try again.

**Start the Symfony web server**

You can use Nginx or Apache, but Symfony's local web server
works even better.

To install the Symfony local web server, follow
"Downloading the Symfony client" instructions found
here: https://symfony.com/download - you only need to do this
once on your system.

Then, to start the web server, open a terminal, move into the
project, and run:

```
symfony serve
```

(If this is your first time using this command, you may see an
error that you need to run `symfony server:ca:install` first).

Now check out the site at `http://localhost:8000`

**For convenience**

If you are using PhpStorm you may install and enable
the [Symfony Plugin](https://plugins.jetbrains.com/idea/plugin/7219-symfony-plugin)
via the preferences which provides more auto-completion for Symfony projects.  

Have fun!
