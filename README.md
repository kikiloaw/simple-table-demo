# SimpleTable Documentation

This repository serves as the official documentation and example showcase for the `SimpleTable` Vue 3 component. It demonstrates various features including server-side data fetching, caching, custom slots, fixed columns, and group headers.

## 🚀 Getting Started

Follow these steps to set up the documentation site locally.

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL or SQLite

### Installation

1.  **Clone the repository**
    ```bash
    git clone <repository-url>
    cd clearance
    ```

2.  **Install Backend Dependencies**
    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies**
    ```bash
    npm install
    ```

4.  **Environment Setup**
    Copy the example environment file and configure your database credentials.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Database & Seeding**
    Run the migrations and seed the database. This creates a demo user.
    ```bash
    php artisan migrate --seed
    ```
    > **Note:** The seeder creates a default user:
    > - **Email**: `test@example.com`
    > - **Password**: `password`

6.  **Add the SimpleTable Component**
    *Important: The `SimpleTable` component source code (`/resources/js/package/SimpleTable`) is excluded from this repository. You must manually place the component package in this directory for the examples to work.*

### Usage

1.  **Start the Development Server**
    ```bash
    npm run dev
    ```

2.  **Start the Laravel Server** (in a new terminal)
    ```bash
    php artisan serve
    ```

3.  **Login**
    Visit `http://localhost:8000` (or your configured URL). Login with the credentials above.

4.  **Explore Documentation**
    After login, you will be redirected to the documentation dashboard where you can interact with live examples of `SimpleTable`.

## 📚 Features Covered

- **Basic Usage**: Static data rendering.
- **Fixed Columns**: Sticky columns for wide tables.
- **Custom Slots**: Custom rendering for cells and actions.
- **Server-Side Data**: Searching, sorting, and pagination via API.
- **Theming**: Customizing row colors and hover effects.
- **Caching**: Client-side caching for server responses to improve performance.
- **Group Headers**: 
    - **Server-Side**: Injecting header rows directly from the backend.
    - **Client-Side**: Using `before-render` to transform data in the browser.
