<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Handles individual service landing pages at /services/{slug}
 * Each page has unique meta, schema, and content for SEO ranking.
 */
class ServiceController extends Controller
{
    /** @var array<string, array<string, mixed>> */
    private array $services = [
        'bedside-patient-care' => [
            'title'        => 'Bedside Patient Care at Home in Kerala',
            'h1'           => 'Bedside Patient Care',
            'metaDesc'     => 'Professional bedside patient care at home in Kerala. Medizinar Care provides trained caregivers for post-surgery recovery, illness support, and long-term patient care in Kottarakkara, Kollam.',
            'badge'        => 'Home Healthcare',
            'heroDesc'     => 'Professional in-home support for patients recovering from illness, surgery, or long-term health conditions — delivered with compassion in the comfort of your home.',
            'schemaName'   => 'Bedside Patient Care',
            'schemaDesc'   => 'Professional bedside care for patients at home in Kerala, covering post-surgery recovery, illness support, and long-term personal care.',
            'intro'        => [
                'what' => 'What is Bedside Patient Care?',
                'body' => 'Bedside patient care is professional, one-on-one caregiving provided to patients at home. A trained caregiver attends to the patient\'s daily personal care needs — hygiene, mobility, medication reminders, and comfort — so they can recover safely in a familiar environment rather than a hospital setting.',
            ],
            'features'     => [
                'Personal hygiene assistance (bathing, grooming)',
                'Patient positioning and mobility support',
                'Medication reminders',
                'Assistance with daily activities (eating, dressing)',
                'Wound care observation and comfort monitoring',
                'Companionship and emotional support',
                'Coordination with family members',
            ],
            'ideal_for'    => 'Post-surgical patients, stroke recovery, accident recovery, bedridden patients, chronic illness patients',
            'faqs'         => [
                ['q' => 'What does a bedside caregiver do?', 'a' => 'A bedside caregiver assists patients with daily personal care including bathing, grooming, mobility, medication reminders, and companionship throughout the day or night.'],
                ['q' => 'Is bedside care available 24 hours?', 'a' => 'Yes. Medizinar Care provides full-time, part-time, daytime, and night-shift bedside care depending on your family\'s requirement.'],
                ['q' => 'Do I need a doctor\'s referral for home bedside care?', 'a' => 'No referral is needed. You can contact us directly and we will arrange a verified caregiver based on the patient\'s specific care needs.'],
                ['q' => 'How quickly can you arrange a bedside caregiver in Kottarakkara or Kollam?', 'a' => 'We typically arrange a suitable caregiver within 24–48 hours of enquiry, depending on availability in your area.'],
            ],
            'serviceParam' => 'bedside',
            'color'        => 'green',
        ],
        'elderly-care' => [
            'title'        => 'Elderly Care at Home in Kerala — Medizinar Care',
            'h1'           => 'Elderly Care at Home',
            'metaDesc'     => 'Compassionate elderly care at home in Kerala. Medizinar Care provides trained senior care assistants for daily living, mobility, companionship and safety in Kottarakkara, Kollam and across Kerala.',
            'badge'        => 'Senior Care',
            'heroDesc'     => 'Dedicated and respectful care services for senior citizens — ensuring dignity, comfort, and meaningful companionship in the familiar environment of their home.',
            'schemaName'   => 'Elderly Home Care',
            'schemaDesc'   => 'Home-based elderly care in Kerala providing daily living assistance, mobility support, companionship, and safety monitoring for senior citizens.',
            'intro'        => [
                'what' => 'What is Elderly Home Care?',
                'body' => 'Elderly home care is a service where a trained caregiver visits or stays with senior citizens at home to assist with daily living activities. It is designed for older adults who need help with mobility, personal hygiene, meals, or who need companionship and safety supervision — without having to move to a care facility.',
            ],
            'features'     => [
                'Assistance with daily living activities (ADL)',
                'Walking and mobility support',
                'Personal hygiene and grooming assistance',
                'Meal support and feeding assistance',
                'Emotional companionship',
                'Safety monitoring and fall prevention',
                'Regular health observation and family updates',
            ],
            'ideal_for'    => 'Senior citizens living alone, elderly with mobility issues, parents of NRI families, post-hospitalisation elderly recovery',
            'faqs'         => [
                ['q' => 'What is included in elderly home care?', 'a' => 'Our elderly care includes daily living assistance, mobility support, personal hygiene, meal assistance, companionship, safety monitoring, and regular updates to the family.'],
                ['q' => 'Can you arrange care for my elderly parents while I am abroad?', 'a' => 'Yes. We provide NRI Parent Care specifically for families abroad. Our caregivers visit regularly, and we provide updates to you remotely.'],
                ['q' => 'Are your elderly caregivers trained?', 'a' => 'Yes. All Medizinar Care caregivers undergo a background check and selection process before being placed with a family.'],
                ['q' => 'Is elderly care available across Kerala?', 'a' => 'We primarily serve Kottarakkara, Kollam, and surrounding districts. Contact us to confirm availability in your area.'],
            ],
            'serviceParam' => 'elderly',
            'color'        => 'gold',
        ],
        'mother-baby-care' => [
            'title'        => 'Mother & Baby Care at Home in Kerala — Medizinar Care',
            'h1'           => 'Mother & Baby Care',
            'metaDesc'     => 'Experienced postnatal mother and baby care at home in Kerala. Medizinar Care provides trained ayah and care assistants for newborn care, mother recovery, and baby hygiene in Kottarakkara, Kollam.',
            'badge'        => 'Postnatal Care',
            'heroDesc'     => 'Compassionate postnatal support for new mothers and newborns during the important recovery period — experienced care assistants in the comfort of your home.',
            'schemaName'   => 'Mother and Baby Home Care',
            'schemaDesc'   => 'Postnatal home care in Kerala for new mothers and newborns, covering baby hygiene, newborn routine care, feeding assistance, and mother recovery support.',
            'intro'        => [
                'what' => 'What is Mother & Baby Care at Home?',
                'body' => 'Mother and baby home care (also known as postnatal care or ayah service) provides a trained care assistant to support new mothers and newborns at home during the weeks following childbirth. The assistant helps with newborn hygiene, baby routines, feeding support, and mother\'s recovery — giving the family peace of mind during this important period.',
            ],
            'features'     => [
                'Newborn bathing and hygiene care',
                'Baby feeding assistance and routine guidance',
                'Mother recovery support and personal care',
                'Newborn comfort and sleep routine assistance',
                'Family support and care guidance',
                'Baby laundry and basic household help',
                'Monitoring baby health and alerting the family',
            ],
            'ideal_for'    => 'New mothers post-delivery, families with newborns, mothers recovering from C-section, first-time parents needing guidance',
            'faqs'         => [
                ['q' => 'What does a mother and baby care assistant do?', 'a' => 'She assists with newborn bathing, feeding support, baby routines, mother\'s personal care during recovery, and general household support related to the baby.'],
                ['q' => 'How soon after delivery can I arrange a care assistant?', 'a' => 'You can arrange the care assistant before the expected delivery date. We recommend booking 1–2 weeks in advance to ensure availability.'],
                ['q' => 'Is this service available for C-section recovery?', 'a' => 'Yes. Our care assistants are experienced in supporting mothers recovering from both normal and C-section deliveries.'],
                ['q' => 'How long is the mother and baby care service provided?', 'a' => 'The duration is flexible — most families arrange 30 to 90 days of postnatal care. We customise based on your requirement.'],
            ],
            'serviceParam' => 'mother-baby',
            'color'        => 'green',
        ],
        'home-maid-services' => [
            'title'        => 'Home Maid Services in Kerala — Medizinar Care',
            'h1'           => 'Home Maid Services',
            'metaDesc'     => 'Trusted home maid services in Kerala. Medizinar Care provides verified domestic staff for house cleaning, cooking, laundry, and household organisation in Kottarakkara, Kollam and nearby areas.',
            'badge'        => 'Domestic Support',
            'heroDesc'     => 'Reliable domestic assistance for households needing support with daily tasks — verified, responsible, and professional home helpers across Kerala.',
            'schemaName'   => 'Home Maid Services',
            'schemaDesc'   => 'Trusted home maid and domestic support services in Kerala including house cleaning, cooking, laundry, and daily household tasks.',
            'intro'        => [
                'what' => 'What are Home Maid Services?',
                'body' => 'Home maid services provide trained and verified domestic staff who assist with daily household tasks such as cleaning, cooking, laundry, and general home organisation. Medizinar Care carefully selects and verifies all domestic staff before placement, giving families reliable and trustworthy in-home support.',
            ],
            'features'     => [
                'Daily house cleaning and mopping',
                'Cooking and meal preparation assistance',
                'Laundry and clothes management',
                'Household organisation and tidying',
                'Dishwashing and kitchen assistance',
                'Grocery and household errand support',
                'General household maintenance assistance',
            ],
            'ideal_for'    => 'Working families, households with elderly members, families with young children, post-operative household support',
            'faqs'         => [
                ['q' => 'Are your home maids background-verified?', 'a' => 'Yes. All domestic staff placed by Medizinar Care go through our background check and selection process before being sent to a family.'],
                ['q' => 'Can I get a part-time home maid?', 'a' => 'Yes. We offer both full-time (live-in or daily) and part-time maid services based on your household needs.'],
                ['q' => 'What tasks does the home maid assist with?', 'a' => 'Typical tasks include house cleaning, cooking, laundry, dishwashing, and general household organisation. Specific duties are agreed upon at the time of placement.'],
                ['q' => 'Where do you provide home maid services?', 'a' => 'We primarily serve Kottarakkara, Kollam, and the surrounding districts in Kerala. Contact us to check availability in your area.'],
            ],
            'serviceParam' => 'housemaid',
            'color'        => 'gold',
        ],
        'nri-parent-care' => [
            'title'        => 'NRI Parent Care Service in Kerala — Medizinar Care',
            'h1'           => 'NRI Parent Care',
            'metaDesc'     => 'Trusted NRI parent care service in Kerala. Medizinar Care provides regular home visits, well-being checks, and status updates for elderly parents of NRI families in Kottarakkara, Kollam and across Kerala.',
            'badge'        => 'NRI Family Service',
            'heroDesc'     => 'Dedicated care and regular well-being monitoring for the parents of NRI families — so you can have peace of mind, no matter where in the world you are.',
            'schemaName'   => 'NRI Parent Care',
            'schemaDesc'   => 'Home-based parent care service for NRI families in Kerala — regular home visits, well-being checks, and remote status updates for elderly parents.',
            'intro'        => [
                'what' => 'What is NRI Parent Care?',
                'body' => 'NRI Parent Care is a dedicated service for Indians living abroad (NRIs) who have elderly parents in Kerala. Medizinar Care arranges regular home visits, well-being assessments, medication monitoring, and provides updates to the family abroad — ensuring that parents are safe, healthy, and cared for while the family is away.',
            ],
            'features'     => [
                'Regular scheduled home visits',
                'Parent well-being assessment and monitoring',
                'Medication schedule checks',
                'Health status updates to NRI family members',
                'Emergency assistance coordination',
                'Hospital accompaniment when needed',
                'Grocery and household errand assistance',
            ],
            'ideal_for'    => 'NRI families with elderly parents in Kerala, working professionals abroad, families seeking peace of mind for parents living alone',
            'faqs'         => [
                ['q' => 'How does NRI Parent Care work?', 'a' => 'We arrange scheduled visits to your parents\' home in Kerala. After each visit, we provide a well-being update to you via phone or WhatsApp, covering health, daily activities, and any concerns.'],
                ['q' => 'How often are home visits made?', 'a' => 'Visit frequency is customisable — weekly, bi-weekly, or daily depending on your parents\' needs and your preference.'],
                ['q' => 'Can you accompany my parents to hospital appointments?', 'a' => 'Yes. Hospital visit accompaniment is part of our Quick Support Services and can be arranged alongside NRI Parent Care visits.'],
                ['q' => 'What areas in Kerala do you cover for NRI Parent Care?', 'a' => 'We primarily serve Kottarakkara, Kollam district, and nearby areas. Contact us to confirm coverage for your parents\' location.'],
            ],
            'serviceParam' => 'nri',
            'color'        => 'green',
        ],
        'quick-support' => [
            'title'        => 'Quick Support Care Services in Kerala — Medizinar Care',
            'h1'           => 'Quick Support Services',
            'metaDesc'     => 'Short-term and on-demand quick support care in Kerala. Medizinar Care provides hospital visit companions, elderly day support, and night care on a daily service charge basis in Kottarakkara, Kollam.',
            'badge'        => 'Short-Term Support',
            'heroDesc'     => 'Flexible, short-duration care and support services for temporary needs — hospital visits, daytime support, and night care — available on a daily service charge basis.',
            'schemaName'   => 'Quick Support Care Services',
            'schemaDesc'   => 'Short-term home care and quick support services in Kerala including hospital companion, elderly day support, and overnight care on a daily charge basis.',
            'intro'        => [
                'what' => 'What are Quick Support Services?',
                'body' => 'Quick Support Services are designed for short-duration care needs — situations where you need a trained caregiver for a few hours, a single day, or a specific event such as a hospital visit. These services are provided on a daily service charge basis, making them ideal for emergency care, temporary gaps in family support, or one-off caregiving needs.',
            ],
            'features'     => [
                'Hospital visit companion and patient assistance',
                'Elderly day support (4–8 hours)',
                'Night care and patient monitoring',
                'Emergency short-notice care',
                'Post-discharge home support (short-term)',
                'Temporary caregiver cover',
                'One-time well-being visits',
            ],
            'ideal_for'    => 'Hospital outpatient visits, temporary care gaps, post-discharge short support, emergency caregiving, trial care before committing to full-time service',
            'faqs'         => [
                ['q' => 'What is a quick support service?', 'a' => 'Quick Support is short-duration care — available for a few hours, a day, or a specific event like a hospital visit. It is billed on a daily service charge basis.'],
                ['q' => 'Can I book a caregiver for just one day?', 'a' => 'Yes. Our quick support services are available on a daily basis with no long-term commitment required.'],
                ['q' => 'Is there a minimum duration for quick support?', 'a' => 'Minimum duration is typically 4 hours for daytime support. Contact us to discuss your specific requirement.'],
                ['q' => 'Can I use quick support while my regular caregiver is unavailable?', 'a' => 'Absolutely. Quick support is ideal as a temporary replacement or gap-fill when your regular caregiver is unavailable.'],
            ],
            'serviceParam' => 'quick-support',
            'color'        => 'gold',
        ],
    ];

