php artisan make:middleware CheckRole                     // command it in your gitbash

'checkrole' => \App\Http\Middleware\CheckRole::class,     // To register this middleware go to kernel.php add this line in 
                                                          // protected $route Middleware = [.. here ...]

public function handle($request, Closure $next)           
    {

        if (Auth::user()->role == 2) {                    // Go to CheckRole.php add this if condition inside the 6 to 14 lines code
          return redirect('customer/dashboard');
        }

        return $next($request);
    }



                যদি login  করার পর এই লিংক এ যায় যে ('/home') তাহলে HomeController এ যাও এবং এড করো 
                      $this -> middleware('checkrole');
                __construct() নামক function এর ভিতর।                                   
