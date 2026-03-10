<?php

namespace Pterodactyl\BlueprintFramework\Extensions\blueprintmobile;

use Illuminate\Support\Arr;
use Pterodactyl\BlueprintFramework\Libraries\ExtensionLibrary\Client\BlueprintClientLibrary;

class BlueprintMobileService
{
    public function __construct(
        private BlueprintClientLibrary $blueprint,
    ) {
    }

    public function getSettings(): array
    {
        return [
            'expose_client_api' => (bool) $this->blueprint->dbGet('blueprintmobile', 'settings:expose_client_api', true),
            'include_extension_config' => (bool) $this->blueprint->dbGet('blueprintmobile', 'settings:include_extension_config', true),
            'include_extension_paths' => (bool) $this->blueprint->dbGet('blueprintmobile', 'settings:include_extension_paths', false),
            'show_system_meta' => (bool) $this->blueprint->dbGet('blueprintmobile', 'settings:show_system_meta', true),
        ];
    }

    public function listExtensions(): array
    {
        $extensions = [];
        foreach ($this->blueprint->extensions() as $identifier) {
            $identifier = trim((string) $identifier);
            if ($identifier === '') {
                continue;
            }

            $details = $this->getExtension($identifier);
            if ($details !== null) {
                $extensions[] = $details;
            }
        }

        usort($extensions, fn (array $left, array $right) => strcmp($left['identifier'], $right['identifier']));

        return $extensions;
    }

    public function getExtension(string $identifier): ?array
    {
        $settings = $this->getSettings();
        $config = $this->blueprint->extensionConfig($identifier);

        if ($config === null) {
            return null;
        }

        $info = Arr::get($config, 'info', []);
        $payload = [
            'identifier' => (string) ($info['identifier'] ?? $identifier),
            'name' => (string) ($info['name'] ?? $identifier),
            'description' => (string) ($info['description'] ?? ''),
            'version' => (string) ($info['version'] ?? ''),
            'target' => (string) ($info['target'] ?? ''),
            'author' => (string) ($info['author'] ?? ''),
            'website' => (string) ($info['website'] ?? ''),
            'has_admin' => filled(Arr::get($config, 'admin.view')),
            'has_client_api' => filled(Arr::get($config, 'requests.routers.client')),
            'has_application_api' => filled(Arr::get($config, 'requests.routers.application')),
            'has_web_routes' => filled(Arr::get($config, 'requests.routers.web')),
        ];

        if ($settings['include_extension_config']) {
            $payload['config'] = [
                'info' => Arr::get($config, 'info', []),
                'admin' => Arr::get($config, 'admin', []),
                'dashboard' => Arr::get($config, 'dashboard', []),
                'data' => Arr::get($config, 'data', []),
                'requests' => Arr::get($config, 'requests', []),
                'database' => Arr::get($config, 'database', []),
            ];
        }

        if ($settings['include_extension_paths']) {
            $payload['paths'] = [
                'root' => base_path(".blueprint/extensions/{$identifier}"),
                'private' => base_path(".blueprint/extensions/{$identifier}/private"),
                'public' => base_path(".blueprint/extensions/{$identifier}/public"),
                'app' => base_path(".blueprint/extensions/{$identifier}/app"),
                'routers' => base_path(".blueprint/extensions/{$identifier}/routers"),
            ];
        }

        $payload['mobile_api'] = [
            'client' => "/api/client/extensions/blueprintmobile/extensions/{$identifier}",
            'application' => "/api/application/extensions/blueprintmobile/extensions/{$identifier}",
        ];

        return $payload;
    }

    public function buildMeta(string $scope): array
    {
        $settings = $this->getSettings();
        $meta = [
            'extension' => 'blueprintmobile',
            'scope' => $scope,
            'generated_at' => now()->toIso8601String(),
            'count' => count($this->listExtensions()),
        ];

        if ($settings['show_system_meta']) {
            $meta['routes'] = [
                'client_index' => '/api/client/extensions/blueprintmobile',
                'application_index' => '/api/application/extensions/blueprintmobile',
            ];
            $meta['blueprint'] = [
                'storage_root' => base_path('.blueprint/extensions'),
                'installed_extensions_file' => base_path('.blueprint/extensions/blueprint/private/db/installed_extensions'),
            ];
        }

        return $meta;
    }
}
