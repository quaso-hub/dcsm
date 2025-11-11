<h1 align="center">🍱 Ajojing Food Order – Secure Distributed System </h1> <p align="center"> <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"/> <img src="https://img.shields.io/badge/MySQL-SSL%20Enabled-4479A1?style=for-the-badge&logo=mysql&logoColor=white"/> <img src="https://img.shields.io/badge/Proxmox-VE-ED7A12?style=for-the-badge&logo=proxmox&logoColor=white"/> <img src="https://img.shields.io/badge/Security-DeepSeek%20Adaptive%20Model-00BFFF?style=for-the-badge"/> <img src="https://img.shields.io/badge/License-Academic-blue?style=for-the-badge"/> </p>
📖 Overview

A secure, distributed Laravel-based food ordering system built for the Distributed Computing & Security UTS project.
It uses Proxmox VE for virtualization, Tailscale for secure access, and integrates a DeepSeek-inspired adaptive security model that dynamically activates only the necessary protection layers.

🧩 Architecture Overview

Client (Browser)
↓ HTTPS/TLS
Nginx (SSL Termination + Rate Limit)
↓
PHP-FPM
↓
PolicyRouter (DeepSeek-style Top-K Security Selector)
↓
Laravel App Logic
↓
Risk Feedback + Fingerprint Analysis
↓
MySQL over SSL/TLS (Certificate-based Authentication)
↓
Database Server (Isolated + Firewall)

⚙️ Key Components
Layer	Function
Proxmox VE	Virtualized infrastructure with isolated VMs
Tailscale VPN	Secure overlay for remote demo and access
Laravel 11	Main application framework
Nginx	Reverse proxy with HTTPS and HSTS
MySQL (SSL)	Database with verified TLS communication
Firewall	Restricts DB access to App VM only
HAProxy	Handles App-level failover automatically
🧠 DeepSeek-Style Adaptive Security
1️⃣ Sparse Middleware Activation (SMA)

Activates only the top-K relevant security modules per request.

Route	Active Modules
/api/public/menu	RateLimit, AuditLog
/api/user/order	AuthN, RBAC, InputGuard, RateLimit
/api/admin/*	AuthN, RBAC, InputGuard, Anomaly, AuditLog
2️⃣ Risk Scoring Feedback Loop

Logs the effectiveness of each security module and periodically adjusts their weights using reinforcement-like logic.

3️⃣ User Behavior Fingerprint

Learns normal user behavior (route, time, device).
Triggers stricter protections for anomalous activity.

4️⃣ Security Dashboard

Displays a real-time heatmap of module activations and performance metrics (403/429 errors, latency, anomalies).

🛡️ Security Highlights
Layer	Protection	Verification
Client → App	HTTPS (TLS 1.3)	Wireshark TLS handshake
App → DB	SSL (verify_identity)	mysql --ssl-mode=VERIFY_IDENTITY
App Layer	RBAC, anti-SQLi, Input validation	403/400/429 logs
Network	UFW / iptables	nmap / ufw status
VPN Layer	Encrypted overlay (Tailscale)	Packet capture proof
🖥️ High Availability (HA)

App Failover: HAProxy automatically redirects traffic to a secondary App VM when the primary fails.
DB Resilience: Menu data cached or replicated (read-only fallback).

Client → HAProxy → [App1, App2]
↓
MySQL Primary ↔ Replica (optional)

⚙️ Tech Stack
Category	Tools
Backend	Laravel 11, PHP 8.2
Frontend	Blade, Bootstrap
Database	MySQL (SSL, X509 Auth)
Infrastructure	Proxmox VE, Tailscale, HAProxy
Security Layer	Adaptive Middleware, Firewall, Nginx TLS
Monitoring	Wireshark, tcpdump, Security Dashboard
🧪 Testing & Verification

Verify DB SSL connection:
mysql --ssl-mode=VERIFY_IDENTITY -h 192.168.1.41 -u app_user -p

Capture encrypted packets:
sudo tcpdump -i any tcp port 3306 -w /tmp/app-db.pcap

Check firewall isolation:
sudo ufw status

Run feedback job:
php artisan security:feedback

🌐 Access

https://food.local
 → 100.88.202.6 (Tailscale)
Import CA certificate to system trust store to avoid HTTPS warnings.

📸 Proof & Demo Checklist

✅ HTTPS padlock visible in browser
✅ TLS handshake captured in Wireshark
✅ App→DB verified via SSL identity check
✅ 403 (RBAC), 429 (RateLimit), 400 (SQLi) responses logged
✅ HAProxy failover working live
✅ Dashboard heatmap displays adaptive modules

👨‍💻 Contributors
Role	Name
Project Lead	You
System Integration	Teammate
DeepSeek Architecture	You
Documentation	Shared
📜 License

Educational use only – Distributed Computing & Security UTS Project 2025.

<h3 align="center">🌟 Inspired by DeepSeek V3.2 Sparse Attention Architecture 🌟</h3> <p align="center"><i>“Activate only what’s needed, when it’s needed.”</i></p>
