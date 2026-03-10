# 📱 Blueprint Mobile Bridge

**Blueprint Mobile Bridge** is a specialized extension for the [Blueprint framework](https://blueprint.zip) designed to bridge the gap between your Pterodactyl panel and mobile applications (such as `abyssal`).

It exposes dedicated API endpoints that allow mobile apps to detect installed extensions and inspect `conf.yml` metadata without the need for frontend scraping.

---

## ✨ Features

* **Dedicated API Endpoints:** Native JSON responses for mobile integration.
* **Blueprint Integration:** Adds an Admin settings page directly under Blueprint extensions.
* **Security First:** Internal filesystem paths are hidden by default and restricted to debugging.
* **Granular Control:** Toggle Client API visibility directly from the admin interface.

---

## 🛠 Installation Guide

Follow these steps to install the **Blueprint Mobile Bridge** on your Pterodactyl panel.

### 📋 Prerequisites

* A Pterodactyl panel with [Blueprint](https://blueprint.zip) already installed.
* Shell access (SSH) to your web server.

### 📥 Step 1: Download the Extension

You need the `.blueprint` file to proceed. You can download the latest version directly from the repository:

👉 **[Download blueprintmobile.blueprint](https://github.com/Abyssal-Security/mobilebridge/raw/main/build/blueprintmobile.blueprint)**

### 🚀 Step 2: Installation Process

1.  **Upload the file:**
    Place the `blueprintmobile.blueprint` file in the **root directory** of your Pterodactyl installation (usually `/var/www/pterodactyl`).

2.  **Run the Blueprint command:**
    In your terminal, navigate to your panel folder and run:
    ```bash
    blueprint -add blueprintmobile
    ```

3.  **Wait for completion:**
    Blueprint will automatically handle the file placement and asset building.

### ⚙️ Step 3: Configuration

Once installed, you should configure the extension to ensure it works with your mobile app:

1.  Log in to your Pterodactyl **Admin Area**.
2.  Navigate to **Extensions** -> **Blueprint**.
3.  Find **Mobile Bridge** in the list.
4.  **Configure API Access:**
    * Enable the **Client API** if you want standard users to be able to see extension metadata.
    * Keep **Internal Paths** disabled unless you are troubleshooting (for security).

### 🔍 Troubleshooting

* **Command not found:** Ensure Blueprint is correctly installed and the `blueprint` alias is working.
* **Permissions:** If the command fails, ensure your webserver user (e.g., `www-data`) has the correct permissions or run the command with `sudo`.
* **API 404:** If the endpoints return a 404 error after installation, try clearing your route cache:
    ```bash
    php artisan route:clear
    ```

---

## 📡 API Reference

The extension introduces the following endpoints to your panel's API:

### Client API
*Accessible via `/api/client/extensions/blueprintmobile`*

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `GET` | `/` | List all visible Blueprint extensions. |
| `GET` | `/extensions/{identifier}` | Get metadata for a specific extension. |

### Application API
*Accessible via `/api/application/extensions/blueprintmobile`*

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `GET` | `/` | Comprehensive list of installed extensions. |
| `GET` | `/extensions/{identifier}` | Detailed metadata retrieval. |

---

## 💻 Development

If you wish to modify the extension or build it from source:

### Local Build
Run the provided PowerShell script to generate the build packages:
```powershell
.\scripts\package.ps1
