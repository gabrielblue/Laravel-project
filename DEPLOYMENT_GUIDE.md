# Laravel Project Deployment Guide

This guide covers multiple ways to deploy your Laravel 11 application to make it live on the internet.

## 🚀 Quick Start Options (Recommended)

### Option 1: Laravel Forge + DigitalOcean (Easiest)

**Cost**: ~$17/month ($12 Forge + $5 DigitalOcean)
**Best for**: Production applications, teams

**Steps**:
1. **Sign up for Laravel Forge**: Visit [forge.laravel.com](https://forge.laravel.com)
2. **Connect a server provider**:
   - DigitalOcean (recommended for beginners)
   - AWS, Vultr, or Linode
3. **Create a server**:
   - Choose PHP 8.2+
   - Select your preferred region
   - Choose server size (Basic $5/month is fine to start)
4. **Create a site**:
   - Add your domain name
   - Connect your Git repository (GitHub/GitLab/Bitbucket)
5. **Configure environment**:
   - Set up your `.env` variables in Forge
   - Configure database and mail settings
6. **Deploy**: Click "Deploy Now" - Forge handles everything automatically!

**What Forge does for you**:
- Server setup and security
- SSL certificates (Let's Encrypt)
- Database management
- Automated deployments
- Queue workers
- Scheduled tasks

### Option 2: Railway (Free Tier Available)

**Cost**: Free for hobby projects, $5/month for production
**Best for**: Side projects, MVPs

**Steps**:
1. **Push to GitHub**: Make sure your Laravel app is on GitHub
2. **Sign up at Railway**: Visit [railway.app](https://railway.app)
3. **Connect repository**: Link your GitHub account and select your Laravel repo
4. **Configure environment**:
   ```
   APP_NAME=YourAppName
   APP_ENV=production
   APP_KEY=base64:your-app-key
   APP_DEBUG=false
   APP_URL=https://your-app.railway.app
   
   DB_CONNECTION=mysql
   DB_HOST=your-db-host
   DB_PORT=3306
   DB_DATABASE=railway
   DB_USERNAME=root
   DB_PASSWORD=your-password
   ```
5. **Add database**: Railway provides PostgreSQL/MySQL with one click
6. **Deploy**: Railway automatically builds and deploys your app

## 🛠 Manual VPS Deployment (Advanced)

### Option 3: DigitalOcean Droplet Manual Setup

**Cost**: $6/month for basic droplet
**Best for**: Learning, full control

**Prerequisites**:
- Basic Linux command line knowledge
- SSH access to server

**Steps**:

#### 1. Create DigitalOcean Droplet
- Ubuntu 22.04 LTS
- Basic plan ($6/month)
- Add SSH key for secure access

#### 2. Server Setup
```bash
# Connect to your server
ssh root@your-server-ip

# Update system
apt update && apt upgrade -y

# Install required packages
apt install -y nginx mysql-server php8.2 php8.2-fpm php8.2-mysql php8.2-xml php8.2-curl php8.2-zip php8.2-gd php8.2-mbstring php8.2-sqlite3 composer nodejs npm git unzip

# Install Certbot for SSL
apt install -y certbot python3-certbot-nginx
```

#### 3. Configure MySQL
```bash
# Secure MySQL installation
mysql_secure_installation

# Create database
mysql -u root -p
CREATE DATABASE your_app_db;
CREATE USER 'your_app_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON your_app_db.* TO 'your_app_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### 4. Deploy Laravel Application
```bash
# Navigate to web directory
cd /var/www

# Clone your repository
git clone https://github.com/yourusername/yourproject.git
cd yourproject

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Set permissions
chown -R www-data:www-data /var/www/yourproject
chmod -R 755 /var/www/yourproject/storage
chmod -R 755 /var/www/yourproject/bootstrap/cache

# Copy environment file
cp .env.example .env
php artisan key:generate

# Configure database in .env
nano .env
```

#### 5. Configure Nginx
```bash
# Create Nginx configuration
nano /etc/nginx/sites-available/yourproject

# Add this configuration:
server {
    listen 80;
    server_name your-domain.com www.your-domain.com;
    root /var/www/yourproject/public;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    
    index index.php;
    
    charset utf-8;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}

# Enable site
ln -s /etc/nginx/sites-available/yourproject /etc/nginx/sites-enabled/
nginx -t
systemctl reload nginx
```

#### 6. Set up SSL
```bash
# Get SSL certificate
certbot --nginx -d your-domain.com -d www.your-domain.com
```

#### 7. Final Laravel Setup
```bash
cd /var/www/yourproject
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 📋 Pre-Deployment Checklist

Before deploying, ensure your Laravel app is production-ready:

### 1. Environment Configuration
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Generate strong `APP_KEY`
- [ ] Configure proper database credentials
- [ ] Set up mail configuration (if needed)

### 2. Build Assets
```bash
npm run build
```

### 3. Optimize for Production
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 4. Security Checklist
- [ ] Strong database passwords
- [ ] Disable unnecessary services
- [ ] Set up firewall rules
- [ ] Configure SSL certificates
- [ ] Set proper file permissions

## 🔧 Domain and DNS Setup

### Point Your Domain to Your Server:
1. **Get your server IP** from your hosting provider
2. **Configure DNS records**:
   - A record: `@` → `your-server-ip`
   - A record: `www` → `your-server-ip`
3. **Wait for DNS propagation** (can take up to 48 hours)

## 🚨 Troubleshooting Common Issues

### Storage Permission Errors
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### 500 Internal Server Error
- Check Laravel logs: `storage/logs/laravel.log`
- Check web server error logs
- Ensure `.env` file exists and is configured correctly
- Run `php artisan key:generate`

### Database Connection Issues
- Verify database credentials in `.env`
- Ensure database server is running
- Check firewall rules for database port

## 💡 Pro Tips

1. **Use a staging environment** to test deployments before going live
2. **Set up automated backups** for your database
3. **Monitor your application** with tools like Laravel Telescope or external services
4. **Use queue workers** for heavy tasks in production
5. **Set up proper logging** and error monitoring

## 🎯 Recommended Path for Beginners

1. **Start with Railway** for quick deployment and learning
2. **Move to Laravel Forge** when ready for production
3. **Consider manual VPS setup** only if you need full control or want to learn server management

Each option has its trade-offs between ease of use, cost, and control. Choose based on your experience level and project requirements.