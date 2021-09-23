## Normal WordPress installation.

The difference is in the custom theme. You need to use _npm install_ inside the **theme directory**.

### Docker

_docker-compose up_ in **docker-develop** directory

### Environment

Change environment to _production_ on deployment in **wp-config.php**

### Tailwind

Tailwind needs cli command _TAILWIND_MODE="watch"_ to compile the css.
_npm run watch_ from the **theme directory**