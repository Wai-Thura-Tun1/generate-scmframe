# generate-scmframe
A package for generating scm-folder structure

Installation >>
Step1. composer require generate/scmframe

Step2. Add 'Generate\Scmframe\SCMFrameServiceProvider::class' in providers of app.php

Step3. php artisan config:cacheCancel changes

Description >>
This is a package for creating scm-frame using a convience way. Just by writing one command-line, SCM-Frame is generated quickly.

Usage >>
One name

e.g php artisan create:scm Bank 

Multi name 

e.g. php artisan create:scm Bank Invoice Quotation




