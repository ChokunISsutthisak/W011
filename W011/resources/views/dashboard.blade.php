<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body{font-family:Arial,sans-serif;background:#f5f7fb;margin:0;color:#1f2937}
        .wrap{max-width:1200px;margin:0 auto;padding:28px}
        h1{margin-bottom:6px}.sub{color:#6b7280;margin-top:0}
        .cards{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:24px 0}
        .card,.panel{background:white;border-radius:14px;padding:20px;box-shadow:0 3px 14px #0000000b}
        .label{color:#6b7280}.value{font-size:30px;font-weight:700;margin-top:8px}
        .grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
        .chartbox{height:330px}.tablewrap{margin-top:18px;overflow:auto}
        table{width:100%;border-collapse:collapse;background:white}.panel table{margin-top:10px}
        th,td{padding:11px;border-bottom:1px solid #e5e7eb;text-align:left}
        th{background:#f9fafb}.money{text-align:right}
        @media(max-width:800px){.cards,.grid{grid-template-columns:1fr}}
    </style>
</head>
<body>
<div class="wrap">
    <h1>📊 Sales Dashboard</h1>
    <p class="sub">ระบบวิเคราะห์ข้อมูลการขายด้วย Laravel + MySQL + Chart.js</p>

    <div class="cards">
        <div class="card"><div class="label">ยอดขายรวม</div><div class="value">฿{{ number_format($totalSales,2) }}</div></div>
        <div class="card"><div class="label">จำนวนรายการขาย</div><div class="value">{{ number_format($totalOrders) }}</div></div>
        <div class="card"><div class="label">จำนวนสินค้าที่ขาย</div><div class="value">{{ number_format($totalItems) }}</div></div>
    </div>

    <div class="grid">
        <div class="panel"><h2>ยอดขายรายเดือน</h2><div class="chartbox"><canvas id="monthlyChart"></canvas></div></div>
        <div class="panel"><h2>ยอดขายตามหมวดหมู่</h2><div class="chartbox"><canvas id="categoryChart"></canvas></div></div>
        <div class="panel"><h2>สินค้าขายดี 10 อันดับ</h2><div class="chartbox"><canvas id="topChart"></canvas></div></div>
        <div class="panel"><h2>ข้อมูลการขายล่าสุด</h2>
            <div class="tablewrap"><table><thead><tr><th>วันที่</th><th>สินค้า</th><th>จำนวน</th><th class="money">ยอดรวม</th></tr></thead>
            <tbody>
            @foreach($recentSales as $sale)
                <tr><td>{{ $sale->sale_date->format('d/m/Y') }}</td><td>{{ $sale->product->name }}</td><td>{{ $sale->quantity }}</td><td class="money">฿{{ number_format($sale->total_amount,2) }}</td></tr>
            @endforeach
            </tbody></table></div>
        </div>
    </div>
</div>
<script>
const monthly = @json($monthlySales);
const categories = @json($categorySales);
const topProducts = @json($topProducts);

new Chart(document.getElementById('monthlyChart'), {
    type:'line',
    data:{labels:monthly.map(x=>x.month), datasets:[{label:'ยอดขาย (บาท)',data:monthly.map(x=>Number(x.total)),tension:.3}]},
    options:{responsive:true,maintainAspectRatio:false}
});
new Chart(document.getElementById('categoryChart'), {
    type:'pie',
    data:{labels:categories.map(x=>x.name),datasets:[{label:'ยอดขาย',data:categories.map(x=>Number(x.total))}]},
    options:{responsive:true,maintainAspectRatio:false}
});
new Chart(document.getElementById('topChart'), {
    type:'bar',
    data:{labels:topProducts.map(x=>x.name),datasets:[{label:'จำนวนชิ้น',data:topProducts.map(x=>Number(x.quantity))}]},
    options:{indexAxis:'y',responsive:true,maintainAspectRatio:false}
});
</script>
</body>
</html>
