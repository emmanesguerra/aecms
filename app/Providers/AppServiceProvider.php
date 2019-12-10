<?php

namespace App\Providers;

use Core\Model\User;
use Core\Model\SystemConfig;
use Core\Model\Module;
use Core\Model\Page;
use Core\Model\Panel;
use Core\Model\ContactUs;
use Core\Observers\UserObserver;
use Core\Observers\SystemConfigObserver;
use Core\Observers\ModuleObserver;
use Core\Observers\PageObserver;
use Core\Observers\ContactUsObserver;
use Core\Observers\PanelObserver;

use App\Model\Slider;
use App\Observers\SliderObserver;
use App\Model\ProductCategory;
use App\Observers\ProductCategoryObserver;
use App\Model\Product;
use App\Observers\ProductObserver;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        User::observe(UserObserver::class);
        SystemConfig::observe(SystemConfigObserver::class);
        Module::observe(ModuleObserver::class);
        Page::observe(PageObserver::class);
        Panel::observe(PanelObserver::class);
        ContactUs::observe(ContactUsObserver::class);
        
        Slider::observe(SliderObserver::class);
        Product::observe(ProductObserver::class);
        ProductCategory::observe(ProductCategoryObserver::class);
    }
}
