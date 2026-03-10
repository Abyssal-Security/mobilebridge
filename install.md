# 🛠 Installation Guide

Follow these steps to install the **Blueprint Mobile Bridge** on your Pterodactyl panel.

## 📋 Prerequisites

* A Pterodactyl panel with [Blueprint](https://blueprint.zip) already installed.
* Shell access (SSH) to your web server.

## 📥 Step 1: Download the Extension

You need the `.blueprint` file to proceed. You can download the latest version directly from the repository:

👉 **[Download blueprintmobile.blueprint](https://github.com/Abyssal-Security/mobilebridge/raw/main/build/blueprintmobile.blueprint)**

---

## 🚀 Step 2: Installation Process

1.  **Upload the file:**
    Place the `blueprintmobile.blueprint` file in the **root directory** of your Pterodactyl installation (usually `/var/www/pterodactyl`).

2.  **Run the Blueprint command:**
    In your terminal, navigate to your panel folder and run:
    ```bash
    blueprint -add blueprintmobile
    ```

3.  **Wait for completion:**
    Blueprint will automatically handle the file placement and asset building.

---

## ⚙️ Step 3: Configuration

Once installed, you should configure the extension to ensure it works with your mobile app:

1.  Log in to your Pterodactyl **Admin Area**.
2.  Navigate to **Extensions** -> **Blueprint**.
3.  Find **Mobile Bridge** in the list.
4.  **Configure API Access:**
    * Enable the **Client API** if you want standard users to be able to see extension metadata.
    * Keep **Internal Paths** disabled unless you are troubleshooting (for security).

---

## 🔍 Troubleshooting

* **Command not found:** Ensure Blueprint is correctly installed and the `blueprint` alias is working.
* **Permissions:** If the command fails, ensure your webserver user (e.g., `www-data`) has the correct permissions or run the command with `sudo`.
* **API 404:** If the endpoints return a 404 error after installation, try clearing your route cache:
    ```bash
    php artisan route:clear
    ```

---

[⬅ Back to README](README.md)
