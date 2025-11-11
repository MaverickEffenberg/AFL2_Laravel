<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('guides')->insert([
        [
            'name' => 'Venus Flytrap',
            'guide' => 'Care Guide: Venus Flytrap (Droseraceae) thrives in bright, indirect sunlight. Keep soil consistently moist with distilled or rainwater, never tap water. Use acidic soil, such as a mix of sphagnum peat and sand. Feed live insects occasionally, 1-2 per week. Protect from frost; ideal temperature is 20-30°C (68-86°F). Dormancy occurs in winter, reduce watering during this period.',
        ],
        [
            'name' => 'Pitcher Plant',
            'guide' => 'Care Guide: Pitcher Plants (Nepenthaceae) prefer bright, indirect sunlight or partial shade. Soil should be well-draining and acidic, like a mix of sphagnum moss and perlite. Keep the soil moist, using rainwater or distilled water. Feed insects if indoors, but outdoors they capture naturally. Maintain high humidity and temperatures between 22-30°C (72-86°F). Avoid fertilizing.',
        ],
        [
            'name' => 'Sundew',
            'guide' => 'Care Guide: Sundews (Droseraceae) require bright light, preferably direct morning sunlight or strong indirect light. Keep the soil wet at all times, using distilled water. Use acidic soil with peat moss and sand. They capture insects with sticky leaves; minimal manual feeding is needed. Ideal temperature is 18-28°C (65-82°F). Protect from frost.',
        ],
        [
            'name' => 'Cobra Lily',
            'guide' => 'Care Guide: Cobra Lilies (Sarraceniaceae) need full sun to partial shade. Grow in acidic, boggy soil (peat moss and sand mix) and keep soil consistently moist. Do not fertilize; they obtain nutrients from trapped insects. They tolerate cooler temperatures, 15-25°C (59-77°F), and require winter dormancy in colder climates.',
        ],
        [
            'name' => 'Butterwort',
            'guide' => 'Care Guide: Butterworts (Lentibulariaceae) grow well in bright, indirect sunlight. Keep soil moist but well-draining, using a mix of peat moss and sand. Their sticky leaves catch small insects for nutrients; occasional feeding indoors is optional. Ideal temperatures are 18-25°C (65-77°F). Protect from frost and extreme heat.',
        ],
        
    ]);
}

}
