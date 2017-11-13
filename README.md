# Lightning Fast Tests

## Requirements

* PHP ^7.1.3
* [composer](https://getcomposer.org/download/)
* git
* (Optional) IDE

During the workshop we'll be mostly writing tests and then making them pass, so there's no need for a dedicated web server.
Git will be useful to save your progress.
A [good IDE](https://www.jetbrains.com/phpstorm/download/) will help you make less typos and focus on the workshop.

It's perfectly fine to use your locally installed version of PHP as long as it's `>=7.1.3`.
However, there's also a docker image provided in case you run into any issues while setting up PHP directly on your computer.

## Setup

Before coming to the workshop, please clone the repository and install dependencies with composer.

```
git clone https://github.com/jakzal/symfonycon-workshop-2017.git
cd symfonycon-workshop-2017
```

Project dependencies are defined from the very beginning so we don't waste time and bandwidth during the workshop.
In case of any questions or problems with the setup, don't hesitate to contact me (my e-mail can be found in `composer.json`).

### Local PHP

If you chose to use your local PHP installation, simply run `composer install`:

```
composer install
```

You're good to go as soon as composer finishes with no issues.

### Docker

If you chose to use the provided docker image, familiarize yourself with the `bin/symfonycon.sh` script.
It aims to automate the most common commands on Linux and MacOS.

First, build the image:

```
./bin/symfonycon.sh build
./bin/symfonycon.sh php -v
```

The second command should display a PHP version.

Next, run `composer install`:

```
./bin/symfonycon.sh composer install
```

You're good to go as soon as composer finishes with no issues.

## Exercises

* [Exercise 1](exercises/1.md)
* [Exercise 2](exercises/2.md)
* [Exercise 3](exercises/3.md)
