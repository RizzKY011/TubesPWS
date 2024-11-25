<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyRdf\Sparql\Client;

class HeroController extends Controller
{
    // Fungsi query SPARQL
    private function query($query)
    {
        $sparql_jena = new Client("http://localhost:3030/pahlwan/query"); // Endpoint SPARQL Anda
        return $sparql_jena->query($query);
    }

    // Fungsi pencarian pahlawan
    public function searchHero(Request $request)
    {
        $keyword = $request->input('keyword', ''); // Ambil keyword dari input pencarian

        // Preprocess keyword untuk menghilangkan karakter khusus dan menjadikannya lowercase
        $keyword = preg_replace('/[^a-zA-Z0-9\s]/', '', $keyword); // Hilangkan karakter selain huruf dan angka

        // Query SPARQL untuk mencari pahlawan berdasarkan keyword
        $query = "
            PREFIX pin: <https://example.org/schema/pin>
            PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
            PREFIX foaf: <http://xmlns.com/foaf/0.1/>

            SELECT ?person ?name ?abstract ?birthPlace ?birthYear ?deathPlace ?deathYear ?thumbnail ?homepage
            WHERE {
                ?person a pin:tour ;
                        rdfs:label ?name .
                OPTIONAL { ?person pin:abstract ?abstract }
                OPTIONAL { ?person pin:birthPlace ?birthPlace }
                OPTIONAL { ?person pin:birthYear ?birthYear }
                OPTIONAL { ?person pin:deathPlace ?deathPlace }
                OPTIONAL { ?person pin:deathYear ?deathYear }
                OPTIONAL { ?person pin:thumbnail ?thumbnail }
                OPTIONAL { ?person foaf:homepage ?homepage }
                FILTER regex(LCASE(?name), LCASE('$keyword'), 'i')
            }
        ";

        $heroes = [];
        try {
            $results = $this->query($query);  // Panggil fungsi query dari controller

            // Filter hasil duplikasi menggunakan array_column dan in_array
            foreach ($results as $row) {
                $heroName = (string)$row->name;
                // Pastikan pahlawan belum ada dalam array $heroes
                if (!in_array($heroName, array_column($heroes, 'name'))) {
                    $heroes[] = [
                        'name'       => $heroName,
                        'abstract'   => (string)$row->abstract,
                        'birthPlace' => (string)$row->birthPlace,
                        'birthYear'  => (string)$row->birthYear,
                        'deathPlace' => (string)$row->deathPlace,
                        'deathYear'  => (string)$row->deathYear,
                        'thumbnail'  => (string)$row->thumbnail,
                        'homepage'   => (string)$row->homepage,
                    ];
                }
            }
        } catch (\Exception $e) {
            \Log::error("SPARQL query failed: " . $e->getMessage());
        }

        return view('cari', compact('heroes', 'keyword'));
    }
}
