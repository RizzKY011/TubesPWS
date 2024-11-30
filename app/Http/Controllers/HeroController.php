<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyRdf\Sparql\Client;

class HeroController extends Controller
{
    // Function for SPARQL query
    private function query($query)
    {
        $sparql_jena = new Client("http://localhost:3030/pahlawan/query"); // SPARQL endpoint
        return $sparql_jena->query($query);
    }

    // Function to search heroes
    public function searchHero(Request $request)
    {
        $keyword = $request->input('keyword', ''); // Get search keyword

        // Preprocess keyword to remove special characters and make it lowercase
        $keyword = preg_replace('/[^a-zA-Z0-9\s]/', '', $keyword); // Remove non-alphanumeric characters

        // SPARQL query to search heroes based on the keyword
        $query = "
            PREFIX pin: <https://example.org/schema/pin>
            PREFIX foaf: <http://xmlns.com/foaf/0.1/>
            PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>

            SELECT ?person ?name ?birthPlace ?birthYear ?deathPlace ?deathYear ?island ?battle ?thumbnail ?homepage ?abstract
            WHERE {
                ?person a pin:hero ;
                        rdfs:label ?name ;
                        pin:birthPlace ?birthPlace ;
                        pin:birthYear ?birthYear ;
                        pin:deathPlace ?deathPlace ;
                        pin:deathYear ?deathYear ;
                        pin:island ?island ;
                        pin:battle ?battle ;
                        pin:thumbnail ?thumbnail ;
                        foaf:homepage ?homepage ;
                        pin:abstract ?abstract .
                FILTER(CONTAINS(LCASE(str(?name)), LCASE('$keyword')))
            }
            "; 
        $heroes = [];
        try {
            $results = $this->query($query);  // Call the query function from the controller

            // Filter duplicate results based on the name and birth year
            foreach ($results as $row) {
                $heroName = (string)$row->name;
                $heroBirthYear = (string)$row->birthYear;

                // Check if hero already exists in the array using heroName and birthYear as the unique identifier
                if (!in_array($heroName . '-' . $heroBirthYear, array_column($heroes, 'uniqueKey'))) {
                    $heroes[] = [
                        'uniqueKey'  => $heroName . '-' . $heroBirthYear, // Unique key for filtering duplicates
                        'name'       => $heroName,
                        'abstract'   => (string)$row->abstract ?? 'No abstract available',
                        'birthPlace' => (string)$row->birthPlace ?? 'Unknown place',
                        'birthYear'  => (string)$row->birthYear ?? 'Unknown year',
                        'deathPlace' => (string)$row->deathPlace ?? 'Unknown place',
                        'deathYear'  => (string)$row->deathYear ?? 'Unknown year',
                        'island'     => (string)$row->island ?? 'Unknown island',
                        'battle'     => (string)$row->battle ?? 'No battle info',
                        'thumbnail'  => (string)$row->thumbnail ?? '',
                        'homepage'   => (string)$row->homepage ?? '',
                    ];
                }
            }
        } catch (\Exception $e) {
            \Log::error("SPARQL query failed: " . $e->getMessage());
        }

        return view('cari', compact('heroes', 'keyword'));
    }
    
    // HeroController.php

