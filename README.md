<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
    <h1 align="center">Agro-Stock 🌱</h1>
    <p align="center">Modern Agro Stock Management System</p>
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel" alt="Laravel">
    <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php" alt="PHP">
    <img src="https://img.shields.io/badge/Livewire-3.x-FB70A9?style=flat" alt="Livewire">
    <img src="https://img.shields.io/badge/Tailwind-3.x-06B6D4?style=flat&logo=tailwind-css" alt="Tailwind">
    <img src="https://img.shields.io/badge/MySQL-8.x-4479A1?style=flat&logo=mysql" alt="MySQL">
</p>

## 🌟 Features
- 🚀 **Modern Stack**: Laravel 12 + Livewire 3 + Tailwind CSS
- 👨‍💻 **Authentication**: Laravel Breeze
- 📊 **Real-time Dashboard**: Livewire-powered analytics
- 📦 **CRUD Operations**: Full-featured stock management
- 📱 **Responsive UI**: Tailwind-designed components
- 📈 **Reporting**: Exportable Excel reports

## 🛠️ Tech Stack
| Component       | Technology                          |
|-----------------|-------------------------------------|
| **Framework**   | Laravel 12                          |
| **Frontend**    | Livewire 3                          |
| **Styling**     | Tailwind CSS 3                      |
| **Auth**        | Laravel Breeze                      |
| **Database**    | MySQL 8                             |
| **Deployment**  | Laravel Forge / Vapor (recommended) |

## 📞 Contact
<div align="center"> <a href="mailto:veriabror01@gmail.com"> <img src="https://img.shields.io/badge/Email-veriabror01%40gmail.com-blue?style=flat&logo=gmail" alt="Email"> </a> <a href="https://instagram.com/veri_abr"> <img src="https://img.shields.io/badge/Instagram-%40veri__abr-E4405F?style=flat&logo=instagram" alt="Instagram"> </a> <a href="https://github.com/VeriAbror"> <img src="https://img.shields.io/badge/GitHub-VerIAbror-181717?style=flat&logo=github" alt="GitHub"> </a> </div>

## 🚀 Installation
```bash
# Clone the repository
git clone https://github.com/VeriAbror/Agro-Stock.git
cd Agro-Stock

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agro_stock
DB_USERNAME=root
DB_PASSWORD=

# Run migrations and seeders
php artisan migrate --seed

# Compile assets
npm run build

# Start development server
php artisan serve
