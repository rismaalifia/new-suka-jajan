<?php

namespace App\Controllers;

class Geocode extends BaseController
{
    public function search()
    {
        $alamat = $this->request->getGet('q');
        if (!$alamat) {
            return $this->response->setJSON(['error' => 'Alamat diperlukan']);
        }

        $url = 'https://nominatim.openstreetmap.org/search?' . http_build_query([
            'q'      => $alamat . ', Semarang, Indonesia',
            'format' => 'json',
            'limit'  => 5,
        ]);

        $client = \Config\Services::curlrequest();
        $response = $client->get($url, [
            'headers' => [
                'User-Agent' => 'SukaJajan/1.0 (contact@sukajajan.com)',
            ],
        ]);

        $results = json_decode($response->getBody(), true);
        $data = [];
        foreach ($results as $r) {
            $data[] = [
                'display_name' => $r['display_name'],
                'lat'          => $r['lat'],
                'lon'          => $r['lon'],
            ];
        }

        return $this->response->setJSON($data);
    }
}
