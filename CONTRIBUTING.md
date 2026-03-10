# 🤝 Contributing to Blueprint Mobile Bridge

First off, thank you for considering contributing to the **Blueprint Mobile Bridge**! It’s people like you who make this tool better for the entire Pterodactyl community.

To maintain a clean and functional codebase, please follow these guidelines.

---

## 🛠 Getting Started

1.  **Fork the repository** on GitHub.
2.  **Clone your fork** locally:
    ```bash
    git clone [https://github.com/YOUR_USERNAME/mobilebridge.git](https://github.com/YOUR_USERNAME/mobilebridge.git)
    ```
3.  **Create a new branch** for your feature or bugfix:
    ```bash
    git checkout -b feature/my-new-feature
    ```

---

## 🏗 Development Workflow

### Building the Extension
Since this is a Blueprint extension, you need to package it to test the final result. We use a PowerShell script for this:
```powershell
.\scripts\package.ps1
