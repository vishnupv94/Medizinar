-- ============================================================
--  Migration 005: Services & Locations
--  Run this ONCE on the production database.
--  Safe to re-run: all statements use IF NOT EXISTS / INSERT IGNORE.
-- ============================================================

-- ----------------------------------------------------------
-- services
-- ----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `services` (
    `id`           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `slug`         VARCHAR(100)  NOT NULL UNIQUE,
    `title`        VARCHAR(255)  NOT NULL,
    `h1`           VARCHAR(255)  NOT NULL,
    `meta_desc`    VARCHAR(320)  NOT NULL DEFAULT '',
    `badge`        VARCHAR(60)   NOT NULL DEFAULT '',
    `hero_desc`    TEXT          NOT NULL,
    `schema_name`  VARCHAR(255)  NOT NULL DEFAULT '',
    `schema_desc`  TEXT          NOT NULL,
    `intro_what`   VARCHAR(255)  NOT NULL DEFAULT '',
    `intro_body`   TEXT          NOT NULL,
    `ideal_for`    TEXT          NOT NULL,
    `features`     JSON          NOT NULL,
    `service_param` VARCHAR(60)  NOT NULL DEFAULT '',
    `color`        ENUM('green','gold') NOT NULL DEFAULT 'green',
    `sort_order`   INT           NOT NULL DEFAULT 0,
    `status`       ENUM('draft','published') NOT NULL DEFAULT 'published',
    `created_at`   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status_sort` (`status`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------
-- service_faqs  (child of services, 1-service : many-faqs)
-- ----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `service_faqs` (
    `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `service_id` INT UNSIGNED  NOT NULL,
    `question`   TEXT          NOT NULL,
    `answer`     TEXT          NOT NULL,
    `sort_order` INT           NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_sfaq_service`
        FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE CASCADE,
    INDEX `idx_sfaq_service_sort` (`service_id`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------
-- locations
-- ----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `locations` (
    `id`               INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `slug`             VARCHAR(100)  NOT NULL UNIQUE,
    `name`             VARCHAR(100)  NOT NULL,
    `title`            VARCHAR(255)  NOT NULL,
    `meta_desc`        VARCHAR(320)  NOT NULL DEFAULT '',
    `hero_title`       VARCHAR(255)  NOT NULL,
    `hero_desc`        TEXT          NOT NULL,
    `intro`            TEXT          NOT NULL,
    `distance`         VARCHAR(100)  NOT NULL DEFAULT '',
    `sitemap_priority` DECIMAL(3,1)  NOT NULL DEFAULT 0.7,
    `localities`       JSON          NOT NULL,
    `sort_order`       INT           NOT NULL DEFAULT 0,
    `status`           ENUM('draft','published') NOT NULL DEFAULT 'published',
    `created_at`       TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`       TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_loc_status_sort` (`status`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ==============================================================
-- SEED DATA  — INSERT IGNORE so re-running never duplicates rows
-- ==============================================================

-- ---- services -----------------------------------------------
INSERT IGNORE INTO `services`
    (`slug`,`title`,`h1`,`meta_desc`,`badge`,`hero_desc`,`schema_name`,`schema_desc`,`intro_what`,`intro_body`,`ideal_for`,`features`,`service_param`,`color`,`sort_order`,`status`)
VALUES
('bedside-patient-care',
 'Bedside Patient Care at Home in Kerala',
 'Bedside Patient Care',
 'Professional bedside patient care at home in Kerala. Medizinar Care provides trained caregivers for post-surgery recovery, illness support, and long-term patient care in Kottarakkara, Kollam.',
 'Home Healthcare',
 'Professional in-home support for patients recovering from illness, surgery, or long-term health conditions — delivered with compassion in the comfort of your home.',
 'Bedside Patient Care',
 'Professional bedside care for patients at home in Kerala, covering post-surgery recovery, illness support, and long-term personal care.',
 'What is Bedside Patient Care?',
 'Bedside patient care is professional, one-on-one caregiving provided to patients at home. A trained caregiver attends to the patient''s daily personal care needs — hygiene, mobility, medication reminders, and comfort — so they can recover safely in a familiar environment rather than a hospital setting.',
 'Post-surgical patients, stroke recovery, accident recovery, bedridden patients, chronic illness patients',
 '["Personal hygiene assistance (bathing, grooming)","Patient positioning and mobility support","Medication reminders","Assistance with daily activities (eating, dressing)","Wound care observation and comfort monitoring","Companionship and emotional support","Coordination with family members"]',
 'bedside','green',1,'published'),

('elderly-care',
 'Elderly Care at Home in Kerala — Medizinar Care',
 'Elderly Care at Home',
 'Compassionate elderly care at home in Kerala. Medizinar Care provides trained senior care assistants for daily living, mobility, companionship and safety in Kottarakkara, Kollam and across Kerala.',
 'Senior Care',
 'Dedicated and respectful care services for senior citizens — ensuring dignity, comfort, and meaningful companionship in the familiar environment of their home.',
 'Elderly Home Care',
 'Home-based elderly care in Kerala providing daily living assistance, mobility support, companionship, and safety monitoring for senior citizens.',
 'What is Elderly Home Care?',
 'Elderly home care is a service where a trained caregiver visits or stays with senior citizens at home to assist with daily living activities. It is designed for older adults who need help with mobility, personal hygiene, meals, or who need companionship and safety supervision — without having to move to a care facility.',
 'Senior citizens living alone, elderly with mobility issues, parents of NRI families, post-hospitalisation elderly recovery',
 '["Assistance with daily living activities (ADL)","Walking and mobility support","Personal hygiene and grooming assistance","Meal support and feeding assistance","Emotional companionship","Safety monitoring and fall prevention","Regular health observation and family updates"]',
 'elderly','gold',2,'published'),

('mother-baby-care',
 'Mother & Baby Care at Home in Kerala — Medizinar Care',
 'Mother & Baby Care',
 'Experienced postnatal mother and baby care at home in Kerala. Medizinar Care provides trained ayah and care assistants for newborn care, mother recovery, and baby hygiene in Kottarakkara, Kollam.',
 'Postnatal Care',
 'Compassionate postnatal support for new mothers and newborns during the important recovery period — experienced care assistants in the comfort of your home.',
 'Mother and Baby Home Care',
 'Postnatal home care in Kerala for new mothers and newborns, covering baby hygiene, newborn routine care, feeding assistance, and mother recovery support.',
 'What is Mother & Baby Care at Home?',
 'Mother and baby home care (also known as postnatal care or ayah service) provides a trained care assistant to support new mothers and newborns at home during the weeks following childbirth. The assistant helps with newborn hygiene, baby routines, feeding support, and mother''s recovery — giving the family peace of mind during this important period.',
 'New mothers post-delivery, families with newborns, mothers recovering from C-section, first-time parents needing guidance',
 '["Newborn bathing and hygiene care","Baby feeding assistance and routine guidance","Mother recovery support and personal care","Newborn comfort and sleep routine assistance","Family support and care guidance","Baby laundry and basic household help","Monitoring baby health and alerting the family"]',
 'mother-baby','green',3,'published'),

('home-maid-services',
 'Home Maid Services in Kerala — Medizinar Care',
 'Home Maid Services',
 'Trusted home maid services in Kerala. Medizinar Care provides verified domestic staff for house cleaning, cooking, laundry, and household organisation in Kottarakkara, Kollam and nearby areas.',
 'Domestic Support',
 'Reliable domestic assistance for households needing support with daily tasks — verified, responsible, and professional home helpers across Kerala.',
 'Home Maid Services',
 'Trusted home maid and domestic support services in Kerala including house cleaning, cooking, laundry, and daily household tasks.',
 'What are Home Maid Services?',
 'Home maid services provide trained and verified domestic staff who assist with daily household tasks such as cleaning, cooking, laundry, and general home organisation. Medizinar Care carefully selects and verifies all domestic staff before placement, giving families reliable and trustworthy in-home support.',
 'Working families, households with elderly members, families with young children, post-operative household support',
 '["Daily house cleaning and mopping","Cooking and meal preparation assistance","Laundry and clothes management","Household organisation and tidying","Dishwashing and kitchen assistance","Grocery and household errand support","General household maintenance assistance"]',
 'housemaid','gold',4,'published'),

('nri-parent-care',
 'NRI Parent Care Service in Kerala — Medizinar Care',
 'NRI Parent Care',
 'Trusted NRI parent care service in Kerala. Medizinar Care provides regular home visits, well-being checks, and status updates for elderly parents of NRI families in Kottarakkara, Kollam and across Kerala.',
 'NRI Family Service',
 'Dedicated care and regular well-being monitoring for the parents of NRI families — so you can have peace of mind, no matter where in the world you are.',
 'NRI Parent Care',
 'Home-based parent care service for NRI families in Kerala — regular home visits, well-being checks, and remote status updates for elderly parents.',
 'What is NRI Parent Care?',
 'NRI Parent Care is a dedicated service for Indians living abroad (NRIs) who have elderly parents in Kerala. Medizinar Care arranges regular home visits, well-being assessments, medication monitoring, and provides updates to the family abroad — ensuring that parents are safe, healthy, and cared for while the family is away.',
 'NRI families with elderly parents in Kerala, working professionals abroad, families seeking peace of mind for parents living alone',
 '["Regular scheduled home visits","Parent well-being assessment and monitoring","Medication schedule checks","Health status updates to NRI family members","Emergency assistance coordination","Hospital accompaniment when needed","Grocery and household errand assistance"]',
 'nri','green',5,'published'),

('quick-support',
 'Quick Support Care Services in Kerala — Medizinar Care',
 'Quick Support Services',
 'Short-term and on-demand quick support care in Kerala. Medizinar Care provides hospital visit companions, elderly day support, and night care on a daily service charge basis in Kottarakkara, Kollam.',
 'Short-Term Support',
 'Flexible, short-duration care and support services for temporary needs — hospital visits, daytime support, and night care — available on a daily service charge basis.',
 'Quick Support Care Services',
 'Short-term home care and quick support services in Kerala including hospital companion, elderly day support, and overnight care on a daily charge basis.',
 'What are Quick Support Services?',
 'Quick Support Services are designed for short-duration care needs — situations where you need a trained caregiver for a few hours, a single day, or a specific event such as a hospital visit. These services are provided on a daily service charge basis, making them ideal for emergency care, temporary gaps in family support, or one-off caregiving needs.',
 'Hospital outpatient visits, temporary care gaps, post-discharge short support, emergency caregiving, trial care before committing to full-time service',
 '["Hospital visit companion and patient assistance","Elderly day support (4–8 hours)","Night care and patient monitoring","Emergency short-notice care","Post-discharge home support (short-term)","Temporary caregiver cover","One-time well-being visits"]',
 'quick-support','gold',6,'published');

-- ---- service_faqs -------------------------------------------
INSERT IGNORE INTO `service_faqs` (`service_id`,`question`,`answer`,`sort_order`) VALUES
-- bedside
((SELECT id FROM services WHERE slug='bedside-patient-care'),'What does a bedside caregiver do?','A bedside caregiver assists patients with daily personal care including bathing, grooming, mobility, medication reminders, and companionship throughout the day or night.',1),
((SELECT id FROM services WHERE slug='bedside-patient-care'),'Is bedside care available 24 hours?','Yes. Medizinar Care provides full-time, part-time, daytime, and night-shift bedside care depending on your family''s requirement.',2),
((SELECT id FROM services WHERE slug='bedside-patient-care'),'Do I need a doctor''s referral for home bedside care?','No referral is needed. You can contact us directly and we will arrange a verified caregiver based on the patient''s specific care needs.',3),
((SELECT id FROM services WHERE slug='bedside-patient-care'),'How quickly can you arrange a bedside caregiver in Kottarakkara or Kollam?','We typically arrange a suitable caregiver within 24–48 hours of enquiry, depending on availability in your area.',4),
-- elderly
((SELECT id FROM services WHERE slug='elderly-care'),'What is included in elderly home care?','Our elderly care includes daily living assistance, mobility support, personal hygiene, meal assistance, companionship, safety monitoring, and regular updates to the family.',1),
((SELECT id FROM services WHERE slug='elderly-care'),'Can you arrange care for my elderly parents while I am abroad?','Yes. We provide NRI Parent Care specifically for families abroad. Our caregivers visit regularly, and we provide updates to you remotely.',2),
((SELECT id FROM services WHERE slug='elderly-care'),'Are your elderly caregivers trained?','Yes. All Medizinar Care caregivers undergo a background check and selection process before being placed with a family.',3),
((SELECT id FROM services WHERE slug='elderly-care'),'Is elderly care available across Kerala?','We primarily serve Kottarakkara, Kollam, and surrounding districts. Contact us to confirm availability in your area.',4),
-- mother-baby
((SELECT id FROM services WHERE slug='mother-baby-care'),'What does a mother and baby care assistant do?','She assists with newborn bathing, feeding support, baby routines, mother''s personal care during recovery, and general household support related to the baby.',1),
((SELECT id FROM services WHERE slug='mother-baby-care'),'How soon after delivery can I arrange a care assistant?','You can arrange the care assistant before the expected delivery date. We recommend booking 1–2 weeks in advance to ensure availability.',2),
((SELECT id FROM services WHERE slug='mother-baby-care'),'Is this service available for C-section recovery?','Yes. Our care assistants are experienced in supporting mothers recovering from both normal and C-section deliveries.',3),
((SELECT id FROM services WHERE slug='mother-baby-care'),'How long is the mother and baby care service provided?','The duration is flexible — most families arrange 30 to 90 days of postnatal care. We customise based on your requirement.',4),
-- home-maid
((SELECT id FROM services WHERE slug='home-maid-services'),'Are your home maids background-verified?','Yes. All domestic staff placed by Medizinar Care go through our background check and selection process before being sent to a family.',1),
((SELECT id FROM services WHERE slug='home-maid-services'),'Can I get a part-time home maid?','Yes. We offer both full-time (live-in or daily) and part-time maid services based on your household needs.',2),
((SELECT id FROM services WHERE slug='home-maid-services'),'What tasks does the home maid assist with?','Typical tasks include house cleaning, cooking, laundry, dishwashing, and general household organisation. Specific duties are agreed upon at the time of placement.',3),
((SELECT id FROM services WHERE slug='home-maid-services'),'Where do you provide home maid services?','We primarily serve Kottarakkara, Kollam, and the surrounding districts in Kerala. Contact us to check availability in your area.',4),
-- nri
((SELECT id FROM services WHERE slug='nri-parent-care'),'How does NRI Parent Care work?','We arrange scheduled visits to your parents'' home in Kerala. After each visit, we provide a well-being update to you via phone or WhatsApp, covering health, daily activities, and any concerns.',1),
((SELECT id FROM services WHERE slug='nri-parent-care'),'How often are home visits made?','Visit frequency is customisable — weekly, bi-weekly, or daily depending on your parents'' needs and your preference.',2),
((SELECT id FROM services WHERE slug='nri-parent-care'),'Can you accompany my parents to hospital appointments?','Yes. Hospital visit accompaniment is part of our Quick Support Services and can be arranged alongside NRI Parent Care visits.',3),
((SELECT id FROM services WHERE slug='nri-parent-care'),'What areas in Kerala do you cover for NRI Parent Care?','We primarily serve Kottarakkara, Kollam district, and nearby areas. Contact us to confirm coverage for your parents'' location.',4),
-- quick-support
((SELECT id FROM services WHERE slug='quick-support'),'What is a quick support service?','Quick Support is short-duration care — available for a few hours, a day, or a specific event like a hospital visit. It is billed on a daily service charge basis.',1),
((SELECT id FROM services WHERE slug='quick-support'),'Can I book a caregiver for just one day?','Yes. Our quick support services are available on a daily basis with no long-term commitment required.',2),
((SELECT id FROM services WHERE slug='quick-support'),'Is there a minimum duration for quick support?','Minimum duration is typically 4 hours for daytime support. Contact us to discuss your specific requirement.',3),
((SELECT id FROM services WHERE slug='quick-support'),'Can I use quick support while my regular caregiver is unavailable?','Absolutely. Quick support is ideal as a temporary replacement or gap-fill when your regular caregiver is unavailable.',4);

-- ---- locations ----------------------------------------------
INSERT IGNORE INTO `locations`
    (`slug`,`name`,`title`,`meta_desc`,`hero_title`,`hero_desc`,`intro`,`distance`,`sitemap_priority`,`localities`,`sort_order`,`status`)
VALUES
('kollam','Kollam',
 'Home Care Services in Kollam, Kerala — Medizinar Care',
 'Professional home care services in Kollam, Kerala. Medizinar Care provides bedside patient care, elderly care, mother & baby care, and home maid services in Kollam and Kottarakkara.',
 'Home Care Services in Kollam',
 'Compassionate and reliable home care services across Kollam district, Kerala — from Kottarakkara to Punalur and Kundara.',
 'Medizinar Care is based in Kottarakkara and serves families across Kollam district with professional home healthcare services. Whether you need a bedside caregiver, elderly care, postnatal support, or a home maid, we arrange verified and compassionate caregivers across Kollam.',
 'Primary base — fastest response',1.0,
 '["Kottarakkara","Punalur","Kundara","Karunagappally","Paravur","Chavara","Sasthamcotta","Veliyam","Anchal","Pathanapuram"]',
 1,'published'),

('thiruvananthapuram','Thiruvananthapuram',
 'Home Care Services in Thiruvananthapuram, Kerala — Medizinar Care',
 'Home care services in Thiruvananthapuram, Kerala. Medizinar Care provides bedside patient care, elderly care, mother & baby care, and domestic support in Trivandrum and nearby areas.',
 'Home Care Services in Thiruvananthapuram',
 'Reliable and compassionate home healthcare across Thiruvananthapuram (Trivandrum) district — verified caregivers for patients, elderly, and families.',
 'Medizinar Care extends its home care services to families in Thiruvananthapuram district. Our trained caregivers provide bedside patient care, elderly care, postnatal support, and domestic assistance across the Trivandrum area.',
 'Approx. 60–80 km from base',0.8,
 '["Thiruvananthapuram","Neyyattinkara","Nedumangad","Attingal","Varkala","Chirayinkeezhu","Kazhakoottam"]',
 2,'published'),

('pathanamthitta','Pathanamthitta',
 'Home Care Services in Pathanamthitta, Kerala — Medizinar Care',
 'Home care services in Pathanamthitta, Kerala. Medizinar Care provides bedside patient care, elderly care, NRI parent care, and mother & baby care in Pathanamthitta and nearby areas.',
 'Home Care Services in Pathanamthitta',
 'Compassionate home healthcare across Pathanamthitta district — trusted caregivers for patients, senior citizens, and families.',
 'Medizinar Care serves families in Pathanamthitta district with professional home care services. Being close to Kottarakkara, we can arrange caregivers across Pathanamthitta quickly and reliably.',
 'Approx. 30–60 km from base',0.9,
 '["Pathanamthitta","Tiruvalla","Adoor","Ranni","Konni","Pandalam","Kozhencherry"]',
 3,'published'),

('alappuzha','Alappuzha',
 'Home Care Services in Alappuzha, Kerala — Medizinar Care',
 'Home care services in Alappuzha (Alleppey), Kerala. Medizinar Care provides bedside patient care, elderly care, and postnatal care in Alappuzha and surrounding areas.',
 'Home Care Services in Alappuzha',
 'Professional home care across Alappuzha district — bedside patient care, elderly support, and postnatal care for families in Alleppey and nearby areas.',
 'Medizinar Care provides home care services to families in Alappuzha (Alleppey) district. Our caregivers are trained, verified, and matched to your specific care needs.',
 'Approx. 50–80 km from base',0.8,
 '["Alappuzha","Chengannur","Mavelikara","Kuttanad","Harippad","Kayamkulam","Ambalapuzha"]',
 4,'published'),

('kottayam','Kottayam',
 'Home Care Services in Kottayam, Kerala — Medizinar Care',
 'Home care services in Kottayam, Kerala. Medizinar Care provides bedside patient care, elderly care, mother & baby care, and domestic support across Kottayam district.',
 'Home Care Services in Kottayam',
 'Reliable and compassionate home care services across Kottayam district — trusted for bedside patient care, elderly support, and postnatal care.',
 'Medizinar Care extends its professional home care services to Kottayam district. Our verified caregivers are experienced in patient care, elderly support, and postnatal assistance.',
 'Approx. 60–90 km from base',0.8,
 '["Kottayam","Changanacherry","Pala","Ettumanoor","Vaikom","Erattupetta","Kanjirappally"]',
 5,'published'),

('ernakulam','Ernakulam',
 'Home Care Services in Ernakulam, Kerala — Medizinar Care',
 'Home care services in Ernakulam (Kochi), Kerala. Medizinar Care provides bedside patient care, elderly care, and home maid services in Ernakulam, Kochi and nearby areas.',
 'Home Care Services in Ernakulam',
 'Professional home healthcare in Ernakulam and Kochi — trained caregivers for patients, elderly, and families across Ernakulam district.',
 'Medizinar Care provides home care services to families in Ernakulam and Kochi. Whether you need a bedside caregiver, elderly care, or home maid, we match you with a verified, experienced professional.',
 'Approx. 100–130 km from base',0.6,
 '["Kochi","Ernakulam","Aluva","Perumbavoor","Muvattupuzha","Thrippunithura","Angamaly"]',
 6,'published'),

('idukki','Idukki',
 'Home Care Services in Idukki, Kerala — Medizinar Care',
 'Home care services in Idukki district, Kerala. Medizinar Care provides bedside patient care, elderly care, and domestic support across Idukki.',
 'Home Care Services in Idukki',
 'Compassionate home care across Idukki district — patient care, elderly support, and domestic assistance for families.',
 'Medizinar Care provides professional home care services to families in Idukki district. Our trained caregivers cover bedside patient care, elderly care, and household support.',
 'Approx. 80–120 km from base',0.6,
 '["Thodupuzha","Munnar","Kattappana","Devikulam","Udumbanchola","Peerumade"]',
 7,'published'),

('thrissur','Thrissur',
 'Home Care Services in Thrissur, Kerala — Medizinar Care',
 'Home care services in Thrissur, Kerala. Medizinar Care provides bedside patient care, elderly care, and postnatal care in Thrissur and nearby areas.',
 'Home Care Services in Thrissur',
 'Professional home healthcare services in Thrissur district — compassionate caregivers for patients, elderly, and families.',
 'Medizinar Care extends its home care services to families in Thrissur district. We provide trained and verified caregivers for patient care, elderly support, and postnatal assistance.',
 'Approx. 130–160 km from base',0.6,
 '["Thrissur","Chalakudy","Irinjalakuda","Kodungallur","Guruvayur","Kunnamkulam"]',
 8,'published'),

('palakkad','Palakkad',
 'Home Care Services in Palakkad, Kerala — Medizinar Care',
 'Home care services in Palakkad, Kerala. Medizinar Care provides bedside patient care, elderly care, and domestic support in Palakkad district.',
 'Home Care Services in Palakkad',
 'Reliable home healthcare in Palakkad district — trained caregivers for patients, elderly, and families.',
 'Medizinar Care provides professional home care services to families in Palakkad district, including bedside patient care, elderly support, and domestic assistance.',
 'Approx. 150–180 km from base',0.6,
 '["Palakkad","Ottapalam","Shoranur","Mannarkkad","Alathur","Chittur"]',
 9,'published'),

('malappuram','Malappuram',
 'Home Care Services in Malappuram, Kerala — Medizinar Care',
 'Home care services in Malappuram, Kerala. Medizinar Care provides bedside patient care, elderly care, NRI parent care, and domestic support in Malappuram.',
 'Home Care Services in Malappuram',
 'Compassionate home healthcare in Malappuram district — verified caregivers for patients, senior citizens, and NRI families.',
 'Medizinar Care provides home care services to families in Malappuram district. Our caregivers are trained, verified, and matched to your specific care needs.',
 'Approx. 180–220 km from base',0.6,
 '["Malappuram","Tirur","Manjeri","Perinthalmanna","Nilambur","Kondotty"]',
 10,'published'),

('kozhikode','Kozhikode',
 'Home Care Services in Kozhikode, Kerala — Medizinar Care',
 'Home care services in Kozhikode (Calicut), Kerala. Medizinar Care provides bedside patient care, elderly care, and postnatal care in Kozhikode and nearby areas.',
 'Home Care Services in Kozhikode',
 'Professional home care services in Kozhikode (Calicut) district — trained and compassionate caregivers for patients and families.',
 'Medizinar Care serves families in Kozhikode (Calicut) with professional home care. Our trained caregivers provide bedside patient care, elderly support, and postnatal assistance.',
 'Approx. 220–260 km from base',0.5,
 '["Kozhikode","Vadakara","Koyilandy","Feroke","Ramanattukara","Mukkam"]',
 11,'published'),

('wayanad','Wayanad',
 'Home Care Services in Wayanad, Kerala — Medizinar Care',
 'Home care services in Wayanad, Kerala. Medizinar Care provides bedside patient care, elderly care, and domestic support across Wayanad district.',
 'Home Care Services in Wayanad',
 'Compassionate home healthcare in Wayanad district — trained caregivers for patients, elderly, and families.',
 'Medizinar Care extends home care services to families in Wayanad district. Our caregivers provide patient care, elderly support, and domestic assistance.',
 'Approx. 250–300 km from base',0.5,
 '["Kalpetta","Sulthan Bathery","Mananthavady","Vythiri","Panamaram"]',
 12,'published'),

('kannur','Kannur',
 'Home Care Services in Kannur, Kerala — Medizinar Care',
 'Home care services in Kannur, Kerala. Medizinar Care provides bedside patient care, elderly care, and NRI parent care across Kannur district.',
 'Home Care Services in Kannur',
 'Professional home healthcare in Kannur district — trusted caregivers for patients, elderly, and NRI families.',
 'Medizinar Care provides professional home care services to families in Kannur district. Our trained caregivers are experienced in patient care, elderly support, and postnatal assistance.',
 'Approx. 280–320 km from base',0.5,
 '["Kannur","Thalassery","Payyanur","Iritty","Koothuparamba","Mattannur"]',
 13,'published'),

('kasaragod','Kasaragod',
 'Home Care Services in Kasaragod, Kerala — Medizinar Care',
 'Home care services in Kasaragod, Kerala. Medizinar Care provides bedside patient care, elderly care, and domestic support across Kasaragod district.',
 'Home Care Services in Kasaragod',
 'Reliable home care in Kasaragod district — compassionate caregivers for patients, elderly, and families across northern Kerala.',
 'Medizinar Care extends home care services to families in Kasaragod district. Contact us to arrange a trained and verified caregiver based on your family''s specific needs.',
 'Approx. 330–380 km from base',0.5,
 '["Kasaragod","Kanhangad","Manjeshwar","Nileshwar","Vorkady"]',
 14,'published');
