<?php

use App\Models\AboutSection;
use App\Models\CourseSection;
use App\Models\LandingSection;
use App\Models\SectionHeader;

/*
|--------------------------------------------------------------------------
| Home Page Builder — Section Catalog
|--------------------------------------------------------------------------
|
| Each entry describes a section that can be picked in the Home Page
| Builder. To add a new section to the catalog, add an entry here —
| no changes to the builder's core logic are required.
|
| type "real"        — backed by an existing CMS model/admin screen.
|                       "is_configured" is derived from whether a row
|                       exists for the current user.
| type "placeholder" — no dedicated CMS screen yet. The builder shows a
|                       "coming soon" step and lets the admin mark it
|                       as configured manually.
|
*/

return [ 
    'landing_section' => [
        'label' => 'Landing Section',
        'description' => 'Single screen, slider or scroll-reveal hero with heading and buttons.',
        'icon' => 'fa-display',
        'type' => 'real',
        'model' => LandingSection::class,
        'admin_route' => 'admin.landing-sections',
    ],
    'about_us' => [
        'label' => 'About Us',
        'description' => 'Badge, heading, description and image about the institution.',
        'icon' => 'fa-circle-info',
        'type' => 'real',
        'model' => AboutSection::class,
        'admin_route' => 'admin.about-section',
    ],
    'why_choose_us' => [
        'label' => 'Why Choose Us',
        'description' => 'Badge, heading and dynamic grid / split / card layout highlighting key differentiators.',
        'icon' => 'fa-star',
        'type' => 'real',
        'model' => SectionHeader::class,
        'admin_route' => 'admin.WhyChooseUs',
    ],
    'courses' => [
        'label' => 'Courses',
        'description' => 'Showcase available courses in a grid, slider or tabs.',
        'icon' => 'fa-book',
        'type' => 'real',
        'model' => CourseSection::class,
        'admin_route' => 'admin.courses',
    ],
    'programs' => [
        'label' => 'Programs',
        'description' => 'List academic programs offered.',
        'icon' => 'fa-graduation-cap',
        'type' => 'placeholder',
    ],
    'admission_process' => [
        'label' => 'Admission Process',
        'description' => 'Step-by-step admission process timeline.',
        'icon' => 'fa-clipboard-check',
        'type' => 'placeholder',
    ],
    'placement' => [
        'label' => 'Placement',
        'description' => 'Placement statistics and highlights.',
        'icon' => 'fa-briefcase',
        'type' => 'placeholder',
    ],
    'faculty' => [
        'label' => 'Faculty',
        'description' => 'Faculty members grid with photos and designations.',
        'icon' => 'fa-chalkboard-user',
        'type' => 'placeholder',
    ],
    'testimonials' => [
        'label' => 'Testimonials',
        'description' => 'Student / parent testimonials in slider, cards, masonry or video layout.',
        'icon' => 'fa-quote-left',
        'type' => 'placeholder',
    ],
    'events' => [
        'label' => 'Events',
        'description' => 'Upcoming and past campus events.',
        'icon' => 'fa-calendar-days',
        'type' => 'placeholder',
    ],
    'gallery' => [
        'label' => 'Gallery',
        'description' => 'Photo gallery in grid, masonry, carousel or full width layout.',
        'icon' => 'fa-images',
        'type' => 'placeholder',
    ],
    'research' => [
        'label' => 'Research',
        'description' => 'Research papers, projects and publications.',
        'icon' => 'fa-flask',
        'type' => 'placeholder',
    ],
    'news' => [
        'label' => 'News',
        'description' => 'Latest news and announcements.',
        'icon' => 'fa-newspaper',
        'type' => 'placeholder',
    ],
    'statistics' => [
        'label' => 'Statistics',
        'description' => 'Animated counters for key numbers.',
        'icon' => 'fa-chart-simple',
        'type' => 'placeholder',
    ],
    'recruiters' => [
        'label' => 'Recruiters',
        'description' => 'Logos of recruiting companies / partners.',
        'icon' => 'fa-building',
        'type' => 'placeholder',
    ],
    'video_section' => [
        'label' => 'Video Section',
        'description' => 'Featured video with optional popup player.',
        'icon' => 'fa-circle-play',
        'type' => 'placeholder',
    ],
    'contact' => [
        'label' => 'Contact',
        'description' => 'Contact form, map and address details.',
        'icon' => 'fa-envelope',
        'type' => 'placeholder',
    ],
    'faq' => [
        'label' => 'FAQ',
        'description' => 'Frequently asked questions accordion.',
        'icon' => 'fa-circle-question',
        'type' => 'placeholder',
    ],
    'footer_cta' => [
        'label' => 'Footer CTA',
        'description' => 'Closing call-to-action banner before the footer.',
        'icon' => 'fa-bullhorn',
        'type' => 'placeholder',
    ],
];