    public function show(string $slug): void
    {
        if (!isset($this->services[$slug])) {
            http_response_code(404);
            if (file_exists(APP_PATH . '/Views/pages/404.php')) {
                require APP_PATH . '/Views/pages/404.php';
            } else {
                echo '<h1>404 — Page Not Found</h1>';
            }
            return;
        }

        $s = $this->services[$slug];

        $jsonLd = [
            '@context'    => 'https://schema.org',
            '@type'       => 'MedicalTherapy',
            'name'        => $s['schemaName'],
            'description' => $s['schemaDesc'],
            'url'         => SITE_URL . '/services/' . $slug,
            'provider'    => [
                '@type'     => 'MedicalBusiness',
                'name'      => SITE_NAME,
                'url'       => SITE_URL,
                'telephone' => '+91' . PHONE,
                'address'   => [
                    '@type'           => 'PostalAddress',
                    'addressLocality' => 'Kottarakkara',
                    'addressRegion'   => 'Kerala',
                    'addressCountry'  => 'IN',
                ],
                'areaServed' => [
                    ['@type' => 'State', 'name' => 'Kerala'],
                    ['@type' => 'City',  'name' => 'Kottarakkara'],
                    ['@type' => 'City',  'name' => 'Kollam'],
                ],
            ],
        ];

        $faqJsonLd = null;
        if (!empty($s['faqs'])) {
            $faqJsonLd = [
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => array_map(fn($f) => [
                    '@type'          => 'Question',
                    'name'           => $f['q'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
                ], $s['faqs']),
            ];
        }

        $this->view('service-single', [
            'page'      => 'services',
            'pageTitle' => $s['title'],
            'metaDesc'  => $s['metaDesc'],
            'jsonLd'    => $jsonLd,
            'faqJsonLd' => $faqJsonLd,
            'service'   => $s,
            'slug'      => $slug,
        ]);
    }
}
