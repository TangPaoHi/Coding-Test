# Full-Stack Task Manager (Laravel + Vue 3)

This is a coding test project consisting of a **Laravel 11** backend and a **Vue 3** frontend.

## 🚀 Tech Stack
- **Backend:** Laravel 11 (PHP 8.2+)
- **Frontend:** Vue 3 (Vite, Axios)
- **Database:** SQLite

## 🛠️ Key Features
- **Full CRUD**: Add and delete tasks seamlessly.
- **Form Validation**: Prevents empty task submissions on both frontend and backend.
- **Graceful Error Handling**: UI alerts the user if the backend service is offline.
- **HQ Demo Video**: A high-quality demo video is included in the root directory.

## 📦 How to Run

Follow these steps to get the project running locally:

```bash
# 1. Backend Setup
cd backend
composer install
cp .env.example .env
php artisan migrate
php artisan serve

# 2. Frontend Setup (In a new terminal)
cd ../frontend
npm install
npm run dev
```

The app will be running at http://localhost:5173