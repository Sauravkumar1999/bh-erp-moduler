<?php

namespace Modules\Company\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class CompanyServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Company';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'company';

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
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
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

    private function buildSidebarMenu() {

        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add([
                'key'    => 'organisation',
                'order'  => '2',
                'text'   => trans('company::company.manage-organization'),
                'icon'   => 'ti ti-sitemap',
                'url'    => 'manage-organisation',
                'active' => ['admin/organisation*'],
                'permission' => 'view-company|view-user-role'
            ]);

            $event->menu->addIn('organisation',
                [
                    'key'        => 'company',
                    'text'       => trans('company::company.companies'),
                    'icon'       => 'tf-icons ti ti-companies',
                    'url'        => 'admin/company',
                    'active'     => ['admin/company*'],
                    'permission' => 'view-company'
                ],
                [
                    'key'        => 'roles',
                    'text'       => trans('user::role.roles'),
                    'icon'       => 'tf-icons ti ti-user-lock',
                    'url'        => 'admin/roles',
                    'active'     => ['admin/roles*'],
                    'permission' => 'view-user-role'
                ]
            );

        });

    }
}
