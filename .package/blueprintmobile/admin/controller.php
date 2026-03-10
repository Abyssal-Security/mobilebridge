<?php

namespace Pterodactyl\Http\Controllers\Admin\Extensions\blueprintmobile;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\View\View;
use Pterodactyl\BlueprintFramework\Libraries\ExtensionLibrary\Admin\BlueprintAdminLibrary as BlueprintAdminLibrary;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class blueprintmobileExtensionController extends Controller
{
    public function __construct(
        private ViewFactory $view,
        private BlueprintAdminLibrary $blueprint,
    ) {
    }

    public function index(): View
    {
        return $this->view->make('admin.extensions.blueprintmobile.index', [
            'settings' => $this->settings(),
            'blueprint' => $this->blueprint,
        ]);
    }

    public function update(BlueprintMobileSettingsRequest $request): RedirectResponse
    {
        $this->blueprint->dbSetMany('blueprintmobile', [
            'settings:expose_client_api' => $request->boolean('expose_client_api'),
            'settings:include_extension_config' => $request->boolean('include_extension_config'),
            'settings:include_extension_paths' => $request->boolean('include_extension_paths'),
            'settings:show_system_meta' => $request->boolean('show_system_meta'),
        ]);

        $this->blueprint->alert('success', 'Blueprint Mobile Bridge settings saved successfully.');

        return redirect()->route('admin.extensions.blueprintmobile.index');
    }

    private function settings(): array
    {
        return [
            'expose_client_api' => (bool) $this->blueprint->dbGet('blueprintmobile', 'settings:expose_client_api', true),
            'include_extension_config' => (bool) $this->blueprint->dbGet('blueprintmobile', 'settings:include_extension_config', true),
            'include_extension_paths' => (bool) $this->blueprint->dbGet('blueprintmobile', 'settings:include_extension_paths', false),
            'show_system_meta' => (bool) $this->blueprint->dbGet('blueprintmobile', 'settings:show_system_meta', true),
        ];
    }
}

class BlueprintMobileSettingsRequest extends AdminFormRequest
{
    public function rules(): array
    {
        return [
            'expose_client_api' => 'nullable|boolean',
            'include_extension_config' => 'nullable|boolean',
            'include_extension_paths' => 'nullable|boolean',
            'show_system_meta' => 'nullable|boolean',
        ];
    }
}
