# git-hooks-installer-plugin

[![Latest Stable Version](https://poser.pugx.org/bernardosilva/git-hooks-installer-plugin/v/stable)](https://packagist.org/packages/bernardosilva/git-hooks-installer-plugin)
[![Total Downloads](https://poser.pugx.org/bernardosilva/git-hooks-installer-plugin/downloads)](https://packagist.org/packages/bernardosilva/git-hooks-installer-plugin)
[![Monthly Downloads](https://poser.pugx.org/bernardosilva/git-hooks-installer-plugin/d/monthly)](https://packagist.org/packages/bernardosilva/git-hooks-installer-plugin)
[![License](https://img.shields.io/packagist/l/bernardosilva/git-hooks-installer-plugin.svg)](https://packagist.org/packages/bernardosilva/git-hooks-installer-plugin)
[![Build Status](https://travis-ci.org/BernardoSilva/git-hooks-installer-plugin.svg)](https://travis-ci.org/BernardoSilva/git-hooks-installer-plugin)
[![Code Coverage](https://scrutinizer-ci.com/g/BernardoSilva/git-hooks-installer-plugin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/BernardoSilva/git-hooks-installer-plugin/?branch=master)

This project goal is to share and enforce code standards to all your projects.

## Why create this?

Currently there are millions of php projects that do not follow or adapt any code standards.

I think the main reasons for that are:

* Lack of time to implement a script to check them;
* Not sure how those will help;
* Not sure how to enforce them for all team members;
* Not aware of what that is;

Using git-hook packages will enable everyone to share their hooks and
reduce de number of projects not following any standards.

## git-hook package

A `git-hook` package is a composer package that uses the type `git-hook`.

Any package that set `git-hook-installer-plugin` as dependency and `type` to `git-hook`
will be installed on your project using this plugin.


## Git-hook packages available

Create you own git-hook package to be listed here and share it with everyone.

* [bernardosilva/git-hooks-php](https://packagist.org/packages/bernardosilva/git-hooks-php)
* [partnermarketing/pm-git-hooks-php](https://packagist.org/packages/partnermarketing/pm-git-hooks-php)


## How to create my git-hook packages?

You can start by looking [into this example](https://github.com/BernardoSilva/git-hooks-php)

Things required to create a new git-hook package?

- [x] `composer.json` file.
- [x] The git hook files you want to use. [view list of available hooks](#available-hooks)

Example of new composer.json file

```json
{
    "name": "yourname/your-package-name",
    "type": "git-hook",
    "description": "Composer git-hook package with hooks for your php projects.",
    "require": {
        "bernardosilva/git-hooks-installer-plugin": "^1.0.0"
    }
}
```


Note: Your `composer.json` must have a specific `type` to be installed in correct directory:

```
"type": "git-hook"
```

Also your git hooks should have execution permission.

#### Available hooks

You can create any of those files on your package with execute permissions.

* [applypatch-msg](https://git-scm.com/docs/githooks#_applypatch_msg)
* [pre-applypatch](https://git-scm.com/docs/githooks#_pre_applypatch)
* [pre-commit](https://git-scm.com/docs/githooks#_pre_commit)
* [prepare-commit-msg](https://git-scm.com/docs/githooks#_prepare_commit_msg)
* [commit-msg](https://git-scm.com/docs/githooks#_commit_msg)
* [pre-rebase](https://git-scm.com/docs/githooks#_pre_rebase)
* [pre-push](https://git-scm.com/docs/githooks#_pre_push)
* [update](https://git-scm.com/docs/githooks#update)
* [post-update](https://git-scm.com/docs/githooks#post-update)


[See a list of all git hooks available](https://git-scm.com/docs/githooks)


## How to Install

```sh
php composer.phar require bernardosilva/git-hooks-installer-plugin
```

## How to test

```sh
./vendor/bin/phpunit
```

## How to contribute

* Create your own git hook composer package.

* Create a PR to list your package on this page.

* Raise new issues or add suggestions to improve this plugin.


## Created By

[Bernardo Silva](https://www.bernardosilva.com)

## License

MIT © [Bernardo Silva](https://www.bernardosilva.com) 
