<?php namespace Ado\Formx;

use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\Support\ServiceProvider;

class FormxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'formx');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'formx');
        
        //assets
        $this->publishes([__DIR__.'/../public/assets' => public_path('packages/ado/formx/assets')], 'assets');
        
        //config
        $this->publishes([__DIR__.'/../config/formx.php' => config_path('formx.php')], 'config');
        $this->mergeConfigFrom( __DIR__.'/../config/formx.php', 'formx');

        
        
        $this->publishes([
            __DIR__.'/routes.php' => app_path('/Http/formx.php'),
        ], 'routes');


        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }
        
        if (file_exists($file = app_path('/Http/formx.php')))
        {
            include $file;
        } else {
            include __DIR__ . '/routes.php';
        }
       
        include __DIR__ . '/macro.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Collective\Html\HtmlServiceProvider');
        $this->app->register('Ado\Formx\Route\BurpServiceProvider');
        
        Formx::setContainer($this->app);
   
        $this->app->booting(function () {
            $loader  =  \Illuminate\Foundation\AliasLoader::getInstance();

            $loader->alias('Input', 'Illuminate\Support\Facades\Input');
            
            $loader->alias('Formx'     , 'Ado\Formx\Facades\Formx'     );
            
            //deprecated .. and more facade are really needed ?
            $loader->alias('DataSet'   , 'Ado\Formx\Facades\DataSet'   );
            $loader->alias('DataGrid'  , 'Ado\Formx\Facades\DataGrid'  );
            $loader->alias('DataForm'  , 'Ado\Formx\Facades\DataForm'  );
            $loader->alias('DataEdit'  , 'Ado\Formx\Facades\DataEdit'  );
            $loader->alias('DataFilter', 'Ado\Formx\Facades\DataFilter');
            $loader->alias('DataEmbed' , 'Ado\Formx\Facades\DataEmbed');
            $loader->alias('DataTree' , 'Ado\Formx\Facades\DataTree');
            $loader->alias('Documenter', 'Ado\Formx\Facades\Documenter');


        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
    
}
