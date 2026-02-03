# Iseki Astra - Asset & Tracking Management System

## Overview

**Iseki Astra** is a specialized web application built for managing tracking reports, checklists, and documentation records. It provides a platform for Admin users to manage areas, angles, and users, while allowing standard users to submit tracking reports and perform daily checklists.

The application incorporates advanced features like server-side data tables for efficient reporting and an interactive image pan/zoom gallery for detailed visual inspection.

## Key Features

### 1. Admin Module
*   **Dashboard**: Centralized hub for system monitoring.
*   **Master Data Management**:
    *   **Area Management**: CRUD operations for operational areas.
    *   **Photo Angle Management**: Define standards for photo documentation.
    *   **User Management**: create and manage system users.
*   **Report & Checklist**:
    *   **Advanced Reporting**: View and filter all reports using server-side DataTables.
    *   **Checklist Management**: Oversee daily submission checklists.
    *   **Exports**: Export report and checklist data for offline analysis.
*   **Records**: Access and download system records.

### 2. User Module
*   **Tracking**:
    *   Submit tracking data with validation rules.
    *   Real-time photo documentation.
*   **Checklist Submission**: Complete daily or periodic operational checklists.
*   **History**: View personal report history and details.
*   **Profile**: Manage personal account settings.

### 3. Advanced Visualization (PanZoom)
*   **Interactive Gallery**: Inspect report photos with high detail.
*   **Gestures**: Support for pinch-to-zoom (mobile) and scroll/drag (desktop).
*   **Smooth Controls**:
    *   Zoom level from 50% to 500%.
    *   Double-click to reset.
    *   Canvas-based rendering for performance.

## Technology Stack

### Backend
*   **Framework**: [Laravel 12.x](https://laravel.com)
*   **Language**: PHP ^8.2
*   **Database**: SQLite (Default) / Oracle Support (`yajra/laravel-datatables-oracle`)
*   **Utilities**: `simple-qrcode`

### Frontend
*   **Build Tool**: [Vite](https://vitejs.dev)
*   **Styling**: [Tailwind CSS v4.0](https://tailwindcss.com)
*   **Data Tables**: Yajra DataTables (Server-side processing)
*   **Image Viewer**: `@panzoom/panzoom` v4.5.1

## Installation & Setup

1.  **Clone the Repository**
    ```bash
    git clone <repository-url>
    cd iseki_astra
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Configuration**
    *   Copy the example environment file:
        ```bash
        cp .env.example .env
        ```
    *   Configure your database credentials in `.env`.

4.  **Key Generation & Migration**
    ```bash
    php artisan key:generate
    php artisan migrate
    ```

5.  **Build Frontend Assets**
    ```bash
    npm run build
    ```

6.  **Run Development Server**
    ```bash
    php artisan serve
    ```

## Feature Implementation Details

*   **DataTables**: configured with server-side processing for high performance on large datasets. See [DATATABLE_IMPLEMENTATION.md](DATATABLE_IMPLEMENTATION.md) for details.
*   **Image Zoom**: implemented using PanZoom for detailed inspection of evidence photos. See [PANZOOM_IMPLEMENTATION.md](PANZOOM_IMPLEMENTATION.md) for details.

## License

This project is proprietary.
