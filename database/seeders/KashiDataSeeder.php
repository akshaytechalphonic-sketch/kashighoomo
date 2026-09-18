<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Page;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Offer;
use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\Package;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\CabBookingPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KashiDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Clean old data
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        
        Package::truncate();
        Room::truncate();
        Hotel::truncate();
        Destination::truncate();
        Service::truncate();
        Offer::truncate();
        Testimonial::truncate();
        Blog::truncate();
        Faq::truncate();
        Page::truncate();
        CabBookingPackage::truncate();
        Setting::truncate();
        
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // 2. Create Users
        User::updateOrCreate([
            'email' => 'admin@hotelres.com',
        ], [
            'name' => 'Kashi Tourism Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::updateOrCreate([
            'email' => 'customer@example.com',
        ], [
            'name' => 'Aditya Sharma',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // 3. Create Settings
        Setting::create([
            'site_name' => 'Visit Kashi',
            'site_tagline' => 'Experience the spiritual essence of the world\'s oldest living city. Explore tour packages, luxury hotels, cab bookings, and boat rides.',
            'contact_email' => 'info@visitkashi.com',
            'contact_phone' => '+91 98765 43210',
            'phone_two' => '+91 87654 32109',
            'whatsapp_number' => '+91 98765 43210',
            'address' => 'Dashashwamedh Ghat Road, Godowlia, Varanasi, Uttar Pradesh - 221001',
            'google_map_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3606.8122394334316!2d83.00762617610667!3d25.309277027170868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398e2df8b3941ab5%3A0xc3f8b7ec64b63e!2sDashashwamedh%20Ghat!5e0!3m2!1sen!2sin!4v1719918239024!5m2!1sen!2sin',
            'facebook_url' => 'https://www.facebook.com/',
            'instagram_url' => 'https://www.instagram.com/',
            'twitter_url' => 'https://x.com/',
            'youtube_url' => 'https://www.youtube.com/',
            'seo_meta_title' => 'Visit Kashi | Premium Varanasi Tourism & Pilgrimage Organizers',
            'seo_meta_description' => 'Book premium Varanasi tour packages, boat rides on the Ganges, luxury hotel stays, and cab services. Your complete guide to Kashi Yatra.',
            'seo_meta_keywords' => 'kashi tourism, varanasi tour package, ganga aarti boat ride, kashi vishwanath temple, sarnath tour',
            'copyright_text' => '© 2026 Visit Kashi. All rights reserved. | Designed for Kashi Tourism.',
        ]);

        // 4. Create Core Pages
        $home = Page::create([
            'slug' => 'home',
            'page_name' => 'Home',
            'meta_title' => 'Varanasi Tour Packages & Ganga Boat Rides | Visit Kashi',
            'meta_description' => 'Experience the magic of Varanasi with our premium Kashi tour packages, luxury hotel stays, boat rides, and cab services.',
            'meta_keywords' => 'visit kashi, varanasi tour, kashi yatra, ganga boat booking, varanasi cabs',
            'status' => true
        ]);
        
        $about = Page::create([
            'slug' => 'about-us',
            'page_name' => 'About Us',
            'meta_title' => 'About Us | Visit Kashi - Your Local Varanasi Travel Partner',
            'meta_description' => 'Learn about Visit Kashi, Varanasi\'s leading tour operator organizing custom pilgrimage tours, heritage walks, and boat cruises.',
            'meta_keywords' => 'about visit kashi, varanasi travel agency, local tour operators varanasi',
            'status' => true
        ]);

        Page::create([
            'slug' => 'packages',
            'page_name' => 'Tour Packages',
            'meta_title' => 'Curated Kashi Tour Packages & Varanasi Itineraries',
            'meta_description' => 'Browse our Kashi Yatra packages: temple darshans, heritage walks, cultural tours, and excursions to Sarnath & Vindhyachal.',
            'meta_keywords' => 'kashi tour packages, varanasi packages, sarnath packages, kashi vishwanath yatra',
            'status' => true
        ]);

        Page::create([
            'slug' => 'package-detail',
            'page_name' => 'Package Details',
            'meta_title' => 'Yatra Details & Itinerary | Visit Kashi',
            'meta_description' => 'Detailed day-by-day travel plans, inclusions, exclusions, and enquiry form for our premium Kashi packages.',
            'meta_keywords' => 'varanasi travel itinerary, kashi tour inclusions',
            'status' => true
        ]);

        Page::create([
            'slug' => 'contact-us',
            'page_name' => 'Contact Us',
            'meta_title' => 'Contact Visit Kashi | Plan Your Varanasi Holiday',
            'meta_description' => 'Get in touch with our Varanasi travel experts. Contact us for custom tour plans, boat rides, cab bookings, or hotel enquiries.',
            'meta_keywords' => 'contact kashi tourism, varanasi travel agency contact, kashi booking details',
            'status' => true
        ]);

        // 5. Create Page Sections (Home)
        $home->sections()->createMany([
            [
                'section_name' => 'hero',
                'title' => 'Experience the Eternal Spiritual Vibe of Kashi',
                'description' => 'Explore the sacred ghats, witness the grand Ganga Aarti, and embark on a divine journey to the land of Lord Shiva with our premium tourism packages.',
                'extra_data' => [
                    'button_text' => 'Explore Packages', 
                    'sub_title' => 'Welcome to Premium Kashi Tourism',
                    'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4'
                ],
                'status' => true
            ],
            [
                'section_name' => 'about_intro',
                'title' => 'Gateway to the Spiritual Heart of India',
                'description' => 'We are native pioneers dedicated to showcasing the authentic heritage, ancient temples, and spiritual grandeur of Varanasi. From customized Kashi Yatra packages to serene boat rides and luxury stays, we manage every detail of your pilgrimage with absolute devotion and premium hospitality.',
                'extra_data' => ['years_experience' => '15+', 'tagline' => '100% Native Hospitality'],
                'status' => true
            ],
            [
                'section_name' => 'why_choose_us',
                'title' => 'Why Pilgrims Choose Visit Kashi',
                'description' => 'Creating comfortable, secure, and spiritually enriching journeys along the holy Ganges.',
                'extra_data' => [
                    'features' => [
                        ['title' => 'Local Pandits & Guides', 'icon' => 'bi-geo-alt', 'desc' => 'Experienced local guides and pandits to assist in rituals and darshans.'],
                        ['title' => 'Handpicked Stays', 'icon' => 'bi-buildings', 'desc' => 'Vetted heritage resorts, boutique stays, and comfortable hotels near the ghats.'],
                        ['title' => 'Serene Boat Rides', 'icon' => 'bi-water', 'desc' => 'Clean, safe row boats and luxury motor cruises equipped with life jackets.'],
                        ['title' => 'Bespoke Itineraries', 'icon' => 'bi-sliders', 'desc' => '100% customisable plans tailored to seniors, families, and solo explorers.']
                    ]
                ],
                'status' => true
            ],
            [
                'section_name' => 'cta_footer',
                'title' => 'Ready to Experience the Divine Grace?',
                'description' => 'Contact us today to receive a customized Kashi Yatra itinerary from our local travel experts.',
                'extra_data' => ['button_text' => 'GET A DEDICATED QUOTE'],
                'status' => true
            ]
        ]);

        // 6. Create Page Sections (About Us)
        $about->sections()->createMany([
            [
                'section_name' => 'header',
                'title' => 'Our Pilgrimage Journey',
                'description' => 'We are Varanasi\'s premier travel coordinators, showcasing the history, mysticism, and architectural beauty of Kashi.',
                'extra_data' => ['bg_image' => 'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&q=80&w=1920'],
                'status' => true
            ],
            [
                'section_name' => 'main_about',
                'title' => 'Pioneering Heritage & Spiritual Hospitality',
                'description' => 'Visit Kashi was founded to share the spiritual wealth, rich classical music, and Vedic culture of Varanasi with visitors from all walks of life. Over 15 years, we have designed pilgrimages and cultural tours that balance high comfort with the authentic, raw spiritual lifestyle of Kashi\'s ghats, alleys, and temples.',
                'extra_data' => ['sub_title' => 'We Welcome You to Shiva\'s Abode'],
                'status' => true
            ],
            [
                'section_name' => 'mission_vision',
                'title' => 'Our Values',
                'extra_data' => [
                    'mission' => 'To offer authentic, secure, and highly comfortable spiritual and cultural travel experiences while respecting local traditions and supporting local communities.',
                    'vision' => 'To remain the most trusted local brand in Kashi Yatra coordination, celebrated for high service standards, local expertise, and transparent operations.'
                ],
                'status' => true
            ],
            [
                'section_name' => 'stats',
                'extra_data' => [
                    ['value' => '12,000+', 'label' => 'Pilgrims Welcomed'],
                    ['value' => '25+', 'label' => 'Curated Routes'],
                    ['value' => '50+', 'label' => 'Verified Vehicles'],
                    ['value' => '15+', 'label' => 'Years of Devotion']
                ],
                'status' => true
            ]
        ]);

        // 7. Seed Destinations
        $d1 = Destination::create([
            'name' => 'Dashashwamedh & Main Ghats',
            'slug' => Destination::generateSlug('Dashashwamedh and Main Ghats'),
            'description' => 'The vibrant heart of Varanasi\'s riverfront. Famous for the spectacular daily Ganga Aarti, bustling activities, and historical steps.',
            'location' => 'Varanasi Riverfront',
            'image' => null,
            'status' => true
        ]);

        $d2 = Destination::create([
            'name' => 'Kashi Vishwanath Temple Area',
            'slug' => Destination::generateSlug('Kashi Vishwanath Temple Area'),
            'description' => 'The divine center of Kashi, home to the golden spire of Lord Vishwanath Temple, the newly built corridor, and ancient spiritual alleys.',
            'location' => 'Lahurabir-Godowlia Road, Varanasi',
            'image' => null,
            'status' => true
        ]);

        $d3 = Destination::create([
            'name' => 'Assi Ghat & Southern Varanasi',
            'slug' => Destination::generateSlug('Assi Ghat and Southern Varanasi'),
            'description' => 'A serene ghat where the Assi River joins the Ganga. Famous for Subah-e-Banaras, yoga sessions, cultural programs, and student cafes.',
            'location' => 'Shivala, Varanasi',
            'image' => null,
            'status' => true
        ]);

        $d4 = Destination::create([
            'name' => 'Sarnath (Buddhist Heritage)',
            'slug' => Destination::generateSlug('Sarnath Buddhist Heritage'),
            'description' => 'A peaceful archaeological town where Lord Buddha gave his first sermon. Features the Dhamek Stupa, Ashok Pillar, and local museums.',
            'location' => 'Sarnath, 10km from Varanasi',
            'image' => null,
            'status' => true
        ]);

        // 8. Seed Services
        $s1 = Service::create([
            'title' => 'Kashi Yatra Tour Packages',
            'description' => 'Curated itineraries featuring major temples, heritage walks, and excursions with private guides.',
            'icon' => 'bi-compass',
            'status' => true
        ]);

        $s2 = Service::create([
            'title' => 'Hotel Booking',
            'description' => 'Heritage ghatside hotels, boutique resorts, and premium hotels with excellent amenities and Ganga views.',
            'icon' => 'bi-buildings',
            'status' => true
        ]);

        $s3 = Service::create([
            'title' => 'Cab Booking',
            'description' => 'Chauffeur-driven sedans, SUVs, and luxury coaches for local sightseeing and airport transfers.',
            'icon' => 'bi-car-front',
            'status' => true
        ]);

        $s4 = Service::create([
            'title' => 'Boat Ride Booking',
            'description' => 'Traditional row boats, motor boats, and luxury bajras for spectacular Ganga cruises during sunrise or sunset.',
            'icon' => 'bi-water',
            'status' => true
        ]);

        // 9. Seed Hotels
        $h1 = Hotel::create([
            'destination_id' => $d1->id,
            'name' => 'Brijrama Palace Heritage Hotel',
            'slug' => 'brijrama-palace-heritage-hotel',
            'location' => 'Darbhanga Ghat, Dashashwamedh, Varanasi, UP - 221001',
            'star_rating' => 5,
            'managed_by' => 'Brijrama Heritage Hospitality',
            'usps' => ['Direct Ghat Access', 'Heritage Architecture', 'Ganga Views'],
            'description' => 'Built in 1812, Brijrama Palace is one of the oldest heritage landmarks on the Varanasi ghats. Positioned on Darbhanga Ghat, the palace features breathtaking architecture, luxury rooms, and direct access to the river.',
            'amenities' => ['High Speed Wifi', 'Ganga View Lounge', 'Multi-cuisine Restaurant', 'Direct Ghat Access', 'Spa'],
            'landmarks' => [
                ['name' => 'Dashashwamedh Ghat', 'distance' => '0.3 km']
            ],
            'airports' => [
                ['name' => 'Lal Bahadur Shastri International Airport', 'distance' => '25 km']
            ],
            'attractions' => [
                ['name' => 'Kashi Vishwanath Temple', 'distance' => '0.8 km']
            ],
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3606.8122394334316!2d83.00762617610667!3d25.309277027170868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398e2df8b3941ab5%3A0xc3f8b7ec64b63e!2sDashashwamedh%20Ghat!5e0!3m2!1sen!2sin!4v1719918239024!5m2!1sen!2sin',
            'images' => []
        ]);

        $h2 = Hotel::create([
            'destination_id' => $d2->id,
            'name' => 'Taj Ganges Varanasi',
            'slug' => 'taj-ganges-varanasi',
            'location' => 'Nadesar Palace Grounds, Varanasi, UP - 221002',
            'star_rating' => 5,
            'managed_by' => 'Taj Hotels Resorts and Palaces',
            'usps' => ['40-acre gardens', 'Legendary Taj Hospitality'],
            'description' => 'Spread across 40 acres of lush gardens, Taj Ganges is a peaceful sanctuary in the heart of the city. Perfect for travelers seeking legendary Taj hospitality and modern comforts close to the spiritual hubs.',
            'amenities' => ['Wifi', 'Swimming Pool', 'Fitness Center', 'Travel Desk', 'Spa'],
            'landmarks' => [
                ['name' => 'Varanasi Junction', 'distance' => '1.5 km']
            ],
            'airports' => [
                ['name' => 'Varanasi Airport', 'distance' => '21 km']
            ],
            'attractions' => [
                ['name' => 'Kashi Vishwanath Corridor', 'distance' => '5.5 km']
            ],
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3606.8122394334316!2d83.00762617610667!3d25.309277027170868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398e2df8b3941ab5%3A0xc3f8b7ec64b63e!2sDashashwamedh%20Ghat!5e0!3m2!1sen!2sin!4v1719918239024!5m2!1sen!2sin',
            'images' => []
        ]);

        $h3 = Hotel::create([
            'destination_id' => $d1->id,
            'name' => 'Alka Hotel (Ghatside)',
            'slug' => 'alka-hotel-ghatside',
            'location' => 'Meer Ghat, Dashashwamedh, Varanasi, UP - 221001',
            'star_rating' => 3,
            'managed_by' => 'Alka Hospitality',
            'usps' => ['Meer Ghat Location', 'Panoramic Riverviews'],
            'description' => 'Overlooking the sacred Ganges River, Alka Hotel offers comfortable rooms, a famous vegetarian restaurant, and a popular patio terrace providing beautiful panoramic river views.',
            'amenities' => ['Wifi', 'Vegetarian Restaurant', 'Riverview Patio'],
            'landmarks' => [
                ['name' => 'Manikarnika Ghat', 'distance' => '0.2 km']
            ],
            'airports' => [
                ['name' => 'Varanasi Airport', 'distance' => '24 km']
            ],
            'attractions' => [
                ['name' => 'Ganga Aarti Spot', 'distance' => '0.4 km']
            ],
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3606.8122394334316!2d83.00762617610667!3d25.309277027170868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398e2df8b3941ab5%3A0xc3f8b7ec64b63e!2sDashashwamedh%20Ghat!5e0!3m2!1sen!2sin!4v1719918239024!5m2!1sen!2sin',
            'images' => []
        ]);

        // 10. Seed Rooms
        $h1->rooms()->createMany([
            [
                'room_type' => 'Heritage Riverview Suite',
                'price' => 15000.00,
                'capacity' => 2,
                'bed_type' => 'King Bed',
                'view_type' => 'Ganga River View',
                'description' => 'A luxury heritage suite with large windows looking over Darbhanga Ghat and the Ganges River. Restored antique furniture, high ceilings, and royal decor.',
                'inclusions' => ['Ganga River View', 'Central AC', 'Free Wi-Fi', 'Heritage Decor', '24/7 Butler Service', 'Mini Bar'],
                'rate_plans' => [
                    ['type' => 'EP', 'name' => 'Room Only', 'price' => 15000],
                    ['type' => 'CP', 'name' => 'Bed & Breakfast', 'price' => 16500],
                    ['type' => 'MAP', 'name' => 'Breakfast & Dinner', 'price' => 18500],
                ],
                'is_available' => true
            ],
            [
                'room_type' => 'Royal Heritage Room',
                'price' => 11000.00,
                'capacity' => 2,
                'bed_type' => 'King Bed',
                'view_type' => 'Courtyard View',
                'description' => 'Elegant rooms designed with rich Indian artwork and premium comforts. Looks onto the palace courtyard.',
                'inclusions' => ['AC', 'Free Wi-Fi', 'Heritage Decor', 'TV', 'Tea/Coffee Maker'],
                'rate_plans' => [
                    ['type' => 'EP', 'name' => 'Room Only', 'price' => 11000],
                    ['type' => 'CP', 'name' => 'Bed & Breakfast', 'price' => 12200],
                ],
                'is_available' => true
            ]
        ]);

        $h2->rooms()->createMany([
            [
                'room_type' => 'Superior Gardenview Room',
                'price' => 9500.00,
                'capacity' => 2,
                'bed_type' => 'Double Bed',
                'view_type' => 'Lush Garden View',
                'description' => 'A spacious room with premium linen, contemporary design, and large windows looking onto the property\'s historic gardens.',
                'inclusions' => ['AC', 'Free Wi-Fi', 'Flat TV', 'Mini Fridge', 'Pool Access', 'Gym Access'],
                'rate_plans' => [
                    ['type' => 'EP', 'name' => 'Room Only', 'price' => 9500],
                    ['type' => 'CP', 'name' => 'Bed & Breakfast', 'price' => 10800],
                    ['type' => 'MAP', 'name' => 'Breakfast & Dinner', 'price' => 12800],
                ],
                'is_available' => true
            ]
        ]);

        // 11. Seed Cab Booking Packages
        $c1 = CabBookingPackage::create([
            'cab_name' => 'Maruti Suzuki Dzire / Toyota Etios',
            'vehicle_type' => 'Sedan',
            'seating_capacity' => 4,
            'price' => 2500.00,
            'description' => '<ul><li>Ideal for couples, solo travelers, and small families.</li><li>Includes local sightseeing (8 Hours / 80 Kms).</li><li>Fully air-conditioned, well-maintained vehicles.</li><li>Includes driver allowance, toll taxes, and parking fees.</li></ul>',
            'images' => null,
            'status' => true
        ]);

        $c2 = CabBookingPackage::create([
            'cab_name' => 'Maruti Suzuki Ertiga',
            'vehicle_type' => 'SUV',
            'seating_capacity' => 6,
            'price' => 3500.00,
            'description' => '<ul><li>Perfect choice for families and groups of up to 6 members.</li><li>Comfortable seating with sufficient luggage space.</li><li>Includes local temples and Sarnath sightseeing (8 Hours / 80 Kms).</li><li>Includes air conditioning, tolls, parking, and driver allowance.</li></ul>',
            'images' => null,
            'status' => true
        ]);

        $c3 = CabBookingPackage::create([
            'cab_name' => 'Toyota Innova Crysta',
            'vehicle_type' => 'Premium SUV',
            'seating_capacity' => 7,
            'price' => 5000.00,
            'description' => '<ul><li>Premium executive SUV experience for family trips.</li><li>Highly comfortable captain seats, excellent suspension, and double AC.</li><li>Includes airport transfer or local sightseeing.</li><li>Includes fuel, toll taxes, state tax, and driver allowance.</li></ul>',
            'images' => null,
            'status' => true
        ]);

        $c4 = CabBookingPackage::create([
            'cab_name' => 'Force Tempo Traveler',
            'vehicle_type' => 'Tempo Traveler',
            'seating_capacity' => 17,
            'price' => 8000.00,
            'description' => '<ul><li>Best for pilgrim groups, large families, and corporate outings.</li><li>17 pushback luxury seats, stereo sound system, and powerful rear AC.</li><li>Covers local temples, ghats transfer, and Sarnath.</li><li>Includes professional driver, fuel, tolls, and parking.</li></ul>',
            'images' => null,
            'status' => true
        ]);

        // 12. Seed Tour Packages (Kashi Yatra Packages)
        Package::create([
            'destination_id' => $d2->id,
            'service_id' => $s1->id,
            'title' => 'Essential Kashi Vishwanath Darshan Yatra',
            'slug' => 'essential-kashi-vishwanath-darshan-yatra',
            'duration' => '2 Days / 1 Night',
            'price' => 3500.00,
            'start_location' => 'Varanasi Airport / Junction',
            'difficulty' => 'Easy',
            'best_season' => 'October to March',
            'description' => '<p>A perfect yatra package for pilgrims wanting a structured, hassle-free Kashi Vishwanath Darshan. Experience Lord Vishwanath Temple, Ganga Aarti, and local heritage sights under the guidance of native experts.</p>',
            'inclusions' => ['1 Night Accommodation in a boutique hotel', 'VIP Pass for Kashi Vishwanath Darshan', 'Private Ganga Row Boat Ride for Aarti', 'Airport/Station Transfers & Sightseeing by AC Cab', 'Govt. Approved Local Tour Guide'],
            'exclusions' => ['Personal ritual expenses / pooja samagri', 'Meals other than breakfast', 'Tips to local helpers', 'Airfare/Train tickets'],
            'itinerary' => [
                ['day' => 'Day 1', 'title' => 'Arrival & Evening Ganga Aarti', 'description' => 'Arrival at Varanasi. Pick up by private cab and transfer to hotel. In the evening, witness the grand Ganga Aarti from a private boat at Dashashwamedh Ghat.'],
                ['day' => 'Day 2', 'title' => 'Vishwanath Darshan & Departure', 'description' => 'Early morning VIP Darshan at Kashi Vishwanath Temple, followed by visits to Annapurna Temple, Vishalakshi Temple, and Kaal Bhairav. Check out and transfer to airport/station.']
            ],
            'images' => null,
            'status' => true,
            'featured' => true
        ]);

        Package::create([
            'destination_id' => $d1->id,
            'service_id' => $s1->id,
            'title' => 'Subah-e-Banaras & Cultural Tour',
            'slug' => 'subah-e-banaras-cultural-tour',
            'duration' => '1 Day',
            'price' => 1500.00,
            'start_location' => 'Assi Ghat',
            'difficulty' => 'Easy',
            'best_season' => 'September to April',
            'description' => '<p>Witness the beautiful morning rites of Varanasi. Starts at 5:00 AM with Subah-e-Banaras at Assi Ghat, featuring a classical music performance, Vedic chanting, and yoga. Followed by a heritage walking tour of the south ghats.</p>',
            'inclusions' => ['Assi Ghat Morning Aarti & Cultural Event', 'Traditional Boat Ride at Sunrise', 'Banarasi Breakfast (Kachori-Sabzi & Jalebi)', 'English/Hindi speaking cultural guide'],
            'exclusions' => ['Hotel stay/accommodation', 'Cab transfers', 'Personal expenses'],
            'itinerary' => [
                ['day' => '5:00 AM', 'title' => 'Subah-e-Banaras at Assi Ghat', 'description' => 'Experience the morning rituals, Vedic mantras, and watch classical musical performances by native artists as the sun rises.'],
                ['day' => '6:30 AM', 'title' => 'Sunrise Boat Cruise & Breakfast', 'description' => 'A calm boat cruise along the major ghats. Conclude with a delicious, local Banarasi breakfast in a heritage alley.']
            ],
            'images' => null,
            'status' => true,
            'featured' => false
        ]);

        Package::create([
            'destination_id' => $d4->id,
            'service_id' => $s1->id,
            'title' => 'Varanasi & Sarnath Spiritual Weekend',
            'slug' => 'varanasi-sarnath-spiritual-weekend',
            'duration' => '3 Days / 2 Nights',
            'price' => 5500.00,
            'start_location' => 'Varanasi Airport / Junction',
            'difficulty' => 'Easy',
            'best_season' => 'October to March',
            'description' => '<p>Explore the twin legacies of Kashi. Discover the Vedic/Hindu heritage of Varanasi and the ancient Buddhist monuments of Sarnath. Ideal for families and history enthusiasts.</p>',
            'inclusions' => ['2 Nights Accommodation in a 3-star hotel', 'Daily breakfast at the hotel', 'Excursion to Sarnath with entry tickets', 'Private AC Sedan for all sightseeing', 'Daily Ganga Aarti boat booking'],
            'exclusions' => ['Guide charges at monuments', 'Lunch and Dinner', 'Pooja/Ritual charges'],
            'itinerary' => [
                ['day' => 'Day 1', 'title' => 'Arrival, Ghats Visit & Ganga Aarti', 'description' => 'Arrival in Varanasi. Transfer to hotel. Evening visit to Dashashwamedh Ghat for the world-famous Ganga Aarti.'],
                ['day' => 'Day 2', 'title' => 'Temple Darshans & Sarnath Sightseeing', 'description' => 'Morning darshan at Kashi Vishwanath, Sankat Mochan, Durga Temple. Afternoon excursion to Sarnath to see Dhamek Stupa and Sarnath Museum.'],
                ['day' => 'Day 3', 'title' => 'Ganga Bath, Local Markets & Departure', 'description' => 'Early morning holy bath, visit local silk weaving centers, and checkout for departure transfer.']
            ],
            'images' => null,
            'status' => true,
            'featured' => true
        ]);

        // 13. Seed Boat Rides (Seeded as packages mapped to "Boat Ride Booking" service)
        Package::create([
            'destination_id' => $d1->id,
            'service_id' => $s4->id,
            'title' => 'Sunrise Traditional Row Boat Ride',
            'slug' => 'sunrise-traditional-row-boat-ride',
            'duration' => '1 Hour',
            'price' => 500.00,
            'start_location' => 'Assi Ghat / Dashashwamedh Ghat',
            'difficulty' => 'Easy',
            'best_season' => 'Year Round',
            'description' => '<p>Embark on a traditional row boat guided by a local oarsman. Drift along the holy river as the sun rises over the horizon, highlighting the golden colors of the historical ghats.</p>',
            'inclusions' => ['1 Hour Private Row Boat', 'Local Oarsman', 'Life Jackets for all guests'],
            'exclusions' => ['Food and beverages', 'Guides'],
            'itinerary' => [
                ['day' => 'Step 1', 'title' => 'Boarding at Ghat', 'description' => 'Meet your boatman at the designated ghat at 5:15 AM.'],
                ['day' => 'Step 2', 'title' => 'River Drifting', 'description' => 'Glide slowly along the ghats, observing bathing rituals, prayers, and heritage structures as the sun emerges.']
            ],
            'images' => null,
            'status' => true,
            'featured' => true
        ]);

        Package::create([
            'destination_id' => $d1->id,
            'service_id' => $s4->id,
            'title' => 'Ganga Aarti Evening Motor Boat Cruise',
            'slug' => 'ganga-aarti-evening-motor-boat-cruise',
            'duration' => '2 Hours',
            'price' => 1200.00,
            'start_location' => 'Dashashwamedh Ghat',
            'difficulty' => 'Easy',
            'best_season' => 'Year Round',
            'description' => '<p>A motorized boat cruise covering the entire stretch of Varanasi\'s ghats. Stop right in front of Dashashwamedh Ghat to view the spectacular evening Ganga Aarti from the comfort of the water.</p>',
            'inclusions' => ['2 Hours Shared/Private Motor Boat Cruise', 'Experienced Navigator', 'Life Jackets', 'Best spot booking for Ganga Aarti view'],
            'exclusions' => ['Personal donations', 'Meals'],
            'itinerary' => [
                ['day' => 'Step 1', 'title' => 'Ghats Cruise', 'description' => 'Cruise from Harishchandra Ghat to Manikarnika Ghat, witnessing Varanasi\'s heritage in the twilight.'],
                ['day' => 'Step 2', 'title' => 'Ganga Aarti Viewing', 'description' => 'Anchor in front of Dashashwamedh Ghat to witness the synchronized lamps ritual, chants, and bells.']
            ],
            'images' => null,
            'status' => true,
            'featured' => true
        ]);

        Package::create([
            'destination_id' => $d3->id,
            'service_id' => $s4->id,
            'title' => 'Private Luxury Bajra Cruise',
            'slug' => 'private-luxury-bajra-cruise',
            'duration' => '3 Hours',
            'price' => 6000.00,
            'start_location' => 'Assi Ghat',
            'difficulty' => 'Easy',
            'best_season' => 'October to April',
            'description' => '<p>Book a private luxury double-deck Bajra (traditional flat-bottomed wooden boat). Complete with Banarasi tea, local snacks, cushion seating, and a live sitar/shehnai performance onboard.</p>',
            'inclusions' => ['3 Hours Private Bajra Charter', 'Cushioned Seating & Elegant Carpets', 'Live Sitar & Shehnai Musicians', 'Local Snacks & Hot Kulhad Masala Chai', 'Life Safety Equipments'],
            'exclusions' => ['Alcoholic drinks', 'Taxes'],
            'itinerary' => [
                ['day' => 'Step 1', 'title' => 'Boarding & Musicians Welcome', 'description' => 'Board the decorated Bajra at Assi Ghat. You will be welcomed with rose water and hot masala chai.'],
                ['day' => 'Step 2', 'title' => 'Sunset Cruise & Aarti', 'description' => 'Drift along the river with sitar music playing in the background. Stop for Ganga Aarti and return at night.']
            ],
            'images' => null,
            'status' => true,
            'featured' => true
        ]);

        // 14. Seed FAQs
        Faq::create([
            'question' => 'What is the best time to visit Varanasi (Kashi)?',
            'answer' => 'The best time to visit Varanasi is from October to March, when the weather is cool and pleasant. Temperatures are comfortable for sightseeing, temple visits, and boat rides.',
            'order' => 1,
            'status' => true
        ]);

        Faq::create([
            'question' => 'What are the timings for the famous Ganga Aarti?',
            'answer' => 'The evening Ganga Aarti at Dashashwamedh Ghat starts around 6:30 PM in winters and 7:00 PM in summers. It is recommended to arrive or book a boat at least 45 minutes in advance to get a good viewing spot.',
            'order' => 2,
            'status' => true
        ]);

        Faq::create([
            'question' => 'Is there a dress code for entering Kashi Vishwanath Temple?',
            'answer' => 'While there is no strict daily dress code for general darshan, visitors are requested to dress modestly. Avoid wearing beachwear, shorts, or sleeveless shirts. For specific rituals like Sparsh Darshan, traditional Indian attire (sari for women, dhoti-kurta for men) is mandatory.',
            'order' => 3,
            'status' => true
        ]);

        // 15. Seed Blogs
        $adminUser = User::where('role', 'admin')->first();
        Blog::create([
            'user_id' => $adminUser ? $adminUser->id : 1,
            'title' => 'The Spiritual Significance of Ganga Aarti in Kashi',
            'slug' => 'spiritual-significance-ganga-aarti-kashi',
            'short_description' => 'A deep dive into the theological history, structure, and emotional experience of witnessing Varanasi\'s grand daily river prayers.',
            'content' => '<p>Every evening as twilight falls, Varanasi transforms. The sounds of traffic are replaced by bells, conchs, and holy chants. The Ganga Aarti at Dashashwamedh Ghat is a tribute to the holy river Ganges, Lord Shiva, and the cosmos...</p>',
            'featured_image' => null,
            'is_published' => true
        ]);

        Blog::create([
            'user_id' => $adminUser ? $adminUser->id : 1,
            'title' => 'A Pilgrims Guide to Kashi Vishwanath Corridor',
            'slug' => 'pilgrims-guide-kashi-vishwanath-corridor',
            'short_description' => 'Everything you need to know about navigating the newly developed grand corridor connecting the Ganges to the Golden Temple.',
            'content' => '<p>The Kashi Vishwanath Corridor has revolutionized the pilgrim experience in Varanasi. Spanning over 5 lakh square feet, it creates a direct, beautiful walkway from Lalita Ghat to the ancient temple...</p>',
            'featured_image' => null,
            'is_published' => true
        ]);

        // 16. Seed Testimonials
        Testimonial::create([
            'name' => 'Meera Krishnan',
            'role' => 'Pilgrim from Chennai',
            'content' => 'The VIP Darshan at Kashi Vishwanath Temple organized by Visit Kashi was exceptionally smooth. As senior citizens, my husband and I were very worried about the crowds, but their local guide took great care of us.',
            'rating' => 5,
            'status' => true
        ]);

        Testimonial::create([
            'name' => 'Robert Johnson',
            'role' => 'Traveler from UK',
            'content' => 'The sunrise boat ride starting from Assi Ghat was a highlight of my India trip. The Sitar music on the Bajra boat, the morning tea, and the misty views of the ghats were incredibly serene.',
            'rating' => 5,
            'status' => true
        ]);
    }
}
