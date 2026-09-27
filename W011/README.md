# Laravel Sales Dashboard

โปรเจกต์ตัวอย่างสำหรับงานออกแบบฐานข้อมูล เพิ่มข้อมูล 100+ records และแสดงกราฟด้วย Chart.js

## สิ่งที่มีในโปรเจกต์
- Laravel + MySQL
- ตาราง categories, products, sales
- Seeder สร้างข้อมูล sales 120 records
- Dashboard แสดงยอดขายรวม/จำนวนรายการ/จำนวนชิ้น
- Chart.js 3 กราฟ: ยอดขายรายเดือน, ยอดขายตามหมวดหมู่, สินค้าขายดี
- SQL สำหรับสร้างฐานข้อมูลและข้อมูลตัวอย่าง

## ขั้นตอนรัน
1. ติดตั้ง PHP, Composer และ MySQL/XAMPP
2. สร้าง Laravel project เช่น `composer create-project laravel/laravel sales-dashboard`
3. คัดลอกไฟล์ในชุดนี้ทับไฟล์ตามโครงสร้าง
4. สร้างฐานข้อมูลชื่อ `sales_dashboard`
5. คัดลอก `.env.example` เป็น `.env` และตรวจสอบ DB settings
6. รัน `php artisan key:generate`
7. รัน `php artisan migrate:fresh --seed`
8. รัน `php artisan serve`
9. เปิด `http://127.0.0.1:8000`

หมายเหตุ: Chart.js ถูกโหลดจาก jsDelivr CDN ดังนั้นหน้า Dashboard ต้องเข้าถึงอินเทอร์เน็ตเพื่อโหลดไลบรารี
