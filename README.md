# 🎓 UMC School Management System

A full-featured, AI-powered School Management System built with **Laravel 12**, **Filament v5**, and **Google Gemini AI**. Designed for the University Management Center (UMC) to streamline academic operations — from student enrollment to fee tracking — with an intelligent AI assistant built right in.

---

## ✨ Features at a Glance

### 🏫 Core Academic Management
- **Students** — Full CRUD with student profiles, academic year tracking, AI-generated summaries & recommendations
- **Teachers** — Teacher profiles linked to user accounts with role-based access
- **Departments** — Organize faculty and students by academic department
- **Courses** — Manage courses with department and teacher assignments
- **Enrollments** — Track which students are in which courses, with export support
- **Grades** — Record and view student grades per course with average calculations
- **Attendance** — Per-enrollment attendance tracking with statuses: Present, Absent, Late, Excused
- **Schedules** — Weekly class scheduling per course
- **Fee Payments** — Track student fee payments with status (Completed, Pending, Failed) and payment methods

### 🤖 AI-Powered Features
- **AI School Assistant** — A conversational chatbot powered by Google Gemini Flash that can answer natural-language questions about students, grades, attendance, and departments using real-time database tools
- **Executive Health Report** — Automatically generates a professional AI-driven school health report (cached for 12 hours) covering academics, operations, financials, and strategic recommendations — visible only to Super Admins
- **Student AI Summaries** — AI-generated student profile summaries and recommendations stored directly on the student record

### 📊 Dashboard & Analytics
- **Stats Overview** — Role-aware dashboard stats: Total Students, Teachers, Courses, Enrollments, Average Score, and Total Revenue
- **Grade Distribution Chart** — Visual breakdown of grade ranges across the school
- **Grade Trend Chart** — Time-series chart showing grade performance trends
- **Attendance Charts** — Daily and overall attendance visualization
- **Department Performance Chart** — Compare academic performance across departments
- **Top Students Widget** — Live leaderboard of the top 5 students by average grade
- **Weekly Schedule Widget** — At-a-glance view of the week's class schedule

### 🔐 Role-Based Access Control
| Role | Access Level |
|------|-------------|
| `super_admin` | Full access to everything including financials, user management, impersonation, and AI reports |
| `teacher` | Scoped access — sees only their own students, courses, and attendance |

- **User Impersonation** — Super admins can impersonate any non-admin user for support purposes
- **Shield Integration** — Filament Shield handles granular permission management through a dedicated UI

### 📥 Data Management
- **Bulk Attendance** — Mark attendance for an entire class at once with a guided 2-step form
- **Enrollment Export** — Export enrollment data to CSV/Excel via Filament's built-in export system
- **Communication Logs** — Log and view communications per student

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | PHP 8.2 + Laravel 12 |
| **Admin Panel** | Filament v5 |
| **Frontend** | Livewire v4 + Vite + TailwindCSS v4 |
| **AI / LLM** | Google Gemini Flash (via `google-gemini-php/laravel`) |
| **AI Tools** | OpenAI PHP Client + Anthropic Laravel |
| **Permissions** | Spatie Laravel Permission + Filament Shield |
| **Impersonation** | lab404/laravel-impersonate |
| **CMS** | Statamic (for content/user management layer) |
| **Database** | SQLite (default) — easily switchable to MySQL/PostgreSQL |
| **Testing** | Pest v3 + PHPUnit v11 |

---

## 📁 Project Structure

```
app/
├── Filament/
│   ├── Exports/          # Data exporters (Enrollments)
│   ├── Pages/            # Custom pages (AI Assistant, Bulk Attendance)
│   ├── Resources/        # CRUD resources (Students, Teachers, Courses, etc.)
│   └── Widgets/          # Dashboard widgets & charts
├── Mcp/
│   └── Tools/            # AI tool handlers (Search Student, Get Grades, etc.)
├── Models/               # Eloquent models (Student, Teacher, Course, ...)
├── Policies/             # Authorization policies
└── Providers/            # Service providers
database/
├── migrations/           # 25 migration files covering all entities
├── factories/            # Model factories for testing
└── seeders/              # Database seeders
```

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/muridabuhamed/UMC-project.git
cd UMC-project

