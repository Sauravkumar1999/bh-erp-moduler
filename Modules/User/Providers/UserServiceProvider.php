<?php

namespace Modules\User\Providers;

use Widget;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class UserServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'User';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'user';

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
        $this->registerViewComposers();
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

        $this->loadDashboardWidgets();
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

            // Non-admin user profile, only normal users can see

            if (!user()->isAdmin()) {
                $event->menu->add([
                    'key'        => 'my-page',
                    'order'      => '1',
                    'text'       => trans('user::user.my-page'),
                    'icon'       => 'tf-icons ti ti-user',
                    'active'     => [
                        route('admin.my-info.edit', ['user' => auth()->user()]), route('admin.my-info.manage', ['user' => auth()->user()])
                    ],
                    'permission' => 'view-my-info',
                ]);

                $event->menu->addIn(
                    'my-page',
                    [
                        'key'        => 'my-info',
                        'text'       => trans('user::user.my-info'),
                        'icon'       => 'tf-icons ti ti-user',
                        'url'        => route('admin.my-info.edit', ['user' => auth()->user()]),
                        'active'     => ['admin/users/my-info'],
                    ],
                    [
                        'key'        => 'my-page-manage',
                        'text'       => trans('user::user.my-homepage-manage'),
                        'icon'       => 'tf-icons ti ti-user',
                        'url'        => route('admin.my-info.manage', ['user' => auth()->user()]),
                        'active'     => ['admin/users/my-info-manage'],
                    ],
                );
            }

            $event->menu->add([
                'key'        => 'member-management',
                'order'      => '2',
                'text'       => trans('user::user.users'),
                'icon'       => 'tf-icons ti ti-users',
                'url'        => 'admin/users',
                'active'     => ['admin/users', 'admin/referrals'],
                'permission' => 'view-user|view-referrals',
            ]);

            $event->menu->addIn(
                'member-management',
                [
                    'key'        => 'users',
                    'text'       => trans('user::user.users'),
                    'icon'       => 'tf-icons ti ti-users',
                    'url'        => 'admin/users',
                    'active'     => ['admin/users'],
                    'permission' => 'view-user'
                ],
                [
                    'key'        => 'referrals',
                    'text'       => trans('user::referral.referrals'),
                    'icon'       => 'tf-icons ti ti-user-lock',
                    'url'        => 'admin/referrals',
                    'active'     => ['admin/referrals*'],
                    'permission' => 'view-referrals'
                ],
            );
        });
    }

    private function loadDashboardWidgets()
    {
        Widget::group('top-bar')->position(1)->addWidget('Modules\User\Widgets\TestWidget');
    }

    private function registerViewComposers()
    {
        // Sales Frontend view data
        View::composer(['sales.view', 'my-portfolio'], function (\Illuminate\View\View $view) {
            $code = request()->route('id') ?? request()->route('code');
            $user = User::where('code', $code)->first();
            $userProducts = isset($user->company) ? merge_user_settings($user, $user->company->productRights) : collect();
            $userSettings = isset($user->userSetting) ? $user->userSetting : null;
            $view->with(compact('user', 'userProducts', 'userSettings'));
        });
    }
}
