<?php

// ============================================
// FILE BAHASA: resources/lang/en/db.php
// Deskripsi: Static texts for frontend (English version)
// ============================================

return [

    // =======================
    // General & Header
    // =======================
    'title'           => 'Dashboard',
    'navbar_brand'    => 'LOGOPASCASARJANA',









    
// resources/lang/en/db.php
'leadership' => [
    'section_title' => 'Our Leadership',
    'leaders' => [
        [
            'name' => 'Prof. Eka Srimulyani, MA., Ph.D',
            'position' => 'Director of Postgraduate Program',
            'image' => 'direktur.png',
            'socials' => [
                ['type' => 'instagram', 'link' => '#'],
            ]
        ],
        [
            'name' => 'Prof. Dr. T. Zulfikar, S.Ag., M.Ed',
            'position' => 'Vice Director of Postgraduate Program',
            'image' => 'wakil-direktur.png',
            'socials' => [
                ['type' => 'instagram', 'link' => '#'],
            ]
        ],
        [
            'name' => 'Saifuddin, SE',
            'position' => 'Head of Administration',
            'image' => 'kasubbag.jpg',
            'socials' => [
                ['type' => 'whatsapp', 'link' => '#'],
            ]
        ],
    ]
],


   


'alumni_testimonials' => [
    'section_title' => 'Alumni Words',
    'testimonials' => [
        [
            'quote' => 'Studying at the UIN Ar-Raniry Banda Aceh Postgraduate Program is enjoyable.',
            'name' => 'Alumni of S2 KPI Program (Nurul Aflah S.I.Kom., M.Sos & Arief Fadillah, S.I.Kom,.M.Sos)',
            'program' => 'UIN Ar-Raniry Postgraduate',
        ],
        [
            'quote' => 'Doctoral Program Alumni Graduated with a Maximum GPA of 4.00.',
            'name' => 'Doctoral Program Alumni (DR. SAKDIAH, M.Ag)',
            'program' => 'UIN Ar-Raniry Postgraduate',
        ],
        [
            'quote' => 'The supportive learning environment and expert lecturers made my experience unforgettable.',
            'name' => 'Another Alumnus',
            'program' => 'UIN Ar-Raniry Postgraduate',
        ],
    ]
],

    // resources/lang/en/db.php
'navbar' => [
    'home' => 'Home',
    'profile' => 'Profile',
    'study_programs' => 'Study Programs',
    'academics' => 'Academics',
    'service' => 'Service',
    'research' => 'Research',
    'quality' => 'Quality',
    'news' => 'News',
    'thesis_defense_schedule' => 'Thesis Defense Schedule',
],

    'facilities' => [
    'section_title' => 'VARIOUS SUPPORTING FACILITIES',
    'items' => [
        'Doctoral Classroom',
        'INSPIRASI Stage',
        'INNOVATION CENTER',
        'GUEST HOUSE',
        'Lab/Creation Room',
        'Library',
        'General Academic Room',
        'Podcast Room',
        'Computer Lab',
    ]
],
    // =======================
    // Key Features Section
    // =======================
    'key_features' => [
        'feature1_title' => 'Why Us?',
        'feature1_text'  => 'The Postgraduate Program is one of the flagship programs at UIN Ar-Raniry Banda Aceh.',
        'feature2_title' => 'Campus Life',
        'feature2_text'  => 'Conducting learning in a comfortable atmosphere, a strategic location, and equipped with adequate infrastructure.',
        'feature3_title' => 'Admission',
        'feature3_text'  => 'Come be a part of our "UIN Ar-Raniry Banda Aceh Postgraduate Program".',
    ],

    // =======================
    // Accreditation Levels
    // =======================
    'accreditation_levels' => [
        'excellent'  => 'Excellent',
        'very_good'  => 'Very Good',
        'good'       => 'Good',
        'a'          => 'A',
        'b'          => 'B',
    ],

    // =======================
    // Study Programs (S2 & S3)
    // =======================
    'study_programs' => [
        'section_header'   => 'List of Study Programs',
        'section_title'    => 'Our Study Programs',
        'section_subtitle' => 'Choose the study program you are interested in to determine a bright future.',
        'master_title'     => 'Master\'s Degree',
        'doctor_title'     => 'Doctoral Degree',
        'accreditation'    => 'Accreditation',
        'view_details'     => 'View Details',

        // --- Study Program List ---
        'programs' => [
            // Master's (S2)
           's2_tafsir'      => "Qur’anic and Tafsir Studies [Master's]",
    's2_islamic_studies'    => "Islamic Studies [Master's]",
    's2_islamic_education'  => "Islamic Education [Master's]",
    's2_family_law'         => "Family Law [Master's]",
    's2_islamic_economics'  => "Islamic Economics [Master's]",
    's2_communication'      => "Islamic Communication and Broadcasting [Master's]",
    's2_arabic_education'   => "Arabic Language Education [Master's]",
            // Doctorate (S3)
            's3_islamic_economics' => 'Islamic Economics [Doctoral ]',
            's3_islamic_studies'   => 'Islamic Studies [Doctoral ]',
            's3_islamic_education' => 'Islamic Education [Doctoral ]',
            's3_fiqh'              => 'Modern Fiqh [Doctoral ]',
        ],
    ], // <<< penutup array 'study_programs'

    // =======================
    // Director's Greeting
    // =======================
    'director_greeting' => [
        'title'    => '--A WORD FROM THE DIRECTOR--',
        'intro'    => 'Welcome to the UIN Ar-Raniry Postgraduate Program.',
        'body'     => 'We are committed to nurturing graduates who excel academically, compete globally, and uphold strong ethical and spiritual values. Through impactful research, strategic collaboration, and transformative learning, the Postgraduate Program of UIN Ar-Raniry strives to shape visionary leaders with integrity and purpose.',
        'name'     => 'Prof. Eka Srimulyani, MA., Ph.D',
        'position' => 'Director of Postgraduate Program',
        'slogan'   => 'The Nation\'s Energy, Synergy in Building the Country.',
    ],

    // =======================
    // Vice Director's Greeting
    // =======================
    // 'vice_director_greeting' => [
    //     'title'    => 'FROM THE VICE DIRECTOR',
    //     'intro'    => 'Pushing the Boundaries of Knowledge.',
    //     'body'     => 'We are dedicated to fostering an environment where curiosity thrives and cutting-edge research drives progress. Join us on this transformative journey.',
    //     'name'     => 'Prof. Dr. T. Zulfikar, M.Ed',
    //     'position' => 'Vice Director of Postgraduate Program',
    // ],

    // =======================
    // Carousel Slides Section
    // =======================
    'carousel_slides' => [
        '1' => 'INNOVATIVE',
        '2' => 'NATIONALISTIC',
        '3' => 'EXCELLENT',
        '4' => 'RELIGIOUS',
        '5' => 'RESPONSIVE',
    ], // <<< di sini akhir dari carousel_slides

    // =======================
    // Footer Section
    // =======================
    'footer' => [
        'slogan'         => 'Building the nation with the young generation',

        // --- Profile Menu ---
        'profile_title'  => 'PROFILE',
        'profile_links'  => [
            'History',
            'Vision and Mission',
            'Deanship',
            'Organizational Structure',
            'Professors',
            'Educational Staff',
            'Cooperation',
        ],

        // --- Education Menu ---
        'education_title' => 'EDUCATION',
        'education_links' => [
            'Faculties',
            'Quality Assurance',
            'Students',
        ],

        // --- Information Menu ---
        'info_title' => 'INFORMATION',
        'info_links' => [
            'News',
            'Data Center',
            'Thesis Status',
        ],

        // --- Quick Links Menu ---
        'quick_links_title' => 'QUICK LINKS',
        'quick_links' => [
            'UIN Ar-Raniry',
            'Quality Assurance Cluster',
            'FST Web Dev Team',
        ],

        // --- Copyright ---
        'copyright' => 'Information Technology Dev Team',
    ], // <<< penutup array 'footer'

]; // <<< penutup utama return[]
