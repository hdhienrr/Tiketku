<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // Event 1
        $event1 = Event::create([
            'title' => 'Soundwave Festival 2026',
            'slug' => Str::slug('Soundwave Festival 2026'),
            'description' => 'Festival musik terbesar tahun ini menghadirkan bintang tamu papan atas.',
            'category' => 'Konser Musik',
            'location' => 'Grand City Hall, Surabaya',
            'event_date' => '2026-11-15 19:00:00',
            'image' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=600&auto=format&fit=crop&q=60',
        ]);

        Ticket::create([
            'event_id' => $event1->id,
            'name' => 'Festival Regular',
            'price' => 250000,
            'stock' => 100,
        ]);
        Ticket::create([
            'event_id' => $event1->id,
            'name' => 'VIP Access',
            'price' => 600000,
            'stock' => 25,
        ]);

        // Event 2
        $event2 = Event::create([
            'title' => 'Indonesia AI & Tech Summit',
            'slug' => Str::slug('Indonesia AI & Tech Summit'),
            'description' => 'Konferensi teknologi dan kecerdasan buatan bersama para ahli industri.',
            'category' => 'Tech Seminar',
            'location' => 'Convention Center, Jakarta',
            'event_date' => '2026-12-20 09:00:00',
            'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&auto=format&fit=crop&q=60',
        ]);

        Ticket::create([
            'event_id' => $event2->id,
            'name' => 'General Participant',
            'price' => 150000,
            'stock' => 150,
        ]);

        // Event 3
        $event3 = Event::create([
            'title' => 'Art & Creative Exhibition',
            'slug' => Str::slug('Art & Creative Exhibition'),
            'description' => 'Pameran seni rupa dan karya kreator lokal kreatif.',
            'category' => 'Pameran',
            'location' => 'Balai Pemuda, Surabaya',
            'event_date' => '2027-01-05 10:00:00',
            'image' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=600&auto=format&fit=crop&q=60',
        ]);

        Ticket::create([
            'event_id' => $event3->id,
            'name' => 'Presale Ticket',
            'price' => 50000,
            'stock' => 200,
        ]);
    }
}