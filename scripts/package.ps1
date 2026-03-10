param(
    [string]$OutputDirectory = "build"
)

$ErrorActionPreference = "Stop"

$projectRoot = Split-Path -Parent $PSScriptRoot
$stagingRoot = Join-Path $projectRoot ".package"
$bundleRoot = Join-Path $stagingRoot "blueprintmobile"
$outputRoot = Join-Path $projectRoot $OutputDirectory
$zipPath = Join-Path $outputRoot "blueprintmobile.zip"
$blueprintPath = Join-Path $outputRoot "blueprintmobile.blueprint"

if (Test-Path $stagingRoot) {
    Remove-Item $stagingRoot -Recurse -Force
}

if (Test-Path $outputRoot) {
    Remove-Item $outputRoot -Recurse -Force
}

New-Item -ItemType Directory -Path $bundleRoot -Force | Out-Null
New-Item -ItemType Directory -Path $outputRoot -Force | Out-Null

$include = @(
    "conf.yml",
    "admin",
    "app",
    "private",
    "routes"
)

foreach ($entry in $include) {
    $source = Join-Path $projectRoot $entry
    $target = Join-Path $bundleRoot $entry
    Copy-Item $source $target -Recurse -Force
}

Compress-Archive -Path (Join-Path $bundleRoot "*") -DestinationPath $zipPath -CompressionLevel Optimal
Copy-Item $zipPath $blueprintPath -Force

Write-Host "Created:"
Write-Host " - $zipPath"
Write-Host " - $blueprintPath"
