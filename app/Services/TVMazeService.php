<?php

namespace App\Services;

class TVMazeService
{
    protected $baseUrl = 'https://api.tvmaze.com/';

    public function getShows($page = 0)
    {
        return $this->request('GET', 'shows', ['page' => $page]);
    }

    public function searchShows($query)
    {
        return $this->request('GET', 'search/shows', ['q' => $query]);
    }

    public function getSeasons($id)
    {
        return $this->request('GET', "shows/{$id}/seasons");
    }

    public function getShowDetails($id)
    {
        // Handle array for embed parameters properly for http_build_query
        return $this->request('GET', "shows/{$id}", [
            'embed' => ['cast', 'episodes', 'crew']
        ]);
    }

    protected function request($method, $endpoint, $params = [])
    {
        $url = $this->baseUrl . $endpoint;
        
        if (!empty($params)) {
             // specific fix for duplicate keys in query string (like embed[]=cast&embed[]=episodes)
             // http_build_query handles arrays by indexing them by default, tvmaze accepts repeated keys or indexed
             $url .= '?' . http_build_query($params);
        }
        
        $options = [
            'http' => [
                'method' => $method,
                'header' => "User-Agent: TVMazeApp/1.0\r\n" .
                            "Content-Type: application/json\r\n", 
                'ignore_errors' => true // Fetch content even on 4xx/5xx to handle API errors gracefully
            ]
        ];
        
        $context = stream_context_create($options);
        $response = @file_get_contents($url, false, $context);
        
        if ($response === false) {
            return []; // Return empty on failure
        }
        
        return json_decode($response, true);
    }
}
