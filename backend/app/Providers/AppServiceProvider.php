<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Helper;
use App\Models\Category as Category;
use App\Models\Provider as Provider;
use App\Models\Product as Product;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::creating(function ($category) {
            $category->slug = Helper::slugify($category->name);
            return true;
        }); 

        Category::updating(function ($category) {
            $category->slug = Helper::slugify($category->name);
            return true;
        });

        Provider::creating(function ($provider) {
            $provider->slug = Helper::slugify($provider->name);
            return true;
        }); 

        Provider::updating(function ($provider) {
            $provider->slug = Helper::slugify($provider->name);
            return true;
        });

        Product::creating(function ($product) {
            $product->slug = Helper::slugify($product->name);
            return true;
        }); 

        Product::updating(function ($product) {
            $product->slug = Helper::slugify($product->name);
            return true;
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
