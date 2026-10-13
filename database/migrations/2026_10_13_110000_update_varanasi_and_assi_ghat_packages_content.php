<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Package;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update Assi Ghat Sunrise Tour Package
        $pkgAssi = Package::where('slug', 'assi-ghat-sunrise-spiritual-walk-experience')->first();
        if ($pkgAssi) {
            $assiDescription = <<<'HTML'
<h1>Assi Ghat Sunrise Tour: The Side of Varanasi You Shouldn't Miss</h1>

<p>The mornings in Varanasi are just different. You don’t have to pray immediately; you can watch the sun rise over the banks of the Ganga. It is more than a perspective of Varanasi and your normal everyday life.</p>

<p>Experience Assi Ghat Morning with the <strong>Subah-e-Banaras</strong> Program, a boat ride on the Ganga, temple visits &amp; sightseeing among temples, &amp; many more. <strong>Kashi Ghoomo</strong> ensures that you get everything in one go, so your experience of Varanasi is never interrupted by the time you need to search for another place.</p>

<h2>What Can You Experience at Assi Ghat in the Morning?</h2>

<p>Assi Ghat is another favorite spot to visit in Varanasi in the morning hours. There are different types of people at the ghat. People come here for a prayer, as a yoga session, or just to sit down and watch the sunrise at the ghat with a view of the Ganga. You can also see locals starting their day while visitors enjoy the view.</p>

<p>One of the main things to see here is the <strong>Subah-e-Banaras</strong> program. It allows visitors to feel a part of a few of the traditions of Varanasi.</p>

<p><strong>In the program, you may find:</strong></p>
<ul>
    <li><strong>Vedic chanting:</strong> Hear prayers and chants in the morning.</li>
    <li><strong>Yoga:</strong> See the yoga teacher in action as the day gets underway.</li>
    <li><strong>Music for the Heart:</strong> Listen to the music of the morning program.</li>
</ul>

<p>You don't have to understand every word of each prayer or ritual in order to enjoy it. You can simply sit and listen to it and experience it.</p>

<p>And then of course there's the sunrise. As the day grows brighter, the river and the ghats begin to take on a different form. Boats are cruising the Ganga.</p>
<p>If you are a photography lover, then take some snaps of the boat, river, and ghats for yourself and relax for a few minutes. Both are good ways for you to have a lovely morning.</p>

<h2>What Your Day in Varanasi Will Look Like</h2>

<p>The tour starts early, so it is best to get a good night's sleep before the trip. Once you are picked up from your hotel or another agreed location, you will head towards Assi Ghat.</p>

<p><strong>Here is how the day is planned:</strong></p>

<div class="day-plan-section">
    <h3>1. Start With the Sunrise and Subah-e-Banaras</h3>
    <p>Our first destination is <strong>Assi Ghat</strong>, where you’ll attend the morning programs and enjoy by the river Ganga. Just relax and be simply aware. Notice the minute things happening around you.</p>
    <p>Notice the pilgrims sitting peacefully on the bank of the River Ganges and doing yoga and prayer. Do take an opportunity to know more about why the River Ganges is so holy for the people of Varanasi.</p>

    <h3>2. See the Ghats from a Boat</h3>
    <p>After the morning experience, you can enjoy a <strong>boat ride on the Ganga</strong>. Seeing the ghats from the water offers a new perspective of the city.</p>
    <p>You will pass steps to the river and some old buildings along the banks and begin to see people starting their day. This boat journey also provides an opportunity to take a rest and relax while taking in the views without walking.</p>
    <p>If you like taking pictures, click photos of the scene and the environment to capture a memorable moment and keep it as a memory.</p>

    <h3>3. Visit Tulsi Ghat</h3>
    <p><strong>Tulsi Ghat</strong> is another place you will visit during the tour. Situated on the Ganga like the rest of the ghats, it adds to the history of Varanasi' uniqueness and its culture.</p>
    <p>This is also your chance to observe your environment, snap a few pictures where you're allowed, and discover more about this ghat with your local guide. You may also wish to spend a few moments soaking up the river before proceeding to the next point.</p>

    <h3>4. Visit Sankat Mochan Hanuman Temple</h3>
    <p>Your guide will take you to the <strong>Sankat Mochan Hanuman Temple</strong>. It is a popular temple dedicated to Lord Hanuman. And many pilgrims come here for offering prayers.</p>
    <p>Please remember that others could be observing for religious reasons or personal things when you visit. Follow the guidelines, keep an eye on your belongings, and walk with manners around the temple.</p>

    <h3>5. Explore BHU and New Vishwanath Temple</h3>
    <p><strong>Banaras Hindu University (BHU)</strong> is another famous university in Varanasi. Its spacious campus is a sight to behold, and it is also an integral part of the education history of India.</p>
    <p>The <strong>New Vishwanath Temple</strong> is situated at the BHU campus. It is one of the most visited temples by devotees for all time when they visit Varanasi.</p>
    <p>Varanasi is not famous only for its ghats, but it’s beautiful because of its history, temples, markets, people, and educational institutions.</p>

    <h3>6. Pause for Snacks or Shopping</h3>
    <p>Later you can take a rest for some time, and you can have some snacks and can visit local shops &amp; markets.</p>
    <p><strong>You could:</strong></p>
    <ul>
        <li>Stop for a quick snack or drink.</li>
        <li>Bring back a small souvenir.</li>
        <li>Sit down and rest before heading back.</li>
    </ul>
    <p><strong>Food &amp; beverage quick reminder:</strong> Your package does not include breakfast or any other of your meals. Save some of your money for food &amp; drinks.</p>
</div>

<h2>What Is Included in the Tour?</h2>
<p>The idea is to keep the main travel arrangements in one place. <strong>Kashi Ghoomo</strong> lists the following services as part of the package:</p>
<ul>
    <li>Pickup and drop-off from your hotel, airport, or railway station</li>
    <li>Private air-conditioned cab</li>
    <li>Sunrise boat ride on the River Ganga</li>
    <li>Subah-e-Banaras cultural experience</li>
    <li>Walking tour around Assi Ghat</li>
    <li>Visit to Tulsi Ghat</li>
    <li>Visit to Sankat Mochan Hanuman Temple</li>
    <li>Visits to BHU and New Vishwanath Temple</li>
    <li>Local tour guide</li>
    <li>Mineral water bottle</li>
    <li>Parking and toll charges</li>
</ul>

<h2>What Will You Need to Pay For Separately?</h2>
<p>Some expenses are not included in the tour price. You should plan for these on your own:</p>
<ul>
    <li>Breakfast and other meals</li>
    <li>Personal shopping</li>
    <li>Temple donations</li>
    <li>Camera charges, where applicable</li>
    <li>Travel insurance</li>
    <li>Tips for the driver and guide</li>
</ul>
<p><strong>Pricing:</strong> Starting from <strong>₹6,000 per person</strong>. Confirm the final amount, date of travel, pickup point, and any other applicable details before you make a booking.</p>

<h2>A Few Things to Remember Before Leaving Your Hotel</h2>
<p>Getting an early start on the tour means a little bit of planning in advance to help get your morning off to a good start.</p>
<ul>
    <li><strong>Comfy Clothes &amp; Comfortable Shoes:</strong> As we will walk a lot, visiting the Ghat and some temples, we advise you to wear comfortable shoes and appropriate clothes.</li>
    <li><strong>Keep your belongings safe:</strong> When you are out in public, keep your wallet, phone, and small pack safe.</li>
    <li><strong>Clarify the pickup time:</strong> If your tour starts in the early morning or night, ensure you head early. Confirm the hour and place far earlier so you aren't missing it.</li>
    <li><strong>Keep Cash:</strong> Have some cash with you for buying snacks or souvenirs, as there might be some stores that do not accept digital modes of payment.</li>
    <li><strong>Get permission for photography:</strong> There are rules, as everyone is not comfortable. So ask your permission first at the temple or any religious activities.</li>
    <li><strong>Take breaks in your plans:</strong> Traffic, crowds, the rules of the temple, or whatever other circumstances may be necessary for you to spend time at each place. Relax and take the sightseeing tour at a leisurely pace.</li>
</ul>

<h2>Why Take This Tour with Kashi Ghoomo?</h2>
<p>Travel planning and researching transport in a new city, not to mention where to go, can take a while. It can be more difficult when the day begins before sunrise.</p>
<p><strong>Kashi Ghoomo</strong> provides this as a guided tour, which includes transfers, a boat journey, a local guide, and the sites listed in the itinerary, so you can relax without stressing over how to get from one place to another in the morning.</p>
<p>A guide is also good to have, especially if this is your first trip to Varanasi. They can answer questions you have about the places you're going and explain their importance to the city.</p>
<p>This tour could be perfect for first-time visitors, families, couples, or anyone who would like to get a taste of the spiritual Varanasi. Just expect an early morning and some walking.</p>
<p>Before you book, please go through the itinerary to check what is included. If you are travelling with seniors and kids, talk to Kashi Ghoomo. The team will guide and do the arrangements with you.</p>

<h2>Frequently Asked Questions</h2>
<div class="faq-list">
    <div class="faq-item">
        <p><strong>1. What is the highlighted part of the Assi Ghat Sunrise Tour?</strong><br>
        Sunrise and Subah-e-Banaras are the standout features. The boat cruise and temple visits top the list of features for me.</p>
    </div>
    <div class="faq-item">
        <p><strong>2. Is the boat ride included?</strong><br>
        Yes, the boat ride on the River Ganga in the morning has been included in the package.</p>
    </div>
    <div class="faq-item">
        <p><strong>3. What temples will be on the pilgrimage itinerary?</strong><br>
        The tour takes you to Sankat Mochan Hanuman Temple and New Vishwanath Temple, as well as to Tulsi Ghat and Banaras Hindu University.</p>
    </div>
    <div class="faq-item">
        <p><strong>4. Are food and breakfast included?</strong><br>
        No. These are excluded items, so you will need to budget for these individually.</p>
    </div>
    <div class="faq-item">
        <p><strong>5. In which locations will I be picked up?</strong><br>
        The package includes pickup and drop-off from the hotel, airport, and railway station. Please confirm your exact pickup point with the booking team before the tour.</p>
    </div>
</div>

<h2>See Varanasi Before the Day Gets Busy</h2>
<p>The early morning in Varanasi may be a very nice experience. Sitting in the boat, glancing at the ghats, hearing the music at the Assi Ghat, or observing the Ganga as the sun rises, you may enjoy all of them. It is a matter of style for everyone.</p>
<p>With a <strong>Kashi Ghoomo</strong> package, you get to see the ghat and the temples and see how Varanasi appears in the morning hours.</p>
<p><strong>Relax &amp; Recline.</strong> If you want to explore Varanasi, it is certainly the best tour for you. Check our packages, plan your trip, and get ready for your very first sunrise at the Ganga.</p>
HTML;

            $pkgAssi->title = "Assi Ghat Sunrise Tour: The Side of Varanasi You Shouldn't Miss";
            $pkgAssi->slug = "assi-ghat-sunrise-spiritual-walk-experience";
            $pkgAssi->description = $assiDescription;
            $pkgAssi->inclusions = [
                'Pickup and drop-off from your hotel, airport, or railway station',
                'Private air-conditioned cab',
                'Sunrise boat ride on the River Ganga',
                'Subah-e-Banaras cultural experience',
                'Walking tour around Assi Ghat',
                'Visit to Tulsi Ghat',
                'Visit to Sankat Mochan Hanuman Temple',
                'Visits to BHU and New Vishwanath Temple',
                'Local tour guide',
                'Mineral water bottle',
                'Parking and toll charges'
            ];
            $pkgAssi->exclusions = [
                'Breakfast and other meals',
                'Personal shopping',
                'Temple donations',
                'Camera charges, where applicable',
                'Travel insurance',
                'Tips for the driver and guide'
            ];
            $pkgAssi->itinerary = [
                [
                    'day' => 'Step 1',
                    'title' => 'Start With the Sunrise and Subah-e-Banaras',
                    'description' => "Our first destination is Assi Ghat, where you’ll attend the morning programs and enjoy by the river Ganga. Just relax and be simply aware. Notice the minute things happening around you. Notice the pilgrims sitting peacefully on the bank of the River Ganges and doing yoga and prayer. Do take an opportunity to know more about why the River Ganges is so holy for the people of Varanasi."
                ],
                [
                    'day' => 'Step 2',
                    'title' => 'See the Ghats from a Boat',
                    'description' => "After the morning experience, you can enjoy a boat ride on the Ganga. Seeing the ghats from the water offers a new perspective of the city. You will pass steps to the river and some old buildings along the banks and begin to see people starting their day. This boat journey also provides an opportunity to take a rest and relax while taking in the views without walking. If you like taking pictures, click photos of the scene and the environment to capture a memorable moment and keep it as a memory."
                ],
                [
                    'day' => 'Step 3',
                    'title' => 'Visit Tulsi Ghat',
                    'description' => "Tulsi Ghat is another place you will visit during the tour. Situated on the Ganga like the rest of the ghats, it adds to the history of Varanasi' uniqueness and its culture. This is also your chance to observe your environment, snap a few pictures where you're allowed, and discover more about this ghat with your local guide. You may also wish to spend a few moments soaking up the river before proceeding to the next point."
                ],
                [
                    'day' => 'Step 4',
                    'title' => 'Visit Sankat Mochan Hanuman Temple',
                    'description' => "Your guide will take you to the Sankat Mochan Hanuman Temple. It is a popular temple dedicated to Lord Hanuman. And many pilgrims come here for offering prayers. Please remember that others could be observing for religious reasons or personal things when you visit. Follow the guidelines, keep an eye on your belongings, and walk with manners around the temple."
                ],
                [
                    'day' => 'Step 5',
                    'title' => 'Explore BHU and New Vishwanath Temple',
                    'description' => "Banaras Hindu University (BHU) is another famous university in Varanasi. Its spacious campus is a sight to behold, and it is also an integral part of the education history of India. The New Vishwanath Temple is situated at the BHU campus. It is one of the most visited temples by devotees for all time when they visit Varanasi. Varanasi is not famous only for its ghats, but it’s beautiful because of its history, temples, markets, people, and educational institutions."
                ],
                [
                    'day' => 'Step 6',
                    'title' => 'Pause for Snacks or Shopping',
                    'description' => "Later you can take a rest for some time, and you can have some snacks and can visit local shops & markets. Stop for a quick snack or drink, bring back a small souvenir, and sit down and rest before heading back. (Note: Meals are not included in the package)."
                ]
            ];
            $pkgAssi->price = 6000.00;
            $pkgAssi->meta_title = "Assi Ghat Sunrise Tour | The Side of Varanasi You Shouldn't Miss | Kashi Ghoomo";
            $pkgAssi->meta_description = "Experience Assi Ghat Morning with Subah-e-Banaras, Ganga boat ride, Tulsi Ghat, Sankat Mochan Temple, BHU & New Vishwanath Temple with Kashi Ghoomo.";
            $pkgAssi->save();
        }

        // 2. Update Varanasi 2 Days 1 Night Package
        $pkgVns = Package::where('slug', 'varansi-2-days-1-night')->first();
        if ($pkgVns) {
            $vnsDescription = <<<'HTML'
<h1>Banaras Tour Package That Doesn't Rush the One City You Shouldn't Rush</h1>

<p>Two days really isn't much time in a city like Banaras. But honestly, it's enough if the trip's actually planned around what matters instead of trying to see everything at once. If you want to know about what to do and where to go in Banaras, this is the best tour package. With the <strong>Banaras tour package by Kashi Ghoomo</strong>, you will get to visit the highlights of the Aarti, temples, and a small insight into Sarnath without scrapping up your little stay there. It is a very good way to enjoy the city if you have big groups or a stopover.</p>

<h2>Two Days Sounds Too Short for Banaras; Here's Why It Isn't</h2>

<p>People assume Banaras needs a week minimum, and sure, you could spend a week here easily. But a well-planned <strong>Banaras tour package</strong> genuinely captures the heart of the city even in two days.</p>

<ul>
    <li><strong>The Divine Ganga Aarti:</strong> You get the Aarti, one of the most talked-about experiences in the whole city, without needing extra nights just for that.</li>
    <li><strong>The Big Three Temples Darshan:</strong> Temple darshan at the big three — <strong>Kashi Vishwanath, Annapurna, and Kal Bhairav</strong> — all fit comfortably into one morning.</li>
    <li><strong>Historical Sarnath Excursion:</strong> Sarnath's included too, and it's close enough that it doesn't eat into your second day much at all.</li>
    <li><strong>Relaxed &amp; Focused for Families:</strong> For families especially, two focused days beat five unplanned, exhausting ones where everyone's tired by day three anyway.</li>
</ul>

<h2>What's Actually Included in This Banaras Tour Package</h2>

<p>Nothing complicated here, just the stuff that actually matters for a smooth two days:</p>

<ul>
    <li><strong>Airport or Station Pickup and Drop:</strong> So you're not figuring out a cab the second you land.</li>
    <li><strong>One Night's Hotel Stay:</strong> Clean and comfortable stay with breakfast included.</li>
    <li><strong>Evening Boat Ride:</strong> During the Ganga Aarti to observe the rituals from the water rather than being trapped in crowds on the bank.</li>
    <li><strong>Sunrise Boat Ride:</strong> Cruising the ghats the next morning — less busy, much more peaceful, totally different and meditative atmosphere.</li>
    <li><strong>Big Three Temples Darshan:</strong> Darshan at Kashi Vishwanath, Annapurna Devi, and Kal Bhairav.</li>
    <li><strong>Sarnath Visit &amp; Onward Transfer:</strong> Go down to Sarnath and then back on your onward journey.</li>
</ul>

<p>A <strong>Banaras tour package</strong> that takes you places without ever making you feel like you are being taken to places.</p>

<h2>Day One, Day Two: How This Trip Actually Unfolds</h2>

<div class="day-plan-section">
    <h3>Day 1: Arrival &amp; Evening Ganga Aarti Boat Ride</h3>
    <p>On arrival, meet with our representative and transfer to the hotel. Assist you at the hotel and relax. The evening is free for your own activities, and later in the evening you can visit the ghats in front of <strong>Dashashwamedh Ghat</strong> for a boat ride for Aarti. Observing the Aarti from the water rather than being away from the crowd on the banks will make it magical for you.</p>

    <h3>Day 2: Sunrise Cruise, Temple Darshan &amp; Sarnath Excursion</h3>
    <p>Starts early. Another boat ride, this time at <strong>sunrise</strong>, and it's honestly a totally different feeling than the night before — quiet, almost meditative.</p>
    <p>Next, you're headed off to darshan: <strong>Kashi Vishwanath, Annapurna Devi, and Kal Bhairav</strong>, all in succession, so that you're not wasting time shuttling across the city.</p>
    <p>Breakfast, then in <strong>Sarnath</strong>, where Buddha held his first sermon — a pleasant contrast to the hustle and bustle of temple visiting. Then, again, it's to the airport or station for your onward journey.</p>
</div>

<h2>Why a Varanasi Tour Package for Family Needs a Slightly Different Pace</h2>

<p>If you've got kids in tow or an older parent who gets fatigued easily, a typical Banaras tour package designed for single travellers or couples may really be rushing for your group.</p>

<p>A decent <strong>Varanasi tour package for family</strong> should also have some breathing room. Do not stick three temple visits right after a long drive; give people time to sit down and relax a little so they can keep up instead of just rushing through.</p>

<ul>
    <li><strong>Vehicle Selection Matters:</strong> Something like an Ertiga comfortably sits a family of six, but even for 8–10, a Tempo Traveler is better than trying to fit two families into a cramped Innova or something.</li>
    <li><strong>Practical Hotel Selection:</strong> For hotel selection, a Varanasi tour package for family should focus on basic facilities such as breakfast, WiFi, and room service as opposed to getting into the occasional luxury river-view room, which may not really be used any time soon.</li>
</ul>

<h2>What Banaras Has That No Other City Quite Does</h2>

<p>Suresh also makes a list of sights — Ganga Aarti, temples, and Sarnath — but that doesn't really address the question of why people keep returning to this town in particular.</p>

<p>There's nothing like Banaras anywhere in India; it's one of the oldest inhabited cities in the world, and you can really feel it right from the moment you're near the ghats: the temple bells in the mornings, the temples, and the pujaris. It's a kind of constant, we could call it, of the divine, of everything and everywhere.</p>

<p>A <strong>Banaras tour package</strong> isn't check-listing: it's sitting there for that feel, that fire and chanting Aarti, or just sitting peacefully by the ghat with the sun rising. Sarnath offers something else: slower, linked to the history of Buddhism, and a much-needed relief from the frenetic ghats.</p>

<h2>The Benefit of Actually Booking Through Kashi Ghoomo Instead of Winging It</h2>

<p>You could plan this trip yourself, sure. But then you're the one figuring out boat timings, temple queues, and which ghats are actually worth your limited time, all while you're supposed to be relaxing.</p>

<p>Booking a Banaras tour package through <strong>Kashi Ghoomo</strong> means someone's already sorted all that:</p>
<ul>
    <li>A representative meets you the second you land.</li>
    <li>A driver who actually knows the chaos of the city's back lanes.</li>
    <li>Boat rides timed so you're not stuck watching the Aarti from three rows deep in a crowd.</li>
</ul>

<p>Everything — hotel, transport, darshan — gets coordinated before you even arrive, which honestly matters a lot when you've only got two days and don't want to waste half of one just figuring out logistics. For families particularly, that kind of planning means way less stress and a lot more actual time enjoying the trip.</p>

<h2>Tips Worth Knowing Before You Go</h2>

<ul>
    <li><strong>Best Season to Visit:</strong> Come in the cooler months, October through March, if you're able; it's not fun to walk the ghats when it's hot as hell.</li>
    <li><strong>Temple Dress Code:</strong> Cover up at the temples, wear your shoulders and knees covered, and travel with a shawl in case you find yourself between temples and public spaces.</li>
    <li><strong>Keep Cash Handy:</strong> Bring cash; hotels and larger shops accept cards, but most of the small stalls and boat operators near the ghats will want cash.</li>
    <li><strong>Early Sunrise Ride:</strong> Planning to do your morning boat ride early sunrise on the Ganga is truly a peaceful time, and an early start means that you can beat the crowds and the sun.</li>
    <li><strong>Phone &amp; Camera Restrictions:</strong> Some temples, like parts of the Kashi Vishwanath, don't allow phones and cameras inside. So it's good to know this so you'll be prepared when you turn up at the temple.</li>
    <li><strong>Festivals &amp; Rush:</strong> If you arrive here for a festival or other special date, bear in mind there will be longer queues.</li>
</ul>

<h2>What's Not Included, So There's No Confusion Later</h2>

<p>While this Banaras tour package covers the essentials, a few things are genuinely left out and worth budgeting for separately:</p>

<ul>
    <li>Own expenses to certain monuments</li>
    <li>Lunch and dinner (if not decided in advance)</li>
    <li>Shopping or personal expenses</li>
    <li>Tips for driver and guide</li>
    <li>Travel insurance</li>
    <li>Extra boat rides beyond the itinerary</li>
    <li>Toll and parking charges (where applicable)</li>
    <li>Camera charges at specific temples</li>
    <li>Any early check-in and late check-out or time charges</li>
    <li>Offering or pooja expenses</li>
    <li>Any miscellaneous expenses due to weather delay</li>
</ul>

<p>This is not uncommon; many of the Banaras tour package options are like this, but it is better to know upfront and have a clear idea.</p>

<h2>Who This Trip Actually Works Well For</h2>

<p>This isn't just built for one type of traveler; honestly, it flexes pretty well across different groups:</p>

<ul>
    <li><strong>Families with elderly parents:</strong> Paced comfortably with thoughtful assistance.</li>
    <li><strong>Couples:</strong> Wanting a short spiritual getaway together.</li>
    <li><strong>First-time visitors:</strong> Who've never been to Banaras before and want a reliable guide.</li>
    <li><strong>Solo travelers:</strong> Who'd rather have some guided support instead of figuring it out alone.</li>
    <li><strong>Small groups of friends:</strong> Looking for an unforgettable cultural weekend.</li>
    <li><strong>Photography lovers:</strong> People who just want good photos of the ghats from water and shore.</li>
    <li><strong>Pilgrims:</strong> Who don't have much time but still want a proper darshan experience.</li>
</ul>

<p>Whether you're here for the religious significance or just genuinely curious about the city, this Banaras tour package flexes enough to fit most kinds of trips.</p>

<h2>Getting This Trip Booked Takes About Ten Minutes</h2>

<p>You set the wheels in motion by contacting <strong>Kashi Ghoomo</strong>, and from that moment on, the team will expertly guide you to what is included, your dates, and your hotel and boat times, and your booking will be locked in well before you even land in the city.</p>

<p>Payment and confirmation are all done in advance, so you are not left at an airport not knowing if it's all sorted. For a <strong>Varanasi tour package for family</strong> specifically, having this all locked in ahead of time takes a genuine load off, especially if you've got older relatives who need a bit more planning around comfort and pace.</p>

<h2>Where You'll Actually Be Sleeping for the Night</h2>

<p>The hotel picked for this trip isn't just about being close to the ghats for a nice view; comfort matters just as much. Clean rooms, hot water that actually works, breakfast that's genuinely included, nothing complicated.</p>

<p>The location keeps travel time to major sites manageable too, so you're not losing hours of your short two-day trip just commuting back and forth. For families especially, having a reliable place to come back to each evening makes the whole two days feel a lot less exhausting than constantly being on the move.</p>

<h2>Ready to Experience Banaras for Yourself</h2>

<p>Only two days can offer you the glimpse, but the one people rarely read about: the fire of the Aarti reflecting on the water, the dawn breaking from nowhere over the ghats, and ages of devotion still alive and kicking in the day-to-day life of the city.</p>

<p>If you're going on a family holiday, a short pilgrimage, for a short trip, or out for exploring a new land, then <strong>Kashi Ghoomo</strong> can do it all for you. Mention the days you want to go; the rest will be taken care of by us: hotel, transport, and boat rides.</p>

<h2>Frequently Asked Questions (FAQs)</h2>

<div class="faq-list">
    <div class="faq-item">
        <p><strong>1. What is included in this Banaras tour package?</strong><br>
        Hotel stay with breakfast, transfer from airport or train station, evening and morning boat ride, temple darshan, and Sarnath as per plan.</p>
    </div>
    <div class="faq-item">
        <p><strong>2. Can the grandparents join us on this trip?</strong><br>
        Yes, travel is kept light, and with good transportation and a hotel right in the middle of town, it is a good Varanasi tour package for family with elderly relatives.</p>
    </div>
    <div class="faq-item">
        <p><strong>3. Are meals included in this package?</strong><br>
        Just breakfast is included with the hotel reservation. You are free to also book lunch and dinner separately if you wish.</p>
    </div>
    <div class="faq-item">
        <p><strong>4. When Can I Book This Vacation?</strong><br>
        We try to book 2 or 3 weeks ahead whenever possible, particularly in high season or festival time when boats and accommodations fill up fast.</p>
    </div>
    <div class="faq-item">
        <p><strong>5. What if I have to go on a longer trip?</strong><br>
        Yes, this Kashi Ghoomo tour can be customized as well if you wish to upgrade your 2-day, 1-night Banaras tour package to a longer tour.</p>
    </div>
</div>
HTML;

            $pkgVns->title = "Banaras Tour Package That Doesn't Rush the One City You Shouldn't Rush";
            $pkgVns->slug = "varansi-2-days-1-night";
            $pkgVns->description = $vnsDescription;
            $pkgVns->inclusions = [
                'Airport or Railway Station Pickup and Drop',
                "1 Night Hotel Accommodation (Clean & Comfortable)",
                'Daily Complimentary Breakfast',
                'Evening Boat Ride during Ganga Aarti at Dashashwamedh Ghat',
                'Sunrise Morning Boat Ride on River Ganga',
                'Temple Darshan Assistance: Kashi Vishwanath, Annapurna Devi & Kal Bhairav',
                'Excursion to Sarnath with Transfers',
                'Private AC Vehicle for all transfers and local sightseeing',
                '24/7 On-Ground Support by Kashi Ghoomo team'
            ];
            $pkgVns->exclusions = [
                'Own expenses to certain monuments',
                'Lunch and dinner (if not decided in advance)',
                'Shopping or personal expenses',
                'Tips for driver and guide',
                'Travel insurance',
                'Extra boat rides beyond the scheduled itinerary',
                'Camera charges at specific temples',
                'Early check-in and late check-out or time charges',
                'Offering or pooja expenses',
                'Any miscellaneous expenses due to weather delay'
            ];
            $pkgVns->itinerary = [
                [
                    'day' => 'Day 1',
                    'title' => 'Arrival, Hotel Check-in & Evening Ganga Aarti Boat Ride',
                    'description' => "On arrival, meet with our representative and transfer to the hotel. Assist you at the hotel and relax. Evening is free for your own activities, and later in the evening you can visit the ghats and in front of Dashashwamedh Ghat for a boat ride for Aarti. Observing the Aarti from the water rather than being away from the crowd on the banks will make it magical for you."
                ],
                [
                    'day' => 'Day 2',
                    'title' => 'Sunrise Boat Ride, Big Three Temples Darshan & Sarnath',
                    'description' => "Starts early with another boat ride, this time at sunrise — quiet and almost meditative. Next, head off to darshan at Kashi Vishwanath, Annapurna Devi, and Kal Bhairav in succession to save travel time. Enjoy breakfast, then proceed to Sarnath where Buddha held his first sermon. Afterward, transfer to the airport or railway station for your onward journey."
                ]
            ];
            $pkgVns->duration = "2 Days / 1 Night";
            $pkgVns->meta_title = "Banaras Tour Package (2 Days / 1 Night) | Kashi Ghoomo";
            $pkgVns->meta_description = "A well-planned 2 Days / 1 Night Banaras tour package with Ganga Aarti boat ride, sunrise cruise, Kashi Vishwanath darshan & Sarnath without rushing.";
            $pkgVns->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
