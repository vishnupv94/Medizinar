<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Handles Kerala district location pages at /location/{district}
 * Each page targets "[service] in [district]" local search queries.
 */
class LocationController extends Controller
{
    /** @var array<string, array<string, mixed>> */
    private array $districts = [
        'kollam' => [
            'name'      => 'Kollam',
            'title'     => 'Home Care Services in Kollam, Kerala — Medizinar Care',
            'metaDesc'  => 'Professional home care services in Kollam, Kerala. Medizinar Care provides bedside patient care, elderly care, mother & baby care, and home maid services in Kollam and Kottarakkara.',
            'heroTitle' => 'Home Care Services in Kollam',
            'heroDesc'  => 'Compassionate and reliable home care services across Kollam district, Kerala — from Kottarakkara to Punalur and Kundara.',
            'intro'     => 'Medizinar Care is based in Kottarakkara and serves families across Kollam district with professional home healthcare services. Whether you need a bedside caregiver, elderly care, postnatal support, or a home maid, we arrange verified and compassionate caregivers across Kollam.',
            'localities'=> ['Kottarakkara', 'Punalur', 'Kundara', 'Karunagappally', 'Paravur', 'Chavara', 'Sasthamcotta', 'Veliyam', 'Anchal', 'Pathanapuram'],
            'distance'  => 'Primary base — fastest response',
            'priority'  => '1.0',
        ],
        'thiruvananthapuram' => [
            'name'      => 'Thiruvananthapuram',
            'title'     => 'Home Care Services in Thiruvananthapuram, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Thiruvananthapuram, Kerala. Medizinar Care provides bedside patient care, elderly care, mother & baby care, and domestic support in Trivandrum and nearby areas.',
            'heroTitle' => 'Home Care Services in Thiruvananthapuram',
            'heroDesc'  => 'Reliable and compassionate home healthcare across Thiruvananthapuram (Trivandrum) district — verified caregivers for patients, elderly, and families.',
            'intro'     => 'Medizinar Care extends its home care services to families in Thiruvananthapuram district. Our trained caregivers provide bedside patient care, elderly care, postnatal support, and domestic assistance across the Trivandrum area.',
            'localities'=> ['Thiruvananthapuram', 'Neyyattinkara', 'Nedumangad', 'Attingal', 'Varkala', 'Chirayinkeezhu', 'Kazhakoottam'],
            'distance'  => 'Approx. 60–80 km from base',
            'priority'  => '0.8',
        ],
        'pathanamthitta' => [
            'name'      => 'Pathanamthitta',
            'title'     => 'Home Care Services in Pathanamthitta, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Pathanamthitta, Kerala. Medizinar Care provides bedside patient care, elderly care, NRI parent care, and mother & baby care in Pathanamthitta and nearby areas.',
            'heroTitle' => 'Home Care Services in Pathanamthitta',
            'heroDesc'  => 'Compassionate home healthcare across Pathanamthitta district — trusted caregivers for patients, senior citizens, and families.',
            'intro'     => 'Medizinar Care serves families in Pathanamthitta district with professional home care services. Being close to Kottarakkara, we can arrange caregivers across Pathanamthitta quickly and reliably.',
            'localities'=> ['Pathanamthitta', 'Tiruvalla', 'Adoor', 'Ranni', 'Konni', 'Pandalam', 'Kozhencherry'],
            'distance'  => 'Approx. 30–60 km from base',
            'priority'  => '0.9',
        ],
        'alappuzha' => [
            'name'      => 'Alappuzha',
            'title'     => 'Home Care Services in Alappuzha, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Alappuzha (Alleppey), Kerala. Medizinar Care provides bedside patient care, elderly care, and postnatal care in Alappuzha and surrounding areas.',
            'heroTitle' => 'Home Care Services in Alappuzha',
            'heroDesc'  => 'Professional home care across Alappuzha district — bedside patient care, elderly support, and postnatal care for families in Alleppey and nearby areas.',
            'intro'     => 'Medizinar Care provides home care services to families in Alappuzha (Alleppey) district. Our caregivers are trained, verified, and matched to your specific care needs.',
            'localities'=> ['Alappuzha', 'Chengannur', 'Mavelikara', 'Kuttanad', 'Harippad', 'Kayamkulam', 'Ambalapuzha'],
            'distance'  => 'Approx. 50–80 km from base',
            'priority'  => '0.8',
        ],
        'kottayam' => [
            'name'      => 'Kottayam',
            'title'     => 'Home Care Services in Kottayam, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Kottayam, Kerala. Medizinar Care provides bedside patient care, elderly care, mother & baby care, and domestic support across Kottayam district.',
            'heroTitle' => 'Home Care Services in Kottayam',
            'heroDesc'  => 'Reliable and compassionate home care services across Kottayam district — trusted for bedside patient care, elderly support, and postnatal care.',
            'intro'     => 'Medizinar Care extends its professional home care services to Kottayam district. Our verified caregivers are experienced in patient care, elderly support, and postnatal assistance.',
            'localities'=> ['Kottayam', 'Changanacherry', 'Pala', 'Ettumanoor', 'Vaikom', 'Erattupetta', 'Kanjirappally'],
            'distance'  => 'Approx. 60–90 km from base',
            'priority'  => '0.8',
        ],
        'ernakulam' => [
            'name'      => 'Ernakulam',
            'title'     => 'Home Care Services in Ernakulam, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Ernakulam (Kochi), Kerala. Medizinar Care provides bedside patient care, elderly care, and home maid services in Ernakulam, Kochi and nearby areas.',
            'heroTitle' => 'Home Care Services in Ernakulam',
            'heroDesc'  => 'Professional home healthcare in Ernakulam and Kochi — trained caregivers for patients, elderly, and families across Ernakulam district.',
            'intro'     => 'Medizinar Care provides home care services to families in Ernakulam and Kochi. Whether you need a bedside caregiver, elderly care, or home maid, we match you with a verified, experienced professional.',
            'localities'=> ['Kochi', 'Ernakulam', 'Aluva', 'Perumbavoor', 'Muvattupuzha', 'Thrippunithura', 'Angamaly'],
            'distance'  => 'Approx. 100–130 km from base',
            'priority'  => '0.7',
        ],
        'idukki' => [
            'name'      => 'Idukki',
            'title'     => 'Home Care Services in Idukki, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Idukki district, Kerala. Medizinar Care provides bedside patient care, elderly care, and domestic support across Idukki.',
            'heroTitle' => 'Home Care Services in Idukki',
            'heroDesc'  => 'Compassionate home care across Idukki district — patient care, elderly support, and domestic assistance for families.',
            'intro'     => 'Medizinar Care provides professional home care services to families in Idukki district. Our trained caregivers cover bedside patient care, elderly care, and household support.',
            'localities'=> ['Thodupuzha', 'Munnar', 'Kattappana', 'Devikulam', 'Udumbanchola', 'Peerumade'],
            'distance'  => 'Approx. 80–120 km from base',
            'priority'  => '0.6',
        ],
        'thrissur' => [
            'name'      => 'Thrissur',
            'title'     => 'Home Care Services in Thrissur, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Thrissur, Kerala. Medizinar Care provides bedside patient care, elderly care, and postnatal care in Thrissur and nearby areas.',
            'heroTitle' => 'Home Care Services in Thrissur',
            'heroDesc'  => 'Professional home healthcare services in Thrissur district — compassionate caregivers for patients, elderly, and families.',
            'intro'     => 'Medizinar Care extends its home care services to families in Thrissur district. We provide trained and verified caregivers for patient care, elderly support, and postnatal assistance.',
            'localities'=> ['Thrissur', 'Chalakudy', 'Irinjalakuda', 'Kodungallur', 'Guruvayur', 'Kunnamkulam'],
            'distance'  => 'Approx. 130–160 km from base',
            'priority'  => '0.6',
        ],
        'palakkad' => [
            'name'      => 'Palakkad',
            'title'     => 'Home Care Services in Palakkad, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Palakkad, Kerala. Medizinar Care provides bedside patient care, elderly care, and domestic support in Palakkad district.',
            'heroTitle' => 'Home Care Services in Palakkad',
            'heroDesc'  => 'Reliable home healthcare in Palakkad district — trained caregivers for patients, elderly, and families.',
            'intro'     => 'Medizinar Care provides professional home care services to families in Palakkad district, including bedside patient care, elderly support, and domestic assistance.',
            'localities'=> ['Palakkad', 'Ottapalam', 'Shoranur', 'Mannarkkad', 'Alathur', 'Chittur'],
            'distance'  => 'Approx. 150–180 km from base',
            'priority'  => '0.6',
        ],
        'malappuram' => [
            'name'      => 'Malappuram',
            'title'     => 'Home Care Services in Malappuram, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Malappuram, Kerala. Medizinar Care provides bedside patient care, elderly care, NRI parent care, and domestic support in Malappuram.',
            'heroTitle' => 'Home Care Services in Malappuram',
            'heroDesc'  => 'Compassionate home healthcare in Malappuram district — verified caregivers for patients, senior citizens, and NRI families.',
            'intro'     => 'Medizinar Care provides home care services to families in Malappuram district. Our caregivers are trained, verified, and matched to your specific care needs.',
            'localities'=> ['Malappuram', 'Tirur', 'Manjeri', 'Perinthalmanna', 'Nilambur', 'Kondotty'],
            'distance'  => 'Approx. 180–220 km from base',
            'priority'  => '0.6',
        ],
        'kozhikode' => [
            'name'      => 'Kozhikode',
            'title'     => 'Home Care Services in Kozhikode, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Kozhikode (Calicut), Kerala. Medizinar Care provides bedside patient care, elderly care, and postnatal care in Kozhikode and nearby areas.',
            'heroTitle' => 'Home Care Services in Kozhikode',
            'heroDesc'  => 'Professional home care services in Kozhikode (Calicut) district — trained and compassionate caregivers for patients and families.',
            'intro'     => 'Medizinar Care serves families in Kozhikode (Calicut) with professional home care. Our trained caregivers provide bedside patient care, elderly support, and postnatal assistance.',
            'localities'=> ['Kozhikode', 'Vadakara', 'Koyilandy', 'Feroke', 'Ramanattukara', 'Mukkam'],
            'distance'  => 'Approx. 220–260 km from base',
            'priority'  => '0.5',
        ],
        'wayanad' => [
            'name'      => 'Wayanad',
            'title'     => 'Home Care Services in Wayanad, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Wayanad, Kerala. Medizinar Care provides bedside patient care, elderly care, and domestic support across Wayanad district.',
            'heroTitle' => 'Home Care Services in Wayanad',
            'heroDesc'  => 'Compassionate home healthcare in Wayanad district — trained caregivers for patients, elderly, and families.',
            'intro'     => 'Medizinar Care extends home care services to families in Wayanad district. Our caregivers provide patient care, elderly support, and domestic assistance.',
            'localities'=> ['Kalpetta', 'Sulthan Bathery', 'Mananthavady', 'Vythiri', 'Panamaram'],
            'distance'  => 'Approx. 250–300 km from base',
            'priority'  => '0.5',
        ],
        'kannur' => [
            'name'      => 'Kannur',
            'title'     => 'Home Care Services in Kannur, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Kannur, Kerala. Medizinar Care provides bedside patient care, elderly care, and NRI parent care across Kannur district.',
            'heroTitle' => 'Home Care Services in Kannur',
            'heroDesc'  => 'Professional home healthcare in Kannur district — trusted caregivers for patients, elderly, and NRI families.',
            'intro'     => 'Medizinar Care provides professional home care services to families in Kannur district. Our trained caregivers are experienced in patient care, elderly support, and postnatal assistance.',
            'localities'=> ['Kannur', 'Thalassery', 'Payyanur', 'Iritty', 'Koothuparamba', 'Mattannur'],
            'distance'  => 'Approx. 280–320 km from base',
            'priority'  => '0.5',
        ],
        'kasaragod' => [
            'name'      => 'Kasaragod',
            'title'     => 'Home Care Services in Kasaragod, Kerala — Medizinar Care',
            'metaDesc'  => 'Home care services in Kasaragod, Kerala. Medizinar Care provides bedside patient care, elderly care, and domestic support across Kasaragod district.',
            'heroTitle' => 'Home Care Services in Kasaragod',
            'heroDesc'  => 'Reliable home care in Kasaragod district — compassionate caregivers for patients, elderly, and families across northern Kerala.',
            'intro'     => 'Medizinar Care extends home care services to families in Kasaragod district. Contact us to arrange a trained and verified caregiver based on your family\'s specific needs.',
            'localities'=> ['Kasaragod', 'Kanhangad', 'Manjeshwar', 'Nileshwar', 'Vorkady'],
            'distance'  => 'Approx. 330–380 km from base',
            'priority'  => '0.5',
        ],
    ];

