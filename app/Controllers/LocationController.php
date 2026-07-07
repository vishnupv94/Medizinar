<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Location;

/**
 * Handles Kerala district location pages at /location/{district}
 * Data is read from the `locations` database table.
 */
class LocationController extends Controller
{
    public function show(string $district): void
    {
        $location = Location::findBySlug($district);

        if (!$location) {
            http_response_code(404);
            $this->view('404', ['pageTitle' => 'Page Not Found']);
            return;
        }

        $localities = Location::decodeLocalities($location);

        // LocalBusiness + areaServed JSON-LD
        $jsonLd = [
            '@context'   => 'https://schema.org',
            '@type'      => ['MedicalBusiness', 'LocalBusiness'],
            'name'       => SITE_NAME . ' — ' . $location->name,
            'description'=> $location->meta_desc,
            'url'        => SITE_URL . '/location/' . $location->slug,
            'telephone'  => '+91' . PHONE,
            'email'      => EMAIL,
            'areaServed' => array_merge(
                [['@type' => 'AdministrativeArea', 'name' => $location->name . ' District, Kerala']],
                array_map(fn($loc) => ['@type' => 'City', 'name' => $loc . ', Kerala'], $localities)
            ),
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
            'page'       => 'location',
            'pageTitle'  => $location->title,
            'metaDesc'   => $location->meta_desc,
            'jsonLd'     => $jsonLd,
            'district'   => $location,
            'localities' => $localities,
            'slug'       => $location->slug,
            // All published locations for the "Also Serve" grid
            'allLocations' => Location::getPublished(),
        ]);
    }
}
