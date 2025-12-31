<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\TVMazeService;

class ShowController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new TVMazeService();
    }

    public function index()
    {
        // Check for search
        if (isset($_GET['q'])) {
            $query = htmlspecialchars($_GET['q']);
            $results = $this->service->searchShows($query);
            $shows = array_column($results, 'show'); // Map result structure
            
            $this->view('home/index', [
                'shows' => $shows,
                'title' => 'Search Results for: ' . $query
            ]);
            return;
        }

        // Check for ID for details
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $show = $this->service->getShowDetails($id);
            
            $this->view('shows/detail', [
                'show' => $show,
                'title' => $show['name']
            ]);
            return;
        }
        
        // Redirect if nothing found
        header('Location: /');
    }
}
