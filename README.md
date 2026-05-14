# OSSD Bheri - Educational Portal (Laravel 12 + MySQL)

A complete educational management system built with Laravel 12 and MySQL for managing schools, students, staff, announcements, documents, results, and feedback.

## Features

### 🎓 Core Features
- **Multi-Role Authentication**: Admin, Staff, Student, Guest roles
- **Announcements Management**: Create, publish, and manage announcements
- **Document Repository**: Upload and download educational materials
- **Results Portal**: View exam results and academic performance
- **Online Applications**: Submit and track applications
- **Events Calendar**: Manage academic events and important dates
- **Feedback System**: Submit and track feedback/support tickets
- **Admin Dashboard**: Comprehensive statistics and management tools

### 🔒 Security Features
- Role-based access control (RBAC)
- Sanctum API authentication
- CSRF protection
- Password hashing
- Activity logging

### 📊 Database
- MySQL database with proper indexing
- 9 migration files
- Database seeders with demo data
- Eloquent ORM relationships

### 🎨 Frontend
- Responsive Bootstrap 5 + Tailwind CSS
- Blade templating engine
- Mobile-friendly design

## Project Structure

```
ossd-bheri-clone/
├── app/
│   ├── Models/              # Eloquent models (9 files)
│   ├── Http/
│   │   └── Controllers/     # Controllers (5+ files)
│   └── Providers/
├── database/
│   ├── migrations/          # Database migrations (9 files)
│   └── seeders/             # Database seeders
├── resources/
│   ├── css/                 # Tailwind CSS
│   ├── js/                  # JavaScript files
│   └── views/               # Blade templates
├── routes/
│   ├── web.php             # Web routes
│   └── api.php             # API routes
├── config/                  # Configuration files
├── .env.example            # Environment template
├── composer.json           # PHP dependencies
└── package.json            # Node.js dependencies
```

## Database Schema

### Tables
1. **roles** - User roles (Admin, Staff, Student, Guest)
2. **users** - User accounts with role relationship
3. **announcements** - News and announcements
4. **documents** - File repository
5. **results** - Student exam results
6. **applications** - Online application submissions
7. **events** - Academic events and calendar
8. **feedbacks** - Support tickets and feedback
9. **audit_logs** - Activity logging

## Installation

### Prerequisites
- PHP 8.2 or higher
- MySQL 5.7 or higher
- Composer
- Node.js & npm
- Git

### Steps

1. **Clone the repository**
```bash
git clone https://github.com/mnepali12/ossd-bheri-clone.git
cd ossd-bheri-clone
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install Node dependencies**
```bash
npm install
```

4. **Setup environment file**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure database**
Edit `.env` file:
```
DB_DATABASE=ossd_bheri
DB_USERNAME=root
DB_PASSWORD=your_password
```

6. **Create database**
```bash
mysql -u root -p
CREATE DATABASE ossd_bheri;
exit;
```

7. **Run migrations**
```bash
php artisan migrate
```

8. **Seed demo data**
```bash
php artisan db:seed
```

9. **Build frontend assets**
```bash
npm run build
```

10. **Start development server**
```bash
php artisan serve
```

Access the application at: `http://localhost:8000`

## Default Login Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@ossd.com | password123 |
| Staff | staff@ossd.com | password123 |
| Student | student@ossd.com | password123 |

## API Endpoints

### Authentication
- `POST /api/login` - User login
- `POST /api/logout` - User logout
- `GET /api/user` - Get authenticated user

### Announcements
- `GET /api/announcements` - List announcements
- `POST /api/announcements` - Create announcement (Admin/Staff only)
- `GET /api/announcements/{id}` - Get announcement details
- `PUT /api/announcements/{id}` - Update announcement
- `DELETE /api/announcements/{id}` - Delete announcement

### Documents
- `GET /api/documents` - List documents
- `POST /api/documents` - Upload document
- `GET /api/documents/{id}` - Get document
- `DELETE /api/documents/{id}` - Delete document
- `GET /api/documents/{id}/download` - Download document

### Results
- `GET /api/results` - List results
- `POST /api/results` - Create result (Staff only)
- `GET /api/results/{id}` - Get result details

### Feedbacks
- `GET /api/feedbacks` - List feedbacks
- `POST /api/feedbacks` - Submit feedback
- `GET /api/feedbacks/{id}` - Get feedback details
- `POST /api/feedbacks/{id}/reply` - Reply to feedback (Admin/Staff only)

## Available Commands

```bash
# Run development server
php artisan serve

# Build frontend
npm run build

# Watch for changes
npm run dev

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Clear cache
php artisan cache:clear

# Generate API documentation
php artisan tinker
```

## Configuration

### Environment Variables
- `APP_NAME` - Application name
- `APP_ENV` - Environment (local, production)
- `APP_DEBUG` - Debug mode
- `DB_*` - Database credentials
- `MAIL_*` - Email configuration

## Security Considerations

1. Change default passwords after installation
2. Set `APP_DEBUG=false` in production
3. Use strong database passwords
4. Enable HTTPS in production
5. Keep Laravel and dependencies updated
6. Use environment variables for sensitive data
7. Implement rate limiting for APIs

## File Upload

Documents are stored in `storage/app/public/documents`. Configure your storage:

```bash
php artisan storage:link
```

## Troubleshooting

### "SQLSTATE[HY000]: General error: 1030 Got error..."
- Increase MySQL max_allowed_packet
- Check database connection

### "Class not found" error
- Run `composer dump-autoload`
- Clear cache: `php artisan cache:clear`

### "Migration table not found"
- Run `php artisan migrate:install`
- Then run `php artisan migrate`

### Assets not loading
- Run `npm run build`
- Check asset paths in `vite.config.js`

## Deployment

### On Shared Hosting
1. Upload files to public_html
2. Configure database
3. Set file permissions (chmod 755)
4. Run migrations

### On Server (Ubuntu/CentOS)
```bash
# Install dependencies
sudo apt-get install php php-mysql php-mbstring php-xml

# Clone and setup
git clone https://github.com/mnepali12/ossd-bheri-clone.git
cd ossd-bheri-clone
composer install --no-dev
npm install
npm run build

# Configure
cp .env.example .env
php artisan key:generate
php artisan migrate --force

# Setup web server (Nginx)
# Configure Nginx to serve Laravel public folder
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

## License

MIT License - see LICENSE file for details

## Support

For issues, questions, or suggestions, please open an issue on GitHub.

## Authors

- **Hanok Nepali** - Initial development

## Changelog

### Version 1.0.0 (2026-05-14)
- Initial release
- 9 Eloquent models
- 9 database migrations
- 5+ controllers with CRUD operations
- Complete authentication system
- Admin dashboard
- Responsive frontend
- API endpoints
- Database seeders

---

**Last Updated**: May 14, 2026

**Repository**: https://github.com/mnepali12/ossd-bheri-clone
