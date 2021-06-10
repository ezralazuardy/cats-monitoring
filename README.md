<a href="https://github.com/ezralazuardy/cats-monitoring/actions/workflows/laravel.yml">
  <img src="https://img.shields.io/github/workflow/status/ezralazuardy/cats-monitoring/Laravel?label=build" alt="Build" target="_blank" rel="noopener noreferrer">
</a>

<a href="https://github.com/ezralazuardy/cats-monitoring/releases">
  <img src="https://img.shields.io/github/v/release/ezralazuardy/cats-monitoring" alt="Releases" target="_blank" rel="noopener noreferrer">
</a>

<a href="https://github.com/ezralazuardy/cats-monitoring/blob/master/LICENSE">
  <img src="https://img.shields.io/github/license/ezralazuardy/cats-monitoring" alt="License" target="_blank" rel="noopener noreferrer">
</a>

# 🖥️ 😷 CATS Monitoring

CATS Monitoring is a Web Application to monitor the [Contactless Automatic Thermal Scanner](https://github.com/ezralazuardy/cats) data.
This application also provide REST API for CATS Device in order to save and fetch data by HTTP Request.

For demo purposes, recommended to use local development environment such as [Laragon](https://laragon.org) or [Laravel Valet](https://laravel.com/docs/6.x/valet).

<img src="https://i.ibb.co/99mSk2X/Web-capture-10-6-2021-2004-cats-test.jpg" alt="Screenshot">

<br/>

## ✔️ Requirements

1. Setup your server to use network `192.168.10.0` with IP `192.168.10.2`
2. Whitelist port `5000` in your firewall (inbound and outbound)
3. Install PHP `v7.4`, Composer `v2`, and MySQL `v5.7` in your server
4. Install Laravel's `v8` requirements as stated [here](https://laravel.com/docs/8.x/deployment#server-requirements)
5. Install and setup Web Server ([Nginx](https://nginx.org/en/download.html) / [Apache2](https://httpd.apache.org/download.cgi)) to listen port `5000` in your server

If you use **Windows OS**, in case anything goes wrong, please disable your **Public Network Firewall**.

<br/>

## 🖥️ Installation

1. Clone this repository
2. Setup `.env.` by copying the `.env.example`
3. `composer install`
4. `npm install`
5. `npm run production`
6. Create application's database:
    - `mysql -u root -p`
    - `create database cats_monitoring`
    - `exit`
7. `php artisan key:generate`
8. `php artisan storage:link`
9. `php artisan migrate --force`
10. `chmod -R 777 storage bootstrap/cache`
11. `php artisan config:clear`
12. Configure your Web Server to use **document root** by locating `public/` in project directory

<br/>

## 🗺️ Topology

<p align="center"><img src="https://i.ibb.co/SrF1yCj/topology.png" alt="topology" height="200"/></p>
