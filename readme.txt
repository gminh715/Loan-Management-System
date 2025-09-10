# 💼 Loan Management System with Credit Default Prediction

A comprehensive loan management system built with PHP, MySQL, and integrated machine learning for real-time credit default risk assessment.

---

## 🚀 Features

### 🔐 Core Loan Management
- Borrower Management: Add, edit, and manage borrower profiles
- Loan Processing: Handle different loan types with flexible payment plans
- Payment Tracking: Monitor payments with automated interest/balance calculations
- User Management: Role-based access control (Admin / Staff)
- Loan Types & Plans: Configurable loan products, interest rates, and terms

### 🤖 Machine Learning Integration
- Credit Default Prediction: Assess default risk using an integrated ML model
- Real-time Risk Assessment: Automatic predictions during loan application
- Data-Driven Decisions: Analyze historical payment behavior for informed lending

### 💻 User Interface
- Responsive Design: Bootstrap-based modern UI
- Interactive Tables: DataTables integration for sorting, filtering, and search
- Icons: Font Awesome & Boxicons
- Dashboard: Summary of loan portfolio and KPIs

---

## 🧰 Technology Stack

### 🖥️ Backend
- PHP (7.4+)
- MySQL (5.7+)
- Apache / Nginx

### 🌐 Frontend
- HTML5 / CSS3
- Bootstrap
- jQuery
- DataTables
- Font Awesome, Boxicons

### 🧠 Machine Learning
- Python 3.7+
- Flask (API Server)
- scikit-learn, pandas, numpy
- joblib (model serialization)
- flask-cors (CORS support)

---

## ⚙️ Installation

### 📦 Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx
- Python 3.7+
- Composer (optional)

### 🧠 Machine Learning Setup
```bash
cd test/
pip install flask flask-cors pandas scikit-learn joblib numpy
python app.py
```
ML API available at: http://localhost:5000

---

## 🛠️ Usage

### 🔐 Admin Access
- Login with admin credentials  ( username: admin | password: admin123 )
- Manage users, system settings, loan types, and payment plans

### 👨‍💼 Staff Operations
- Add and manage borrowers
- Create and manage loans
- Record and track payments

### 🤖 ML Features
- Risk prediction during loan creation
- Default probability returned instantly
- API-driven decision support
