<?php

namespace Pterodactyl\BlueprintFramework\Extensions\blueprintmobile;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlueprintMobileClientController
{
    public function __construct(
        private BlueprintMobileService $service,
    ) {
    }

    public function index(): JsonResponse
    {
        $settings = $this->service->getSettings();
        if (!$settings['expose_client_api']) {
            throw new AccessDeniedHttpException('Blueprint Mobile client API is disabled.');
        }

        return response()->json([
            'object' => 'list',
            'meta' => $this->service->buildMeta('client'),
            'data' => $this->service->listExtensions(),
        ]);
    }

    public function show(string $identifier): JsonResponse
    {
        $settings = $this->service->getSettings();
        if (!$settings['expose_client_api']) {
            throw new AccessDeniedHttpException('Blueprint Mobile client API is disabled.');
        }

        $extension = $this->service->getExtension($identifier);
        if ($extension === null) {
            throw new NotFoundHttpException('Blueprint extension not found.');
        }

        return response()->json([
            'object' => 'extension',
            'meta' => $this->service->buildMeta('client'),
            'attributes' => $extension,
        ]);
    }
}