    public function searchByCategory($category)
    {
        // Define the mapping of categories to hero names
        $heroesByCategory = [
            'kemerdekaan' => [
                'Marthen Indey', 'Sultan Syarif Kasim II', 'Agustinus Adisutjipto',
                'Abdulrahman Saleh', 'Sukarni', 'Andi Abdullah Bau Massepe',
                'Slamet Rijadi', 'Eddy Martadinata', 'Iswahyudi',
                'Djamin Ginting', 'Djatikusumo', 'Yos Sudarso',
                'Pangeran Antasari', 'Basuki Rahmat', 'Tjilik Riwut', 'Sukarno'
            ],
            'revolusi' => [
                'Iwa Koesoemasoemantri', 'Arie Frederik Lasut', 'Kusumah Atmaja',
                'Nani Wartabone', 'Muhammad Mangundi Projo', 'Radjiman Wediodiningrat',
                'Rasuna Said', 'Zainal Mustafa', 'Bagindo Azizchan'
            ],
            'nasional' => [
                'Dewi Sartika', 'Maria Walanda Maramis', 'Martha Christina Tiahahu',
                'Pong Tiku', 'Tengku Amir Hamzah', 'Lafran Pane',
                'Bernard Wilhelm Lapian', 'Usmar Ismail', 'Melanchton Siregar',
                'Sahardjo', 'Said Soekanto Tjokrodiatmodjo', 'Tirto Adhi Soerjo',
                'Sartono'
            ],
            'sumpahpemuda' => [
                'Johanes Abraham Dimara', 'Djuanda Kartawidjaja', 'SutanSjahrir','Diponegoro', 'Mohammad Yamin'
            ],
        ];
    
        $heroes = [];
        if (array_key_exists($category, $heroesByCategory)) {
            $heroNames = $heroesByCategory[$category];
    
            // Prepare the SPARQL query to fetch heroes based on names
            $nameFilter = implode(' || ', array_map(function($name) {
                // Encode the name properly for the query
                $encodedName = str_replace("'", "\\'", $name); // Escape single quotes
                return "CONTAINS(LCASE(str(?name)), LCASE('$encodedName'))";
            }, $heroNames));
    
            $query = "
                PREFIX pin: <https://example.org/schema/pin>
                PREFIX foaf: <http://xmlns.com/foaf/0.1/>
                PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    
                SELECT ?person ?name ?birthPlace ?birthYear ?deathPlace ?deathYear ?island ?battle ?thumbnail ?homepage ?abstract
                WHERE {
                    ?person a pin:hero ;
                            rdfs:label ?name ;
                            pin:birthPlace ?birthPlace ;
                            pin:birthYear ?birthYear ;
                            pin:deathPlace ?deathPlace ;
                            pin:deathYear ?deathYear ;
                            pin:island ?island ;
                            pin:battle ?battle ;
                            pin:thumbnail ?thumbnail ;
                            foaf:homepage ?homepage ;
                            pin:abstract ?abstract .
                    FILTER($nameFilter)
                }
            ";
    
            try {
                $results = $this->query($query);  // Call the query function from the controller
    
                // Filter duplicate results based on the name and birth year
                foreach ($results as $row) {
                    $heroName = (string)$row->name;
                    $heroBirthYear = (string)$row->birthYear;
    
                    // Check if hero already exists in the array using heroName and birthYear as the unique identifier
                    if (!in_array($heroName . '-' . $heroBirthYear, array_column($heroes, 'uniqueKey'))) {
                        $heroes[] = [
                            'uniqueKey'  => $heroName . '-' . $heroBirthYear, // Unique key for filtering duplicates
                            'name'       => $heroName,
                            'abstract'   => (string)$row->abstract ?? 'No abstract available',
                            'birthPlace' => (string)$row->birthPlace ?? 'Unknown place',
                            'birthYear'  => (string)$row->birthYear ?? 'Unknown year',
                            'deathPlace' => (string)$row->deathPlace ?? 'Unknown place',
                            'deathYear' => (string)$row->deathYear ?? 'Unknown year',
                            'island'     => (string)$row->island ?? 'Unknown island',
                            'battle'     => (string)$row->battle ?? 'No battle info',
                            'thumbnail'  => (string)$row->thumbnail ?? '',
                            'homepage'   => (string)$row->homepage ?? '',
                        ];
                    }
                }
            } catch (\Exception $e) {
                \Log::error("SPARQL query failed: " . $e->getMessage());
            }
        }
    
        return view('kategori', compact('heroes', 'category'));
    }
    
}
