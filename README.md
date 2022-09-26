# generate-scmframe
A package for generating scm-folder structure

Installation >>
Step1. composer require generate/scmframe

Step2. Add 'Generate\Scmframe\SCMFrameServiceProvider::class' in providers of app.php

Step3. run php artisan config:cache to update changes

Description >>
This is a package for creating scm-frame using a convience way. Just by writing one command-line, SCM-Frame is generated quickly.

Usage >>
One name

e.g php artisan create:scm Bank 

Multi name 

e.g. php artisan create:scm Bank Invoice Quotation




