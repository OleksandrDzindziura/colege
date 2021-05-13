<?php

function thim_get_all_plugins_require($plugins)
{
    return array(
        array(
            'name' => 'WPBakery Page Builder',
            'slug' => 'js_composer',
            'premium' => true,
            'version' => '5.4.5',
            'required'    => false,
            'icon' => THIM_URI . 'assets/images/plugins/js_composer.png',
        ),
        array(
            'name' => 'Slider Revolution',
            'slug' => 'revslider',
            'premium' => true,
            'required'    => false,
            'version' => '5.4.5.1',
        ),
        array(
            'name' => 'SiteOrigin Page Builder',
            'slug' => 'siteorigin-panels',
            'required'    => false,
        ),
        array(
            'name' => 'Elementor Page Builder',
            'slug' => 'elementor',
            'required'    => false,
        ),
        array(
            'name' => 'AnyWhere Elementor',
            'slug' => 'anywhere-elementor',
            'required'    => false,
        ),
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7'
        ),
        array(
            'name'        => 'Easy Forms for MailChimp',
            'slug'        => 'yikes-inc-easy-mailchimp-extender',
            'required'    => false,
            'version'     => '6.4.5',
            'description' => 'Easy Forms for MailChimp allows you to add unlimited MailChimp sign up forms to your WordPress site.',
        ),
        array(
            'name' => 'Instagram Feed',
            'slug' => 'instagram-feed',
            'required'    => false,
        ),
        array(
            'name'        => 'Ivy School Demo Data',
            'slug'        => 'ivy-demo-data',
            'premium' => true,
            'required'    => false,
            'version'     => '1.0',
            'description' => 'Demo data for the theme Ivy School',
        ),
        array(
            'name'        => 'BuilderPress',
            'slug'        => 'builderpress',
            'premium' => true,
            'required'    => true,
            'version'     => '1.0',
            'description' => 'Full of Thim features for page builders: Visual Composer, Site Origin, Elementor',
        ),
        array(
            'name'        => 'LearnPress',
            'slug'        => 'learnpress',
            'required'    => true,
            'version'     => '3.0',
            'description' => 'LearnPress is a WordPress complete solution for creating a Learning Management System (LMS). It can help you to create courses, lessons and quizzes. By ThimPress.',
        ),

        array(
            'name'        => 'LearnPress Certificates',
            'slug'        => 'learnpress-certificates',
            'premium' => true,
            'required'    => false,
            'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-certificates.png',
            'version'     => '3.0',
            'description' => 'An addon for LearnPress plugin to create certificate for a course By ThimPress.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress Collections',
            'slug'        => 'learnpress-collections',
            'premium' => true,
            'required'    => false,
            'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-collections.png',
            'version'     => '3.0',
            'description' => 'Collecting related courses into one collection by administrator By ThimPress.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress - Paid Memberships Pro',
            'slug'        => 'learnpress-paid-membership-pro',
            'premium' => true,
            'required'    => false,
            'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-paid-membership-pro.png',
            'version'     => '3.0',
            'description' => 'Paid Membership Pro add-on for LearnPress By ThimPress.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress Co-Instructors',
            'slug'        => 'learnpress-co-instructor',
            'premium' => true,
            'required'    => false,
            'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-co-instructor.png',
            'version'     => '3.0',
            'description' => 'Building courses with other instructors By ThimPress.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress Course Review',
            'slug'        => 'learnpress-course-review',
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Adding review for course By ThimPress.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress - Coming Soon Courses',
            'slug'        => 'learnpress-coming-soon-courses',
            'premium' => true,
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Set a course is "Coming Soon" and schedule to public',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress Wishlist',
            'slug'        => 'learnpress-wishlist',
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Wishlist feature By ThimPress.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress Instructor Commission',
            'slug'        => 'learnpress-commission',
            'premium' => true,
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Commission add-on for LearnPress.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress Prerequisites Courses',
            'slug'        => 'learnpress-prerequisites-courses',
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Allow you to set prerequisite courses for a certain course in a LearnPress site',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress BuddyPress Integration',
            'slug'        => 'learnpress-buddypress',
            'required'    => false,
            'version'     => '3.0',
            'description' => 'You can view the courses you have taken, finished or wanted to learn inside of wonderful profile page of BuddyPress with LearnPress buddyPress plugin.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress Offline Payment',
            'slug'        => 'learnpress-offline-payment',
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Allow you to manually create order for offline payment instead of paying via any payment gateways to sell course.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress Fill in Blank Question',
            'slug'        => 'learnpress-fill-in-blank',
            'required'    => false,
            'version'     => '3.0',
            'description' => 'It brings fill-in-blank question type feature to your courses quizzes.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress - WooCommerce Payments',
            'slug'        => 'learnpress-woo-payment',
            'premium' => true,
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Using the payment system provided by WooCommerce.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress - Content Drip',
            'slug'        => 'learnpress-content-drip',
            'premium' => true,
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Decide when learners will be able to access the lesson content.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress - Authorize.net Payment',
            'slug'        => 'learnpress-authorizenet-payment',
            'premium' => true,
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Payment Authorize.net for LearnPress.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress - Gradebook',
            'slug'        => 'learnpress-gradebook',
            'premium' => true,
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Adding Course Gradebook for LearnPress.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress - myCred Integration',
            'slug'        => 'learnpress-mycred',
            'premium' => true,
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Running with the point management system - myCred.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress - Randomize Quiz Questions',
            'slug'        => 'learnpress-random-quiz',
            'premium' => true,
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Mix all available questions in a quiz',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress - Stripe Payment',
            'slug'        => 'learnpress-stripe',
            'premium' => true,
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Stripe payment gateway for LearnPress',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress - Sorting Choice Question',
            'slug'        => 'learnpress-sorting-choice',
            'premium' => true,
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Sorting Choice provide ability to sorting the options of a question to the right order',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress - Students List	',
            'slug'        => 'learnpress-students-list',
            //'source'      => 'https://plugins.thimpress.com/downloads/eduma-plugins/learnpress-students-list.zip',
            'premium' => true,
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Get students list by filters.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress bbPress',
            'slug'        => 'learnpress-bbpress',
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Using the forum for courses provided by bbPress By ThimPress.',
            'add-on'      => true,
        ),

        array(
            'name'        => 'LearnPress Export Import',
            'slug'        => 'learnpress-import-export',
            'required'    => false,
            'version'     => '3.0',
            'description' => 'Allow export course, lesson, quiz, question from a LearnPress site to back up or bring to another LearnPress site.',
            'add-on'      => true,
        ),

        array(
            'name'     => 'WooCommerce',
            'slug'     => 'woocommerce',
            'required' => false,
        ),

        array(
            'name'        => 'WP Events Manager',
            'slug'        => 'wp-events-manager',
            'required'    => false,
            'version'     => '2.0.5',
            'description' => 'WP Events Manager is a powerful Events Manager plugin with all of the most important features of an Event Website.',
        ),

        array(
            'name'        => 'WP Events Manager - WooCommerce Payment ',
            'slug'        => 'wp-events-manager-woo-payment',
            'premium' => true,
            'required'    => false,
            'version'     => '2.2',
            'description' => 'Support paying for a booking with the payment methods provided by Woocommerce',
            'add-on'      => true,
        ),

        array(
            'name'        => 'Paid Memberships Pro',
            'slug'        => 'paid-memberships-pro',
            'required'    => false,
            'version'     => '1.9.1',
            'description' => 'A revenue-generating machine for membership sites. Unlimited levels with recurring payment, protected content and member management.',
        ),

    );
}

add_action('thim_core_get_all_plugins_require', 'thim_get_all_plugins_require');

function thim_setup_core_installer_theme_config()
{
    return array(
        'name' => esc_html__('ivy-school', 'ivy-school'),
        'slug' => 'ivy-school',
        'support_link' => 'https://thimpress.com/forums/forum/ivy-school/',
        'installer_uri' => get_template_directory_uri() . '/inc/admin/installer' //Installer directory URI
    );
}

add_filter('thim_core_installer_theme_config', 'thim_setup_core_installer_theme_config');