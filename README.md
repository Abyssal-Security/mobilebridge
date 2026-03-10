# Blueprint Mobile Bridge

Blueprint extension source for exposing Blueprint metadata through dedicated Pterodactyl API endpoints.

## What it adds

- Admin settings page under Blueprint extensions.
- Client API endpoints under `/api/client/extensions/blueprintmobile`.
- Application API endpoints under `/api/application/extensions/blueprintmobile`.
- Responses that list installed Blueprint extensions and expose their `conf.yml` metadata.

## Intended use

This is meant as a bridge for a mobile app such as `abyssal`, so the app can detect and inspect Blueprint extensions without scraping the panel frontend.

## Endpoints

### Client API

- `GET /api/client/extensions/blueprintmobile`
- `GET /api/client/extensions/blueprintmobile/extensions/{identifier}`

### Application API

- `GET /api/application/extensions/blueprintmobile`
- `GET /api/application/extensions/blueprintmobile/extensions/{identifier}`

## Build package locally

```powershell
.\scripts\package.ps1
```

This writes:

- `build/blueprintmobile.zip`
- `build/blueprintmobile.blueprint`

## Install on a Blueprint-enabled panel

1. Copy `blueprintmobile.blueprint` to the panel root.
2. Run `blueprint -add blueprintmobile`.
3. Open the Blueprint admin page and configure the bridge.

## Notes

- `target` is set to `beta-2025-11` based on the latest public Blueprint release metadata I could verify while building this scaffold.
- Current extension metadata: author `theciphermc`, version `1.0.2`.
- Client API output can be disabled from the admin page.
- Internal filesystem paths are hidden by default and only intended for debugging.
