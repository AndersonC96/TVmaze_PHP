<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\TVMazeService;

class HomeController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new TVMazeService();
    }

    public function index()
    {
        $shows = $this->service->getShows(0); // Fetch first page of shows
        
        // Filter or process shows if needed (e.g. grouped by genre)
        // For now, just pass all shows
        
        $this->view('home/index', [
            'shows' => array_slice($shows, 0, 24), // Show top 24
            'title' => 'Trending Now'
        ]);
    }
}
