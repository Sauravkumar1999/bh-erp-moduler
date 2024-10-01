<?php

namespace Modules\Allowance\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AllowanceServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Allowance';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'allowance';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->buildSidebarMenu();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'),
            $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
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

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }


    private function buildSidebarMenu()
    {

        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add([
                'key'        => 'allowance-management',
                'order'      => '7',
                'text'       => trans('allowance::allowance.allowance-management'),
                'icon'       => 'ti ti-file-dollar',
                'url'        => 'admin/allowances',
                'permission' => 'view-allowance|view-allowance-payment|view-allowance-statement',
                'active'     => ['admin/allowances*']
            ]);

            $event->menu->addIn(
                'allowance-management',
                [
                    'key'        => 'allowance',
                    'text'       => trans('allowance::allowance.allowance-management'),
                    'url'        => 'admin/allowances',
                    'active'     => ['admin/allowances*'],
                    'permission' => 'view-allowance',
                ],
            );
            $event->menu->addIn(
                'allowance-management',
                [
                    'key'        => 'allowance-payments',
                    'text'       => trans('allowance::allowance.allowance-payments'),
                    'url'        => route('admin.allowance-payments.index'),
                    'active'     => ['admin/allowance-payments*'],
                    'permission' => 'view-allowance-payment',
                ],
            );
            $event->menu->addIn(
                'allowance-management',
                [
                    'key'        => 'allowance-statement',
                    'text'       => trans('allowance::allowance.allowance-statement'),
                    'url'        => route('admin.allowance-statement.index'),
                    'active'     => ['admin/allowance-statement'],
                    'permission' => 'view-allowance-statement',
                ],
            );
        });
    }
}
