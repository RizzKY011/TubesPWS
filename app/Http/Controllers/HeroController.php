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

    // SPARQL query to search heroes based on the keyword in name or island
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
            FILTER(
                CONTAINS(LCASE(str(?name)), LCASE('$keyword')) ||
                CONTAINS(LCASE(str(?island)), LCASE('$keyword')) ||
                CONTAINS(LCASE(str(?deathPlace)), LCASE('$keyword')) ||
                CONTAINS(str(?birthYear), '$keyword')
            )
        }

    "; 
    $heroes = [];
    try {
        $results = $this->query($query); 

        foreach ($results as $row) {
            $heroName = (string)$row->name;
            $heroBirthYear = (string)$row->birthYear;

            if (!in_array($heroName . '-' . $heroBirthYear, array_column($heroes, 'uniqueKey'))) {
                $heroes[] = [
                    'uniqueKey'  => $heroName . '-' . $heroBirthYear, 
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

    

    public function searchByCategory($category)
    {
        $heroesByCategory = [
            'revolusi' => [
                'Ahmad Yani', 'Raden Suprapto', 'Mas Tirtodarmo haryono',
                'Siswondo Parman', 'Donald Isaac Pandjaitan', 'Sutoyo Siswomiharjo',
                'Pierre Andreas Tandean', 'Karel Satsuit Tubun', 'Katamso Darmokusumo',
                'Sugiyono Mangunwiyoto','Katamso'
            ],
            'nasional' => [
		    'Sukarno', 'Mohammad Hatta', 'Sutan Sjahrir', 'Sudirman', 'Ki Hajar Dewantara', 'R.A. Kartini',
            'Ernest Douwes Dekker', 'Muhammad Husni Thamrin', 'Ahmad Dahlan', 'Omar Said Tjokroaminoto', 
            'Mohammad Natsir', 'Soepomo', 'Herman Yohannes', 'Abdul Haris Nasution', 'Bagoes Hadikusumo', 
            'G.A. Siwabessy', 'Tengku Amir Hamzah','Sultan Syarif Kasim II', 'Sukarni', 'Muhammad Yasin', 
            'Iwa Koesoemasoemantri','Arnoldus Isaac Zacharias', 'Dewi Sartika', 'Djuanda Kartawidjaja', 
            'Maria Walanda Maramis', 'Radjiman Wediodiningrat', 'Rasuna Said', 'Lafran Pane', 'Basuki Prabowinoto',
            'Bernard Wilhelm Lapian', 'Usmar Ismail', 'Melanchton Siregar', 'Sahardjo', 'Said Soekanto Tjokroadiatmodjo','Sartono',
            ],
            'sumpahpemuda' => [
            'Sugondo Djojopuspito', 'Wage Rudolf Supratman', 'Mohammad Yamin',
            'Abdul Muis', 'Seonario Sastrowardoyo', 'Amir Sjarifuddin',
            'Dolly Salim', 'Ki Sarmidi Mangunsarkoro', 'Johannes Leimena',
            'Adnan Kapau Gani', 'Kasman Singodimedjo', 'Mohammad Yamin',
            ]
    ];
    
        $heroes = [];
        if (array_key_exists($category, $heroesByCategory)) {
            $heroNames = $heroesByCategory[$category];
    
            $nameFilter = implode(' || ', array_map(function($name) {
                $encodedName = str_replace("'", "\\'", $name); 
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
    
    public function searchHeroByIsland(Request $request)
{
    $island = $request->input('island', ''); // Ambil input pencarian berdasarkan island

    // Preprocess island untuk menghapus karakter non-alfanumerik dan mengubah menjadi huruf kecil
    $island = preg_replace('/[^a-zA-Z0-9\s]/', '', $island); // Menghapus karakter non-alfanumerik

    // SPARQL query untuk mencari pahlawan berdasarkan island
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
            FILTER(CONTAINS(LCASE(str(?island)), LCASE('$island')))
     }
    "; 
    $heroes = [];
    try {
        $results = $this->query($query);  // Memanggil fungsi query dari controller

        // Menyaring hasil duplikat berdasarkan nama dan tahun kelahiran
        foreach ($results as $row) {
            $heroName = (string)$row->name;
            $heroBirthYear = (string)$row->birthYear;

            // Mengecek apakah hero sudah ada dalam array menggunakan heroName dan heroBirthYear sebagai pengenal unik
            if (!in_array($heroName . '-' . $heroBirthYear, array_column($heroes, 'uniqueKey'))) {
                $heroes[] = [
                    'uniqueKey'  => $heroName . '-' . $heroBirthYear, // Kunci unik untuk menyaring duplikat
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

    if ($request->ajax()) {
        return response()->json(['heroes' => $heroes]);
    }

    return view('cari', compact('heroes', 'island'));
}


}