# 2. Install PHP dependencies
composer install

# 3. Set up environment
cp .env.example .env
php artisan key:generate

# 4. Set up the database
touch database/database.sqlite
php artisan migrate

# 5. Install frontend dependencies and build assets
npm install
npm run build

# 6. Create your first admin user
php artisan make:filament-user
```

Or use the one-command setup:

```bash
composer run setup
```

### Running Locally

```bash
composer run dev
```

This starts the Laravel server, queue listener, and Vite dev server concurrently. Visit `http://localhost:8000`.

---

## 🔑 Environment Configuration

Copy `.env.example` to `.env` and configure the following key variables:

```env
# App
APP_NAME="UMC School"
APP_URL=http://localhost:8000

# Database (SQLite by default)
DB_CONNECTION=sqlite

# Google Gemini AI (required for AI features)
GEMINI_API_KEY=your_gemini_api_key_here

# Optional: OpenAI
OPENAI_API_KEY=your_openai_key_here

# Optional: Anthropic
ANTHROPIC_API_KEY=your_anthropic_key_here
```

> **Note:** The AI Assistant and Executive Health Report require a valid `GEMINI_API_KEY`.

---

## 🧠 AI Assistant

The AI School Assistant is accessible from the **AI Tools** section in the sidebar. It uses **Google Gemini Flash** with function-calling to answer questions using live school data.

### Available AI Tools

| Tool | Description |
|------|-------------|
| `search_student_by_name` | Find a student's ID, student number, and department by name |
| `get_student_grades` | Retrieve all grades and average score for a student |
| `get_student_attendance` | Get full attendance records and summary for a student |
| `get_department_summary` | Get department head, student count, and teacher count |

### Example Questions to Ask
- *"What is Ahmed's average grade?"*
- *"Show me the attendance record for student ID 5"*
- *"How many students are in the Computer Science department?"*
- *"Find a student named Sara and get her grades"*

---

## 📊 Dashboard Widgets

The dashboard adapts based on the logged-in user's role:

- **Super Admin** sees all stats including revenue and the AI Executive Health Report
- **Teacher** sees only data scoped to their own courses and students

---

## 🗄️ Data Model Overview

```
Department
    └── Course (has teacher_id)
         └── Enrollment (student ↔ course)
              ├── Grade
              ├── Attendance
              └── Schedule

Student
    ├── Enrollment
    ├── FeePayment
    └── CommunicationLog

User
    └── Teacher (linked via HasOne)
```

---

## 🧪 Testing

```bash
# Run all tests
php artisan test --compact

# Run a specific test
php artisan test --compact --filter=TestName
```

Tests use **Pest v3** with Laravel plugin support.

---

## 📦 Key Packages

| Package | Purpose |
|---------|---------|
| `filament/filament` v5 | Admin panel framework |
| `bezhansalleh/filament-shield` | Role & permission management UI |
| `google-gemini-php/laravel` | Gemini AI integration |
| `lab404/laravel-impersonate` | Admin user impersonation |
| `statamic/cms` | Content management layer |
| `pestphp/pest` | Testing framework |

---

## 🚢 Deployment

This project is ready to deploy on [Laravel Cloud](https://cloud.laravel.com/). After deploying, ensure you:

1. Set all required environment variables (especially `GEMINI_API_KEY`)
2. Run `php artisan migrate --force`
3. Run `php artisan filament:upgrade`
4. Run `npm run build` or enable asset compilation in your deployment pipeline

---

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/amazing-feature`
3. Commit your changes: `git commit -m 'Add amazing feature'`
4. Push to the branch: `git push origin feature/amazing-feature`
5. Open a Pull Request

---

## 📄 License

This project is open-source under the [MIT License](LICENSE).

---

<p align="center">
  <strong>UMC School Management System</strong><br/>
  Built with ❤️ for <strong>UMC — University Management Center</strong><br/><br/>
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"/>
  <img src="https://img.shields.io/badge/Filament-v5-FDAE4B?style=for-the-badge&logo=filament&logoColor=white"/>
  <img src="https://img.shields.io/badge/Gemini_AI-Powered-4285F4?style=for-the-badge&logo=google&logoColor=white"/>
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
</p>
