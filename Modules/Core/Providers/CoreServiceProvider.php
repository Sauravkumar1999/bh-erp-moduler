<?php

namespace Modules\Core\Providers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Livewire\Livewire;
use Modules\Core\Console\SeedFreshSettings;
use Modules\Core\Contracts\ModuleUtilityContract;
use Modules\Core\Http\Middleware\SetLocale;
use Modules\Core\Utilities\ModuleUtility;
use Modules\Core\View\Components\Common\Loader;
use Modules\Core\View\Components\Widgets\AdminLteCard;
use Modules\Core\View\Components\Widgets\ContentHeader;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Core';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'core';

    /**
     * Array with the available form components.
     *
     * @var array
     */
    protected $formComponents = [
        //

    ];

    /**
     * Array with the available tool components.
     *
     * @var array
     */
    protected $toolComponents = [
        // 'modal' => Tool\Modal::class,
    ];

    /**
     * Array with the available widget components.
     *
     * @var array
     */
    protected $widgetComponents = [
        'content-header' => ContentHeader::class,
        'card'           => AdminLteCard::class,
        'loader'           => Loader::class,

    ];

    /**
     * Boot the application events.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->loadComponents();
        $this->loadLivewireModals();
        $this->commands([
            SeedFreshSettings::class
        ]);
        $this->buildSidebarMenu();

        //Register Locale Middleware
        $router->pushMiddlewareToGroup('web', SetLocale::class);

        //Override Redirect Response
        $this->registerRedirectMacros();

        $this->registerStringMacros();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        // register utilities
        $this->app->singleton(ModuleUtilityContract::class, ModuleUtility::class);
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

    private function loadComponents()
    {
        // Support of x-components is only available for Laravel >= 7.x
        // versions. So, we check if we can load components.

        $canLoadComponents = method_exists(
            'Illuminate\Support\ServiceProvider',
            'loadViewComponentsAs'
        );

        if (!$canLoadComponents) {
            return;
        }

        // Load all the blade-x components.

        $components = array_merge(
            $this->formComponents,
            $this->toolComponents,
            $this->widgetComponents
        );

        $this->loadViewComponentsAs($this->moduleNameLower, $components);
    }

    private function loadLivewireModals()
    {
        $components = $this->app->make(ModuleUtilityContract::class)->loadLivewireModals();

        foreach ($components as $component) {
            Livewire::component($component::getName(), $component);
        }
    }

    private function buildSidebarMenu()
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            
            $event->menu->add([
                'key'        => 'setting',
                'order'      => '10',
                'text'       => trans('core::core.setting'),
                'icon'       => 'ti ti-settings',
                'url'        => 'settings',
                'active'     => ['admin/settings', 'admin/clear-cache', 'admin/activitylog', 'admin/permissions', 'admin/monthly-news', 'admin/slider', 'admin/push-notification', 'admin/page-meta-tags', 'admin/product-company'],
                'permission' => 'view-system-variable|clear-cache|view-permission|view-translation-language|view-productcompany|view-activitylog|view-monthly-news|view-push-notification|view-page-meta'
            ]);
            if (user()->isAbleTo('view-system-variable')) {
                $event->menu->addIn(
                    'setting',
                    [
                        'key'        => 'system-variables',
                        'text'       => trans('core::core.system-variables'),
                        'icon'       => 'tf-icons ti ti-cogs',
                        'url'        => 'admin/settings',
                        'active'     => ['admin/settings'],
                        'permission' => 'view-system-variable'
                    ]
                );
            }
            if (user()->isAbleTo('clear-cache')) {
                $event->menu->addIn(
                    'setting',
                    [
                        'key'        => 'clear-cache',
                        'text'       => trans('core::core.clear-cache'),
                        'icon'       => 'tf-icons ti ti-cogs',
                        'url'        => 'admin/clear-cache',
                        //'active'     => ['admin/settings*'],
                        'permission' => 'clear-cache'
                    ]
                );
            }
            if (user()->isAbleTo('view-activitylog')) {
                $event->menu->addIn(
                    'setting',
                    [
                        'key'        => 'activity-log',
                        'text'       => trans('core::core.activity-log'),
                        'icon'       => 'tf-icons ti ti-cogs',
                        'url'        => 'admin/activitylog',
                        // 'active'     => ['admin/settings*'],
                        'permission' => 'view-activitylog'
                    ]
                );
            }
            if (user()->isAbleTo('view-permission')) {
                $event->menu->addIn(
                    'setting',
                    [
                        'key'        => 'permissions',
                        'text'       => trans('user::permission.permissions'),
                        'icon'       => 'tf-icons ti ti-shield-alt',
                        'url'        => 'admin/permissions',
                        'active'     => ['admin/permissions*'],
                        'permission' => 'view-permission'
                    ],
                );
            }
            if (user()->isAbleTo('view-monthly-news')) {
                $event->menu->addIn(
                    'setting',
                    [
                        'key'        => 'monthly-news',
                        'text'       => '월간뉴스',
                        'icon'       => 'tf-icons ti ti-shield-alt',
                        'url'        => 'admin/monthly-news',
                        // 'active'     => ['admin/settings*'],
                        'permission' => 'view-monthly-news'
                    ],
                );
            }
            if (user()->isAbleTo('view-slider-management')) {
                $event->menu->addIn(
                    'setting',
                    [
                        'key'        => 'slider-management',
                        'text'       => trans('slider::slider.slider-management'),
                        'icon'       => 'tf-icons ti ti-shield-alt',
                        'url'        => 'admin/slider',
                        'active'     => ['admin/slider*'],
                        'permission' => 'view-slider-management'
                    ],
                );
            }
            if (user()->isAbleTo('view-push-notification')) {
                $event->menu->addIn(
                    'setting',
                    [
                        'key'        => 'push-notification',
                        'text'       => trans('pushnotification::pushnotification.push-notification'),
                        'icon'       => 'tf-icons ti ti-shield-alt',
                        'url'        => 'admin/push-notification',
                        'active'     => ['admin/push-notification*'],
                        'permission' => 'view-push-notification'
                    ],
                );
            }
            if (user()->isAbleTo('view-page-meta')) {
                $event->menu->addIn(
                    'setting',
                    [
                        'key'        => 'page-meta',
                        'text'       => trans('core::page-meta.page-meta-tags'),
                        'icon'       => 'tf-icons ti ti-shield-alt',
                        'url'        => 'admin/page-meta-tags',
                        'active'     => ['admin/page-meta-tags*'],
                        'permission' => 'view-page-meta'
                    ],
                );
            }
        });
    }

    private function registerRedirectMacros()
    {
        $this->registerHelper();

        RedirectResponse::macro(
            'withSuccess',
            function ($message) {
                return $this->with(
                    'success',
                    $message = $this->determineMessage($message)
                );
            }
        );

        RedirectResponse::macro(
            'withError',
            function ($message) {
                return $this->with(
                    'danger',
                    $message = $this->determineMessage($message)
                );
            }
        );

        RedirectResponse::macro(
            'withInfo',
            function ($message) {
                return $this->with(
                    'info',
                    $message = $this->determineMessage($message)
                );
            }
        );

        RedirectResponse::macro(
            'withWarning',
            function ($message) {
                return $this->with(
                    'warning',
                    $message = $this->determineMessage($message)
                );
            }
        );
    }

    private function registerHelper()
    {
        RedirectResponse::macro(
            'determineMessage',
            function ($message = null) {
                return $message instanceof \Exception
                    ? $message->getMessage()
                    : ($message ?? null);
            }
        );
    }

    private function registerStringMacros()
    {
        Str::macro('snakeToTitle', function ($value) {
            return Str::of($value)->title()->replace('_', ' ');
        });
    }
}
