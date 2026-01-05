<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Plant;
use App\Models\Promotion;
use Carbon\Carbon;

$plant = Plant::first();
if (!$plant) {
    echo "No plants found. Create a plant first.\n";
    exit(1);
}

$now = Carbon::now();
$promo = Promotion::create([
    'plant_id' => $plant->id,
    'discount_percentage' => 20,
    'start_at' => $now->subHour()->toDateTimeString(),
    'end_at' => $now->addDays(2)->toDateTimeString(),
    'title' => 'Test 20% off',
    'description' => 'Automatic test promotion (20% off) valid for 2 days.',
]);

if ($promo) {
    echo "Created promotion id: {$promo->id} for plant {$plant->id}\n";
} else {
    echo "Failed to create promotion.\n";
}