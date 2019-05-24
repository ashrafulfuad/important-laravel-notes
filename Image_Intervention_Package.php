http://image.intervention.io/getting_started/installation     // এই লিংক এ যাও
$ php composer require intervention/image                     // এটি command করো 
Intervention\Image\ImageServiceProvider::class                // confit/app.php এর ভিতর $providers এরে এর একেবারে নিচে লিখুন
'Image' => Intervention\Image\Facades\Image::class            // $aliases এরে এর একেবারে নিচে লিখুন
$ php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravel5"       // Laravel 5 এর জন্য এটি command করুন
$ php artisan config:publish intervention/image               // Laravel 4 এর জন্য এটি লিখুন
