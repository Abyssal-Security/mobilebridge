<?php

namespace Pterodactyl\BlueprintFramework\Extensions\blueprintmobile;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlueprintMobileApplicationController
{
    public function __construct(
        private BlueprintMobileService $service,
    ) {
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'object' => 'list',
            'meta' => $this->service->buildMeta('application'),
            'settings' => $this->service->getSettings(),
            'data' => $this->service->listExtensions(),
        ]);
    }

    public function show(string $identifier): JsonResponse
    {
        $extension = $this->service->getExtension($identifier);
        if ($extension === null) {
            throw new NotFoundHttpException('Blueprint extension not found.');
        }

        return response()->json([
            'object' => 'extension',
            'meta' => $this->service->buildMeta('application'),
            'settings' => $this->service->getSettings(),
            'attributes' => $extension,
        ]);
    }
}