    public function show(string $district): void
    {
        if (!isset($this->districts[$district])) {
            http_response_code(404);
            if (file_exists(APP_PATH . '/Views/pages/404.php')) {
                require APP_PATH . '/Views/pages/404.php';
            } else {
                echo '<h1>404 — Page Not Found</h1>';
            }
            return;
        }

        $d = $this->districts[$district];

        $jsonLd = [
            '@context'   => 'https://schema.org',
            '@type'      => ['MedicalBusiness', 'LocalBusiness'],
            'name'       => SITE_NAME . ' — ' . $d['name'],
            'description'=> $d['metaDesc'],
            'url'        => SITE_URL . '/location/' . $district,
            'telephone'  => '+91' . PHONE,
            'email'      => EMAIL,
            'areaServed' => [
                ['@type' => 'AdministrativeArea', 'name' => $d['name'] . ' District, Kerala'],
                ...array_map(fn($loc) => ['@type' => 'City', 'name' => $loc . ', Kerala'], $d['localities']),
            ],
            'address' => [
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Kottarakkara',
                'addressRegion'   => 'Kerala',
                'postalCode'      => '691532',
                'addressCountry'  => 'IN',
            ],
            'geo' => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => '8.9905',
                'longitude' => '76.7795',
            ],
        ];

        $this->view('location-single', [
            'page'      => 'location',
            'pageTitle' => $d['title'],
            'metaDesc'  => $d['metaDesc'],
            'jsonLd'    => $jsonLd,
            'district'  => $d,
            'slug'      => $district,
        ]);
    }

    /**
     * Returns all districts for sitemap generation.
     * @return array<string, array<string, mixed>>
     */
    public static function allDistricts(): array
    {
        return (new self())->districts;
    }
}
