<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'กาแฟ'], ['name' => 'เครื่องดื่ม'], ['name' => 'เบเกอรี่'],
            ['name' => 'อาหาร'], ['name' => 'ของหวาน']
        ];
        foreach ($categories as &$c) {
            $c['created_at'] = now(); $c['updated_at'] = now();
        }
        DB::table('categories')->insert($categories);

        $productNames = [
            ['กาแฟ', ['เอสเพรสโซ','อเมริกาโน','ลาเต้','คาปูชิโน','มอคค่า','คาราเมลมัคคิอาโต']],
            ['เครื่องดื่ม', ['ชาไทย','ชาเขียว','โกโก้','นมสด','น้ำผึ้งมะนาว','โซดาผลไม้']],
            ['เบเกอรี่', ['ครัวซองต์','เค้กช็อกโกแลต','บราวนี่','มัฟฟินบลูเบอร์รี่','ขนมปังเนยสด','ชีสเค้ก']],
            ['อาหาร', ['แซนด์วิชแฮมชีส','สปาเกตตีซอสแดง','ข้าวกะเพราไก่','ข้าวผัดกุ้ง','สลัดผัก','พาสต้าเห็ด']],
            ['ของหวาน', ['วาฟเฟิล','แพนเค้ก','ไอศกรีมวานิลลา','โทสต์น้ำผึ้ง','พุดดิ้งคาราเมล','ผลไม้รวม']]
        ];
        $prices = [45, 55, 60, 65, 70, 75];
        $products = [];
        $categoryMap = DB::table('categories')->pluck('id','name');
        foreach ($productNames as [$cat, $names]) {
            foreach ($names as $i => $name) {
                $products[] = [
                    'category_id' => $categoryMap[$cat],
                    'name' => $name,
                    'price' => $prices[$i],
                    'created_at' => now(), 'updated_at' => now()
                ];
            }
        }
        DB::table('products')->insert($products);

        $productRows = DB::table('products')->get();
        $sales = [];
        $start = Carbon::create(2026, 1, 1);
        for ($i = 1; $i <= 120; $i++) {
            $p = $productRows[($i - 1) % $productRows->count()];
            $qty = (($i * 7) % 8) + 1;
            $d = $start->copy()->addDays(($i * 2) % 180);
            $sales[] = [
                'product_id' => $p->id,
                'sale_date' => $d->toDateString(),
                'quantity' => $qty,
                'unit_price' => $p->price,
                'total_amount' => $qty * $p->price,
                'created_at' => now(), 'updated_at' => now()
            ];
        }
        DB::table('sales')->insert($sales);
    }
}
