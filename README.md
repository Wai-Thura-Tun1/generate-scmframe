# generate-scmframe
A package for generating scm-folder structure

Step1. Add 'Generate\Scmframe\SCMFrameServiceProvider::class' in providers of app.php
Step2. php artisan config:cache

Usage >>

One name

e.g php artisan create:scm Bank 

Multi name 

e.g. php artisan create:scm Bank Invoice Quotation


