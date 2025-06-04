<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction_Type;
use App\Models\Stores_Outlets;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Exception;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create();
        
        User::create([
            "username"=> "admin",
            "email"=> "admin@email.com",
            "password"=> "admin",
        ]);
        
        Profile::create([
            "first_name"=> "Admin Admin",
            "last_name"=> "Admin",
            "contact_number"=> "0123456789",
            "user_id"=> 1,
            "image"=> "images/users/admin.jpg",
        ]);
        
        User::create([
            "username"=> "plsdiepie",
            "email"=> "pls@email.com",
            "password"=> "password",
        ]);
        
        Profile::create([
            "first_name"=> "Felix",
            "last_name"=> "PewDiePie",
            "contact_number"=> "0123456789",
            "user_id"=> 2,
        ]);
        
        User::create([
            "username"=> "viewer",
            "email"=> "viewer@email.com",
            "password"=> "viewer",
        ]);

        Profile::create([
            "first_name"=> "Viewer Viewer",
            "last_name"=> "Viewer",
            "contact_number"=> "0123456789",
            "user_id"=> 3,
        ]);

        Category::create([
            "name"=> "Food",
        ]);

        Category::create([
            "name"=> "Clothing",
        ]);

        Category::create([
            "name"=> "Electronics",
        ]);

        Category::create([
            "name"=> "Furniture",
        ]);

        Category::create([
            "name"=> "Toys",
        ]);

        Category::create([
            "name" => "Health & Wellness",
        ]);

        TransactionStatus::create([
            "name"=> "Pending",
        ]);

        TransactionStatus::create([
            "name"=> "Completed",
        ]);
        
        Product::create([
            "name"=> "KKCRNCH 100",
            "description"=> "KOKO KRUNCH 100g",
            "price"=> 100.50,
            "barcode"=> "1010101010",
            "category_id"=> 1,
            "stock"=> 100,
            "image"=> "images/products/koko.png",
            "sku" => "SKU-1010101010",
        ]);

        Product::create([
            "name"=> "Oreo Cookies",
            "description"=> "Oreo Chocolate Cookies 120g",
            "price"=> 50.00,
            "barcode"=> "1010101011",
            "stock"=> 100,
            "image"=> "images/products/oreo.png",
            "category_id"=> 1,
            "sku" => "SKU-1010101011",
        ]);

        Product::create([
            "name"=> "T-Shirt",
            "description"=> "Cotton T-Shirt",
            "price"=> 200.00,
            "barcode"=> "2020202020",
            "category_id"=> 2,
            "stock"=> 100,
            "image"=> "images/products/shirt.png",
            "sku" => "SKU-2020202020",
        ]);

        Product::create([
            "name"=> "Jeans",
            "description"=> "Denim Jeans",
            "price"=> 500.00,
            "barcode"=> "2020202021",
            "category_id"=> 2,
            "stock"=> 100,
            "image"=> "images/products/jeans.png",
            "sku" => "SKU-2020202021",
        ]);

        Product::create([
            "name"=> "Smartphone",
            "description"=> "Latest Android Smartphone",
            "price"=> 15000.00,
            "barcode"=> "3030303030",
            "category_id"=> 3,
            "stock"=> 100,
            "image"=> "images/products/phone.png",
            "sku" => "SKU-3030303030",
        ]);

        Product::create([
            "name"=> "Laptop",
            "description"=> "High-performance Laptop",
            "price"=> 50000.00,
            "barcode"=> "3030303031",
            "category_id"=> 3,
            "stock"=> 100,
            "image"=> "images/products/laptop.png",
            "sku" => "SKU-3030303031",
        ]);

        Product::create([
            "name"=> "Sofa",
            "description"=> "Comfortable 3-seater Sofa",
            "price"=> 20000.00,
            "barcode"=> "4040404040",
            "category_id"=> 4,
            "stock"=> 100,
            "image"=> "images/products/sofa.png",
            "sku" => "SKU-4040404040",
        ]);

        Product::create([
            "name"=> "Dining Table",
            "description"=> "Wooden Dining Table",
            "price"=> 15000.00,
            "barcode"=> "4040404041",
            "category_id"=> 4,
            "stock"=> 100,
            "image"=> "images/products/table.png",
            "sku" => "SKU-4040404041",
        ]);

        Product::create([
            "name"=> "Action Figure",
            "description"=> "Superhero Action Figure",
            "price"=> 500.00,
            "barcode"=> "5050505050",
            "category_id"=> 5,
            "stock"=> 100,
            "image"=> "images/products/action.png",
            "sku" => "SKU-5050505050",
        ]);

        Product::create([
            "name"=> "Puzzle Game",
            "description"=> "1000-piece Puzzle Game",
            "price"=> 300.00,
            "barcode"=> "5050505051",
            "category_id"=> 5,
            "stock"=> 100,
            "image"=> "images/products/puzzle.png",
            "sku" => "SKU-5050505051",
        ]);
        Product::create([
            "name"=> "Alden Photocard",
            "description"=> "Alden Richards Tongue Out Picture",
            "price"=> 5000000.00,
            "barcode"=> "9999999999",
            "category_id"=> 1,
            "stock"=> 1,
            "image"=> "images/products/admin.jpg",
            "sku" => "SKU-9999999999",
        ]);

        Product::create([
            "name"=> "Wireless Bluetooth Headphones",
            "description"=> "Over-ear headphones with noise cancellation and 30-hour battery life. Immersive audio experience.",
            "price"=> 3500.00,
            "barcode"=> "1000000002",
            "category_id"=> 2,
            "stock"=> 50,
            "image"=> "images/products/headphones_wireless.jpg",
            "sku" => "SKU-1000000002",
        ]);

        Product::create([
            "name"=> "Organic Green Tea Blend (20 Bags)",
            "description"=> "Finest organic green tea leaves, hand-picked for a delicate flavor and natural energy boost.",
            "price"=> 350.00,
            "barcode"=> "1000000003",
            "category_id"=> 3,
            "stock"=> 100,
            "image"=> "images/products/green_tea_organic.jpg",
            "sku" => "SKU-1000000003",
        ]);

        Product::create([
            "name"=> "Stainless Steel Water Bottle (750ml)",
            "description"=> "Durable and insulated water bottle keeps drinks cold for 24 hours or hot for 12 hours.",
            "price"=> 899.00,
            "barcode"=> "1000000004",
            "category_id"=> 4,
            "stock"=> 75,
            "image"=> "images/products/water_bottle_stainless.jpg",
            "sku" => "SKU-1000000004",
        ]);

        Product::create([
            "name"=> "Portable Power Bank (10000mAh)",
            "description"=> "Compact power bank with fast charging capabilities for smartphones and tablets.",
            "price"=> 1500.00,
            "barcode"=> "1000000005",
            "category_id"=> 5,
            "stock"=> 60,
            "image"=> "images/products/power_bank_portable.jpg",
            "sku" => "SKU-1000000005",
        ]);

        Product::create([
            "name"=> "Yoga Mat (Non-Slip, 6mm)",
            "description"=> "High-density, non-slip yoga mat provides excellent cushioning and grip for all exercises.",
            "price"=> 950.00,
            "barcode"=> "1000000006",
            "category_id"=> 5,
            "stock"=> 40,
            "image"=> "images/products/yoga_mat_non_slip.jpg",
            "sku" => "SKU-1000000006",
        ]);

        Product::create([
            "name"=> "Smart LED Desk Lamp",
            "description"=> "Adjustable brightness and color temperature. Control with touch or smartphone app.",
            "price"=> 2200.00,
            "barcode"=> "1000000007",
            "category_id"=> 1,
            "stock"=> 30,
            "image"=> "images/products/desk_lamp_smart.jpg",
            "sku" => "SKU-1000000007",
        ]);

        Product::create([
            "name"=> "Espresso Machine (Compact)",
            "description"=> "Brew rich, aromatic espresso at home with this easy-to-use and compact machine.",
            "price"=> 7800.00,
            "barcode"=> "1000000008",
            "category_id"=> 2,
            "stock"=> 15,
            "image"=> "images/products/espresso_machine_compact.jpg",
            "sku" => "SKU-1000000008",
        ]);

        Product::create([
            "name"=> "Gardening Tool Set (5-Piece)",
            "description"=> "Essential gardening tools made from durable stainless steel, perfect for any gardener.",
            "price"=> 1200.00,
            "barcode"=> "1000000009",
            "category_id"=> 3,
            "stock"=> 35,
            "image"=> "images/products/gardening_tool_set.jpg",
            "sku" => "SKU-1000000009",
        ]);

        Product::create([
            "name"=> "Digital Kitchen Scale",
            "description"=> "Precise digital scale for accurate measurement of ingredients, up to 5kg.",
            "price"=> 650.00,
            "barcode"=> "1000000010",
            "category_id"=> 4,
            "stock"=> 80,
            "image"=> "images/products/kitchen_scale_digital.jpg",
            "sku" => "SKU-1000000010",
        ]);

        Product::create([
            "name"=> "Resistance Bands Set (5 Levels)",
            "description"=> "Versatile resistance bands for full-body workouts, suitable for all fitness levels.",
            "price"=> 700.00,
            "barcode"=> "1000000011",
            "category_id"=> 5,
            "stock"=> 90,
            "image"=> "images/products/resistance_bands_set.jpg",
            "sku" => "SKU-1000000011",
        ]);

        Product::create([
            "name"=> "Aromatherapy Diffuser (Ultrasonic)",
            "description"=> "Quiet ultrasonic diffuser with ambient light, perfect for essential oils and relaxation.",
            "price"=> 1800.00,
            "barcode"=> "1000000012",
            "category_id"=> 6,
            "stock"=> 25,
            "image"=> "images/products/aromatherapy_diffuser.jpg",
            "sku" => "SKU-1000000012",
        ]);

        Product::create([
            "name"=> "Compact Binoculars (8x42)",
            "description"=> "Lightweight and powerful binoculars for bird watching, hiking, and outdoor adventures.",
            "price"=> 4500.00,
            "barcode"=> "1000000013",
            "category_id"=> 1,
            "stock"=> 18,
            "image"=> "images/products/binoculars_compact.jpg",
            "sku" => "SKU-1000000013",
        ]);

        Product::create([
            "name"=> "Reusable Shopping Bags (3-Pack)",
            "description"=> "Eco-friendly, foldable, and durable shopping bags, perfect for groceries and everyday use.",
            "price"=> 280.00,
            "barcode"=> "1000000014",
            "category_id"=> 2,
            "stock"=> 120,
            "image"=> "images/products/shopping_bags_reusable.jpg",
            "sku" => "SKU-1000000014",
        ]);

        Product::create([
            "name"=> "Portable Bluetooth Speaker",
            "description"=> "Water-resistant speaker with rich bass and long-lasting battery, ideal for outdoor use.",
            "price"=> 2999.00,
            "barcode"=> "1000000015",
            "category_id"=> 3,
            "stock"=> 45,
            "image"=> "images/products/bluetooth_speaker_portable.jpg",
            "sku" => "SKU-1000000015",
        ]);

        Product::create([
            "name"=> "Memory Foam Travel Pillow",
            "description"=> "Ergonomic travel pillow provides superior neck support for long flights or road trips.",
            "price"=> 800.00,
            "barcode"=> "1000000016",
            "category_id"=> 4,
            "stock"=> 65,
            "image"=> "images/products/travel_pillow_memory_foam.jpg",
            "sku" => "SKU-1000000016",
        ]);

        Product::create([
            "name"=> "Wireless Charging Pad",
            "description"=> "Sleek and efficient wireless charging pad for Qi-enabled smartphones.",
            "price"=> 1100.00,
            "barcode"=> "1000000017",
            "category_id"=> 5,
            "stock"=> 55,
            "image"=> "images/products/wireless_charging_pad.jpg",
            "sku" => "SKU-1000000017",
        ]);

        Product::create([
            "name"=> "Set of 4 Ceramic Coffee Mugs",
            "description"=> "Stylish and durable ceramic mugs, perfect for daily coffee or tea. Dishwasher safe.",
            "price"=> 750.00,
            "barcode"=> "1000000018",
            "category_id"=> 6,
            "stock"=> 70,
            "image"=> "images/products/coffee_mugs_ceramic_set.jpg",
            "sku" => "SKU-1000000018",
        ]);

        Product::create([
            "name"=> "Indoor Plant Pot (Ceramic, Medium)",
            "description"=> "Elegant ceramic pot for indoor plants, with drainage hole and saucer.",
            "price"=> 550.00,
            "barcode"=> "1000000019",
            "category_id"=> 1,
            "stock"=> 90,
            "image"=> "images/products/plant_pot_ceramic_medium.jpg",
            "sku" => "SKU-1000000019",
        ]);

        Product::create([
            "name"=> "Rechargeable LED Flashlight",
            "description"=> "Bright and durable flashlight with multiple modes and USB rechargeable battery.",
            "price"=> 999.00,
            "barcode"=> "1000000020",
            "category_id"=> 2,
            "stock"=> 40,
            "image"=> "images/products/flashlight_rechargeable_led.jpg",
            "sku" => "SKU-1000000020",
        ]);

        Product::create([
            "name"=> "Digital Art Tablet (Beginner)",
            "description"=> "Entry-level digital art tablet for sketching, drawing, and graphic design.",
            "price"=> 4000.00,
            "barcode"=> "1000000021",
            "category_id"=> 3,
            "stock"=> 20,
            "image"=> "images/products/art_tablet_digital_beginner.jpg",
            "sku" => "SKU-1000000021",
        ]);

        Product::create([
            "name"=> "Foldable Picnic Blanket (Waterproof)",
            "description"=> "Large, waterproof picnic blanket that folds compactly for easy transport.",
            "price"=> 1300.00,
            "barcode"=> "1000000022",
            "category_id"=> 4,
            "stock"=> 30,
            "image"=> "images/products/picnic_blanket_foldable.jpg",
            "sku" => "SKU-1000000022",
        ]);

        Product::create([
            "name"=> "Smart Fitness Tracker Watch",
            "description"=> "Track steps, heart rate, sleep, and more with this feature-rich fitness watch.",
            "price"=> 2700.00,
            "barcode"=> "1000000023",
            "category_id"=> 5,
            "stock"=> 25,
            "image"=> "images/products/fitness_tracker_smart.jpg",
            "sku" => "SKU-1000000023",
        ]);

        Product::create([
            "name"=> "High-Speed HDMI Cable (2 Meters)",
            "description"=> "Premium HDMI cable for 4K Ultra HD, 3D, and Ethernet capabilities.",
            "price"=> 450.00,
            "barcode"=> "1000000024",
            "category_id"=> 6,
            "stock"=> 100,
            "image"=> "images/products/hdmi_cable_high_speed.jpg",
            "sku" => "SKU-1000000024",
        ]);

        Product::create([
            "name"=> "Portable Espresso Maker (Manual)",
            "description"=> "Enjoy fresh espresso on the go with this compact and easy-to-use manual maker.",
            "price"=> 1900.00,
            "barcode"=> "1000000025",
            "category_id"=> 1,
            "stock"=> 30,
            "image"=> "images/products/espresso_maker_portable.jpg",
            "sku" => "SKU-1000000025",
        ]);

        Product::create([
            "name"=> "Noise-Cancelling Earplugs (Reusable)",
            "description"=> "Effective noise reduction for sleeping, studying, or loud environments. Reusable.",
            "price"=> 299.00,
            "barcode"=> "1000000026",
            "category_id"=> 2,
            "stock"=> 150,
            "image"=> "images/products/earplugs_noise_cancelling.jpg",
            "sku" => "SKU-1000000026",
        ]);

        Product::create([
            "name"=> "Gourmet Coffee Beans (250g, Arabica)",
            "description"=> "Premium single-origin Arabica coffee beans, medium roasted for a rich and smooth flavor.",
            "price"=> 600.00,
            "barcode"=> "1000000027",
            "category_id"=> 3,
            "stock"=> 80,
            "image"=> "images/products/coffee_beans_gourmet.jpg",
            "sku" => "SKU-1000000027",
        ]);

        Product::create([
            "name"=> "Collapsible Laundry Basket",
            "description"=> "Space-saving laundry basket that folds flat when not in use.",
            "price"=> 700.00,
            "barcode"=> "1000000028",
            "category_id"=> 4,
            "stock"=> 50,
            "image"=> "images/products/laundry_basket_collapsible.jpg",
            "sku" => "SKU-1000000028",
        ]);

        Product::create([
            "name"=> "Magnetic Phone Mount for Car",
            "description"=> "Strong magnetic mount secures your phone to the car dashboard or air vent.",
            "price"=> 499.00,
            "barcode"=> "1000000029",
            "category_id"=> 5,
            "stock"=> 110,
            "image"=> "images/products/phone_mount_magnetic_car.jpg",
            "sku" => "SKU-1000000029",
        ]);

        Product::create([
            "name"=> "Dumbbell Set (Adjustable, 20kg)",
            "description"=> "Space-saving adjustable dumbbell set, perfect for home workouts and strength training.",
            "price"=> 8500.00,
            "barcode"=> "1000000030",
            "category_id"=> 6,
            "stock"=> 10,
            "image"=> "images/products/dumbbell_set_adjustable.jpg",
            "sku" => "SKU-1000000030",
        ]);

        Product::create([
            "name"=> "Electric Kettle (Stainless Steel)",
            "description"=> "Fast-boiling electric kettle with automatic shut-off and boil-dry protection.",
            "price"=> 1600.00,
            "barcode"=> "1000000031",
            "category_id"=> 1,
            "stock"=> 40,
            "image"=> "images/products/electric_kettle_stainless.jpg",
            "sku" => "SKU-1000000031",
        ]);

        Product::create([
            "name"=> "External Solid State Drive (1TB)",
            "description"=> "Ultra-fast and portable 1TB SSD for quick data transfer and storage.",
            "price"=> 5500.00,
            "barcode"=> "1000000032",
            "category_id"=> 2,
            "stock"=> 20,
            "image"=> "images/products/ssd_external_1tb.jpg",
            "sku" => "SKU-1000000032",
        ]);

        Product::create([
            "name"=> "Set of 3 Scented Candles (Soy Wax)",
            "description"=> "Hand-poured soy wax candles with long-lasting, calming scents. Eco-friendly.",
            "price"=> 900.00,
            "barcode"=> "1000000033",
            "category_id"=> 3,
            "stock"=> 60,
            "image"=> "images/products/scented_candles_soy_set.jpg",
            "sku" => "SKU-1000000033",
        ]);

        Product::create([
            "name"=> "Portable Air Purifier (USB Powered)",
            "description"=> "Compact air purifier for small spaces, removes allergens and odors. USB powered.",
            "price"=> 2100.00,
            "barcode"=> "1000000034",
            "category_id"=> 4,
            "stock"=> 25,
            "image"=> "images/products/air_purifier_portable.jpg",
            "sku" => "SKU-1000000034",
        ]);

        Product::create([
            "name"=> "Jump Rope (Adjustable, Speed)",
            "description"=> "Adjustable speed jump rope with comfortable handles, great for cardio workouts.",
            "price"=> 400.00,
            "barcode"=> "1000000035",
            "category_id"=> 5,
            "stock"=> 100,
            "image"=> "images/products/jump_rope_speed.jpg",
            "sku" => "SKU-1000000035",
        ]);

        Product::create([
            "name"=> "Reusable Food Storage Containers (5-Pack)",
            "description"=> "Airtight and leak-proof glass food storage containers, microwave and oven safe.",
            "price"=> 1400.00,
            "barcode"=> "1000000036",
            "category_id"=> 6,
            "stock"=> 45,
            "image"=> "images/products/food_containers_reusable.jpg",
            "sku" => "SKU-1000000036",
        ]);

        Product::create([
            "name"=> "Smart Home Security Camera",
            "description"=> "Wireless indoor security camera with night vision, motion detection, and two-way audio.",
            "price"=> 3800.00,
            "barcode"=> "1000000037",
            "category_id"=> 1,
            "stock"=> 15,
            "image"=> "images/products/security_camera_smart_home.jpg",
            "sku" => "SKU-1000000037",
        ]);

        Product::create([
            "name"=> "Universal Travel Adapter",
            "description"=> "All-in-one travel adapter with USB ports, compatible with outlets worldwide.",
            "price"=> 950.00,
            "barcode"=> "1000000038",
            "category_id"=> 2,
            "stock"=> 70,
            "image"=> "images/products/travel_adapter_universal.jpg",
            "sku" => "SKU-1000000038",
        ]);

        Product::create([
            "name"=> "Set of 6 Microfiber Cleaning Cloths",
            "description"=> "Highly absorbent and streak-free microfiber cloths for all cleaning tasks.",
            "price"=> 320.00,
            "barcode"=> "1000000039",
            "category_id"=> 3,
            "stock"=> 130,
            "image"=> "images/products/cleaning_cloths_microfiber_set.jpg",
            "sku" => "SKU-1000000039",
        ]);

        Product::create([
            "name"=> "Ergonomic Computer Mouse",
            "description"=> "Wireless ergonomic mouse designed for comfort and precision, reduces wrist strain.",
            "price"=> 1200.00,
            "barcode"=> "1000000040",
            "category_id"=> 4,
            "stock"=> 50,
            "image"=> "images/products/computer_mouse_ergonomic.jpg",
            "sku" => "SKU-1000000040",
        ]);

        Product::create([
            "name"=> "Protein Shaker Bottle (Leak-Proof)",
            "description"=> "Durable and leak-proof protein shaker bottle with mixing ball, 700ml capacity.",
            "price"=> 400.00,
            "barcode"=> "1000000041",
            "category_id"=> 5,
            "stock"=> 90,
            "image"=> "images/products/protein_shaker_bottle.jpg",
            "sku" => "SKU-1000000041",
        ]);

        Product::create([
            "name"=> "Portable Photo Printer (Instant)",
            "description"=> "Print instant photos from your smartphone with this compact and fun portable printer.",
            "price"=> 6500.00,
            "barcode"=> "1000000043",
            "category_id"=> 1,
            "stock"=> 10,
            "image"=> "images/products/photo_printer_portable.jpg",
            "sku" => "SKU-1000000043",
        ]);

        Product::create([
            "name"=> "Weighted Blanket (15 lbs)",
            "description"=> "Therapeutic weighted blanket for anxiety relief and better sleep, 15 pounds.",
            "price"=> 4200.00,
            "barcode"=> "1000000044",
            "category_id"=> 2,
            "stock"=> 18,
            "image"=> "images/products/weighted_blanket_15lbs.jpg",
            "sku" => "SKU-1000000044",
        ]);

        Product::create([
            "name"=> "Collapsible Silicon Food Strainer",
            "description"=> "Space-saving and heat-resistant silicon strainer, collapses for easy storage.",
            "price"=> 600.00,
            "barcode"=> "1000000045",
            "category_id"=> 3,
            "stock"=> 70,
            "image"=> "images/products/food_strainer_silicon_collapsible.jpg",
            "sku" => "SKU-1000000045",
        ]);

        Product::create([
            "name"=> "Mini Projector (HD, Portable)",
            "description"=> "Compact HD projector for home entertainment, compatible with various devices.",
            "price"=> 9800.00,
            "barcode"=> "1000000046",
            "category_id"=> 4,
            "stock"=> 8,
            "image"=> "images/products/mini_projector_hd.jpg",
            "sku" => "SKU-1000000046",
        ]);

        Product::create([
            "name"=> "Foam Roller (Deep Tissue)",
            "description"=> "High-density foam roller for muscle recovery, deep tissue massage, and flexibility.",
            "price"=> 1100.00,
            "barcode"=> "1000000047",
            "category_id"=> 5,
            "stock"=> 35,
            "image"=> "images/products/foam_roller_deep_tissue.jpg",
            "sku" => "SKU-1000000047",
        ]);

        Product::create([
            "name"=> "Smart Power Strip (Wi-Fi Enabled)",
            "description"=> "Control connected devices remotely with this Wi-Fi enabled smart power strip.",
            "price"=> 1700.00,
            "barcode"=> "1000000048",
            "category_id"=> 6,
            "stock"=> 25,
            "image"=> "images/products/power_strip_smart_wifi.jpg",
            "sku" => "SKU-1000000048",
        ]);

        Product::create([
            "name"=> "Portable Humidifier (USB)",
            "description"=> "Mini humidifier for personal use, powered by USB, perfect for desk or travel.",
            "price"=> 850.00,
            "barcode"=> "1000000049",
            "category_id"=> 1,
            "stock"=> 60,
            "image"=> "images/products/humidifier_portable_usb.jpg",
            "sku" => "SKU-1000000049",
        ]);

        Product::create([
            "name"=> "Electric Toothbrush (Rechargeable)",
            "description"=> "Advanced electric toothbrush for superior cleaning and gum health. Rechargeable.",
            "price"=> 2400.00,
            "barcode"=> "1000000050",
            "category_id"=> 2,
            "stock"=> 20,
            "image"=> "images/products/electric_toothbrush_rechargeable.jpg",
            "sku" => "SKU-1000000050",
        ]);

        Product::create([
            "name"=> "Silicone Baking Mat (Non-Stick, Set of 2)",
            "description"=> "Reusable non-stick silicone baking mats for easy baking and cleaning. Set of 2.",
            "price"=> 700.00,
            "barcode"=> "1000000051",
            "category_id"=> 3,
            "stock"=> 80,
            "image"=> "images/products/baking_mat_silicone_set.jpg",
            "sku" => "SKU-1000000051",
        ]);

        Product::create([
            "name"=> "Digital Voice Recorder (8GB)",
            "description"=> "Compact voice recorder with 8GB storage, perfect for lectures, meetings, and interviews.",
            "price"=> 1500.00,
            "barcode"=> "1000000052",
            "category_id"=> 4,
            "stock"=> 30,
            "image"=> "images/products/voice_recorder_digital.jpg",
            "sku" => "SKU-1000000052",
        ]);

        Product::create([
            "name"=> "Wrist Weights (Adjustable, 2kg Pair)",
            "description"=> "Adjustable wrist weights for added resistance during workouts, 2kg pair.",
            "price"=> 900.00,
            "barcode"=> "1000000053",
            "category_id"=> 5,
            "stock"=> 50,
            "image"=> "images/products/wrist_weights_adjustable.jpg",
            "sku" => "SKU-1000000053",
        ]);

        Product::create([
            "name"=> "Manual Coffee Grinder (Ceramic Burr)",
            "description"=> "Portable manual coffee grinder with ceramic burr for consistent grind size.",
            "price"=> 1300.00,
            "barcode"=> "1000000054",
            "category_id"=> 6,
            "stock"=> 40,
            "image"=> "images/products/coffee_grinder_manual.jpg",
            "sku" => "SKU-1000000054",
        ]);

        Product::create([
            "name"=> "USB-C Hub (Multi-Port)",
            "description"=> "Versatile USB-C hub with HDMI, USB 3.0, and SD card slots for laptops.",
            "price"=> 1900.00,
            "barcode"=> "1000000055",
            "category_id"=> 1,
            "stock"=> 30,
            "image"=> "images/products/usb_c_hub_multiport.jpg",
            "sku" => "SKU-1000000055",
        ]);

        Product::create([
            "name"=> "Travel Backpack (Water-Resistant)",
            "description"=> "Spacious and durable water-resistant backpack, ideal for travel and daily commute.",
            "price"=> 3200.00,
            "barcode"=> "1000000056",
            "category_id"=> 2,
            "stock"=> 25,
            "image"=> "images/products/travel_backpack_water_resistant.jpg",
            "sku" => "SKU-1000000056",
        ]);

        Product::create([
            "name"=> "Ceramic Knife Set (3-Piece)",
            "description"=> "Ultra-sharp ceramic knife set for precise cutting, includes paring, utility, and chef knives.",
            "price"=> 2500.00,
            "barcode"=> "1000000057",
            "category_id"=> 3,
            "stock"=> 15,
            "image"=> "images/products/knife_set_ceramic.jpg",
            "sku" => "SKU-1000000057",
        ]);

        Product::create([
            "name"=> "Portable Travel Steamer",
            "description"=> "Compact and powerful garment steamer for wrinkle-free clothes on the go.",
            "price"=> 1600.00,
            "barcode"=> "1000000058",
            "category_id"=> 4,
            "stock"=> 35,
            "image"=> "images/products/travel_steamer_portable.jpg",
            "sku" => "SKU-1000000058",
        ]);

        Product::create([
            "name"=> "Miniature Drone with Camera",
            "description"=> "Easy-to-fly miniature drone with a built-in camera for aerial photos and videos.",
            "price"=> 4500.00,
            "barcode"=> "1000000059",
            "category_id"=> 5,
            "stock"=> 12,
            "image"=> "images/products/mini_drone_camera.jpg",
            "sku" => "SKU-1000000059",
        ]);

        Product::create([
            "name"=> "Desk Organizer (Bamboo)",
            "description"=> "Stylish and eco-friendly bamboo desk organizer to keep your workspace tidy.",
            "price"=> 900.00,
            "barcode"=> "1000000060",
            "category_id"=> 6,
            "stock"=> 50,
            "image"=> "images/products/desk_organizer_bamboo.jpg",
            "sku" => "SKU-1000000060",
        ]);

        Product::create([
            "name"=> "Smart Light Bulbs (Color Changing, 2-Pack)",
            "description"=> "Wi-Fi enabled color-changing LED bulbs, controllable via app or voice assistant. 2-pack.",
            "price"=> 1800.00,
            "barcode"=> "1000000061",
            "category_id"=> 1,
            "stock"=> 40,
            "image"=> "images/products/smart_light_bulbs_color.jpg",
            "sku" => "SKU-1000000061",
        ]);

        Product::create([
            "name"=> "Subscription Box (Mystery Tech Gadgets)",
            "description"=> "Monthly subscription box featuring a curated selection of exciting new tech gadgets.",
            "price"=> 2500.00,
            "barcode"=> "1000000062",
            "category_id"=> 2,
            "stock"=> 10,
            "image"=> "images/products/subscription_box_tech.jpg",
            "sku" => "SKU-1000000062",
        ]);

        Product::create([
            "name"=> "Plant-Based Protein Powder (Vanilla, 500g)",
            "description"=> "Delicious vanilla-flavored plant-based protein powder for muscle recovery and nutrition.",
            "price"=> 1600.00,
            "barcode"=> "1000000063",
            "category_id"=> 3,
            "stock"=> 30,
            "image"=> "images/products/protein_powder_plant_vanilla.jpg",
            "sku" => "SKU-1000000063",
        ]);

        Product::create([
            "name"=> "Pet Grooming Kit (5-in-1)",
            "description"=> "Complete 5-in-1 grooming kit for pets, includes brushes, comb, and nail clippers.",
            "price"=> 1200.00,
            "barcode"=> "1000000064",
            "category_id"=> 4,
            "stock"=> 20,
            "image"=> "images/products/pet_grooming_kit.jpg",
            "sku" => "SKU-1000000064",
        ]);

        Product::create([
            "name"=> "Mini First Aid Kit (Compact)",
            "description"=> "Essential compact first aid kit for home, travel, and outdoor activities.",
            "price"=> 350.00,
            "barcode"=> "1000000065",
            "category_id"=> 5,
            "stock"=> 100,
            "image"=> "images/products/first_aid_kit_mini.jpg",
            "sku" => "SKU-1000000065",
        ]);

        Product::create([
            "name"=> "Silicone Kitchen Utensil Set (Heat-Resistant)",
            "description"=> "Complete set of heat-resistant silicone kitchen utensils, safe for non-stick cookware.",
            "price"=> 1100.00,
            "barcode"=> "1000000066",
            "category_id"=> 6,
            "stock"=> 40,
            "image"=> "images/products/kitchen_utensil_silicone_set.jpg",
            "sku" => "SKU-1000000066",
        ]);

        Product::create([
            "name"=> "Robot Vacuum Cleaner (Smart Navigation)",
            "description"=> "Automated robot vacuum with smart navigation and app control for effortless cleaning.",
            "price"=> 15000.00,
            "barcode"=> "1000000067",
            "category_id"=> 1,
            "stock"=> 5,
            "image"=> "images/products/robot_vacuum_smart.jpg",
            "sku" => "SKU-1000000067",
        ]);

        Product::create([
            "name"=> "Solar-Powered Garden Lights (4-Pack)",
            "description"=> "Durable and energy-efficient solar-powered LED lights for garden pathways or decor. 4-pack.",
            "price"=> 900.00,
            "barcode"=> "1000000068",
            "category_id"=> 2,
            "stock"=> 50,
            "image"=> "images/products/garden_lights_solar_4pack.jpg",
            "sku" => "SKU-1000000068",
        ]);

        Product::create([
            "name"=> "Water Filter Pitcher (BPA-Free)",
            "description"=> "BPA-free water filter pitcher, improves taste and removes impurities from tap water.",
            "price"=> 1300.00,
            "barcode"=> "1000000069",
            "category_id"=> 3,
            "stock"=> 30,
            "image"=> "images/products/water_filter_pitcher.jpg",
            "sku" => "SKU-1000000069",
        ]);

        Product::create([
            "name"=> "Book Stand (Adjustable, Bamboo)",
            "description"=> "Ergonomic adjustable bamboo book stand for reading, cookbooks, or textbooks.",
            "price"=> 750.00,
            "barcode"=> "1000000070",
            "category_id"=> 4,
            "stock"=> 60,
            "image"=> "images/products/book_stand_bamboo_adjustable.jpg",
            "sku" => "SKU-1000000070",
        ]);

        Product::create([
            "name"=> "Exercise Ball (Anti-Burst, 65cm)",
            "description"=> "Durable anti-burst exercise ball for core strength, yoga, and physical therapy.",
            "price"=> 950.00,
            "barcode"=> "1000000071",
            "category_id"=> 5,
            "stock"=> 40,
            "image"=> "images/products/exercise_ball_anti_burst.jpg",
            "sku" => "SKU-1000000071",
        ]);

        Product::create([
            "name"=> "Portable Neck Fan (Rechargeable)",
            "description"=> "Hands-free portable neck fan for personal cooling, ideal for outdoor activities.",
            "price"=> 800.00,
            "barcode"=> "1000000072",
            "category_id"=> 6,
            "stock"=> 70,
            "image"=> "images/products/neck_fan_portable.jpg",
            "sku" => "SKU-1000000072",
        ]);

        Product::create([
            "name"=> "Rechargeable Hand Warmer & Power Bank",
            "description"=> "Dual-function device: a hand warmer for cold days and a portable power bank.",
            "price"=> 1200.00,
            "barcode"=> "1000000073",
            "category_id"=> 1,
            "stock"=> 25,
            "image"=> "images/products/hand_warmer_power_bank.jpg",
            "sku" => "SKU-1000000073",
        ]);

        Product::create([
            "name"=> "Smart Meat Thermometer (Bluetooth)",
            "description"=> "Bluetooth-enabled meat thermometer for perfectly cooked meals, monitor from your phone.",
            "price"=> 2100.00,
            "barcode"=> "1000000074",
            "category_id"=> 2,
            "stock"=> 15,
            "image"=> "images/products/meat_thermometer_smart.jpg",
            "sku" => "SKU-1000000074",
        ]);

        Product::create([
            "name"=> "Reusable Beeswax Food Wraps (Set of 3)",
            "description"=> "Eco-friendly alternative to plastic wrap, keeps food fresh naturally. Set of 3.",
            "price"=> 500.00,
            "barcode"=> "1000000075",
            "category_id"=> 3,
            "stock"=> 90,
            "image"=> "images/products/beeswax_wraps_reusable.jpg",
            "sku" => "SKU-1000000075",
        ]);

        Product::create([
            "name"=> "Universal Tablet Stand (Adjustable)",
            "description"=> "Sturdy and adjustable stand for tablets of all sizes, perfect for hands-free viewing.",
            "price"=> 650.00,
            "barcode"=> "1000000076",
            "category_id"=> 4,
            "stock"=> 80,
            "image"=> "images/products/tablet_stand_universal.jpg",
            "sku" => "SKU-1000000076",
        ]);

        Product::create([
            "name"=> "Silicone Reusable Straws (6-Pack with Brush)",
            "description"=> "Flexible and eco-friendly silicone straws, with cleaning brush and carrying pouch. 6-pack.",
            "price"=> 300.00,
            "barcode"=> "1000000077",
            "category_id"=> 5,
            "stock"=> 120,
            "image"=> "images/products/silicone_straws_reusable.jpg",
            "sku" => "SKU-1000000077",
        ]);

        Product::create([
            "name"=> "Entry-Level DSLR Camera Kit",
            "description"=> "Perfect for beginners, this DSLR camera kit includes a versatile zoom lens.",
            "price"=> 28000.00,
            "barcode"=> "1000000078",
            "category_id"=> 6,
            "stock"=> 5,
            "image"=> "images/products/dslr_camera_kit_beginner.jpg",
            "sku" => "SKU-1000000078",
        ]);

        Product::create([
            "name"=> "Noise Machine (White Noise, 20 Sounds)",
            "description"=> "Sleep aid and relaxation device with 20 soothing white noise and nature sounds.",
            "price"=> 1400.00,
            "barcode"=> "1000000079",
            "category_id"=> 1,
            "stock"=> 30,
            "image"=> "images/products/noise_machine_white_noise.jpg",
            "sku" => "SKU-1000000079",
        ]);

        Product::create([
            "name"=> "Portable Clothes Dryer (Electric)",
            "description"=> "Compact electric clothes dryer, ideal for small apartments or delicate items.",
            "price"=> 7000.00,
            "barcode"=> "1000000080",
            "category_id"=> 2,
            "stock"=> 10,
            "image"=> "images/products/clothes_dryer_portable.jpg",
            "sku" => "SKU-1000000080",
        ]);

        Product::create([
            "name"=> "Herb Garden Starter Kit (Indoor)",
            "description"=> "Grow your own fresh herbs indoors with this complete starter kit. Includes seeds and pots.",
            "price"=> 900.00,
            "barcode"=> "1000000081",
            "category_id"=> 3,
            "stock"=> 40,
            "image"=> "images/products/herb_garden_starter_kit_indoor.jpg",
            "sku" => "SKU-1000000081",
        ]);

        Product::create([
            "name"=> "Ergonomic Keyboard (Split Design)",
            "description"=> "Split ergonomic keyboard designed to reduce wrist strain and promote natural typing posture.",
            "price"=> 3000.00,
            "barcode"=> "1000000082",
            "category_id"=> 4,
            "stock"=> 20,
            "image"=> "images/products/keyboard_ergonomic_split.jpg",
            "sku" => "SKU-1000000082",
        ]);

        Product::create([
            "name"=> "Adjustable Laptop Stand (Aluminum)",
            "description"=> "Sturdy aluminum laptop stand with adjustable height and angle for improved ergonomics.",
            "price"=> 1500.00,
            "barcode"=> "1000000083",
            "category_id"=> 5,
            "stock"=> 35,
            "image"=> "images/products/laptop_stand_adjustable.jpg",
            "sku" => "SKU-1000000083",
        ]);

        Product::create([
            "name"=> "Digital Photo Frame (10-inch, Wi-Fi)",
            "description"=> "Share photos instantly with family and friends using this Wi-Fi enabled digital photo frame.",
            "price"=> 4500.00,
            "barcode"=> "1000000084",
            "category_id"=> 6,
            "stock"=> 15,
            "image"=> "images/products/digital_photo_frame_wifi.jpg",
            "sku" => "SKU-1000000084",
        ]);

        Product::create([
            "name"=> "Smart Reusable Notebook (Erasable)",
            "description"=> "Eco-friendly reusable notebook. Write, scan, and erase your notes. Cloud compatible.",
            "price"=> 1000.00,
            "barcode"=> "1000000085",
            "category_id"=> 1,
            "stock"=> 50,
            "image"=> "images/products/smart_notebook_erasable.jpg",
            "sku" => "SKU-1000000085",
        ]);

        Product::create([
            "name"=> "Portable Air Compressor (Car Tire Inflator)",
            "description"=> "Compact and powerful air compressor for inflating car tires, bikes, and sports equipment.",
            "price"=> 2200.00,
            "barcode"=> "1000000086",
            "category_id"=> 2,
            "stock"=> 25,
            "image"=> "images/products/air_compressor_portable.jpg",
            "sku" => "SKU-1000000086",
        ]);

        Product::create([
            "name"=> "LED Strip Lights (Dimmable, 5M)",
            "description"=> "Flexible and dimmable LED strip lights with remote control, perfect for accent lighting. 5 meters.",
            "price"=> 800.00,
            "barcode"=> "1000000087",
            "category_id"=> 3,
            "stock"=> 60,
            "image"=> "images/products/led_strip_lights_dimmable.jpg",
            "sku" => "SKU-1000000087",
        ]);

        Product::create([
            "name"=> "Stainless Steel Lunch Box (Leak-Proof)",
            "description"=> "Durable and leak-proof stainless steel lunch box with multiple compartments.",
            "price"=> 1100.00,
            "barcode"=> "1000000088",
            "category_id"=> 4,
            "stock"=> 40,
            "image"=> "images/products/lunch_box_stainless_leakproof.jpg",
            "sku" => "SKU-1000000088",
        ]);

        Product::create([
            "name"=> "Wireless Doorbell Camera (Smart)",
            "description"=> "Smart wireless doorbell camera with two-way talk, motion detection, and cloud storage.",
            "price"=> 4000.00,
            "barcode"=> "1000000089",
            "category_id"=> 5,
            "stock"=> 10,
            "image"=> "images/products/doorbell_camera_wireless_smart.jpg",
            "sku" => "SKU-1000000089",
        ]);

        Product::create([
            "name"=> "Professional Chef's Knife (8-inch)",
            "description"=> "High-carbon stainless steel chef's knife for professional-grade cutting and slicing.",
            "price"=> 2800.00,
            "barcode"=> "1000000090",
            "category_id"=> 6,
            "stock"=> 18,
            "image"=> "images/products/chefs_knife_professional.jpg",
            "sku" => "SKU-1000000090",
        ]);

        Stores_Outlets::create([
            "name"=> "Store 1",
            "address"=> "123 Main St, City, Country",
            "contact_number"=> "0123456789",
        ]);

        Stores_Outlets::create([
            "name"=> "Store 2",
            "address"=> "456 Elm St, City, Country",
            "contact_number"=> "9876543210",
        ]);

        Transaction_Type::create([
            "name"=> "Inbound",
        ]);

        Transaction_Type::create([
            "name"=> "Outbound",
        ]);

        $permissions = [
            'create user',
            'index users',
            'view user',
            'update user',
            'delete user',
            'create store',
            'index stores',
            'view store',
            'update store',
            'delete store',
            'create category',
            'index categories',
            'view category',
            'update category',
            'delete category',
            'index transaction_types',
            'view transaction_type',
            'create product',
            'index products',
            'view product',
            'update product',
            'delete product',
            'create transaction',
            'index transactions',
            'view transaction',
            'update transaction',
            'delete transaction',
            'create variance report',
            'index variance reports',
            'view variance report',
            'update variance report',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $moderator = Role::create(['name' => 'moderator']);
        $moderator->givePermissionTo(Permission::all()->filter(function ($permission) {
            return !in_array($permission->name, ['create user', 'delete user', 'update user']);
        }));

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(Permission::all()->filter(function ($permission) {
            return !in_array($permission->name, ['create user', 'index users', 'delete user', 'create store', 'delete store', 'update store', 'create category', 'delete category', 'update category', 'create product', 'delete product', 'update product', 'create variance report', 'delete variance report', 'update variance report']);
        }));
        
        $viewer = Role::create(['name' => 'viewer']);

        $viewer->givePermissionTo(Permission::where(function ($query) {
            $query->where('name', 'not like', '%user%')
                  ->where('name', 'not like', '%user');
        })->where(function ($query) {
            $query->where('name', 'like', 'view%')
                  ->orWhere('name', 'like', 'index%');
        })->get());

        $adminUser = User::where('username', 'admin')->first();
        $adminUser->assignRole('admin');

        $moderatorUser = User::where('username', 'plsdiepie')->first();
        $moderatorUser->assignRole('moderator');

        $viewerUser = User::where('username', 'viewer')->first();
        $viewerUser->assignRole('viewer');

        Transaction::factory()->count(1000)->create();
    }
}
