#  Cloud Document Manager (Laravel)

A cloud-based system to **upload, verify, and filter** PDF/DOCX documents — built with Laravel + MySQL and hosted on Render.

---

##  Technologies Used

- **Backend:** PHP, Laravel 10
- **Frontend:** Laravel Blade (HTML/CSS/JS)
- **Cloud:** Render (Web Service + PostgreSQL/MySQL)
- **Storage:** Render ephemeral storage (temporary)

---

## Deployment to Render

### 1.  Prerequisites

- Render account (sign up at https://render.com/)
- MySQL database (local or cloud)
- PHP 8.2+ & Composer installed

---

### 2.  Deploy to Render

```bash
# Clone repository
git clone https://github.com/ansamalhaty/cloud-analytics-

# Install dependencies
composer install

# Configure .env (MySQL + Render settings)
cp .env.example .env
nano .env  # Edit DB and storage configs

# Migrate database
php artisan migrate

 # Features
 Upload .pdf or .docx documents

Verify duplicates via SHA-256 hash

Filter documents by type (PDF/DOCX)

# API Endpoints
Method  	Endpoint	       Description
POST	    /upload	Upload     document (max 5MB)
GET	        /filter/{type}	   Filter by type (pdf/docx)


# Challenges and Solutions :

Firebase Limitations: Switched to Render after authentication and latency issues.

Composer Conflicts: Resolved through manual package adjustments.

Recommendations for Future Work :

Integrate AWS S3 for persistent file storage.

Optimize Render’s PostgreSQL performance for larger datasets.
 
 ** Thanks for writing **  

