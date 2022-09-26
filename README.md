# generate-scmframe
A package for generating scm-folder structure
Installation >>
Step1. composer require generate/scmframe
Step2. Add 'Generate\Scmframe\SCMFrameServiceProvider::class' in providers of app.php
Step3. php artisan config:cacheCancel changes

Usage >>

One name

e.g php artisan create:scm Bank 

Multi name 

e.g. php artisan create:scm Bank Invoice Quotation


