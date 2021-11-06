<?php
    class Serie{
        private $title;
        private $star;
        private $image;
        private $id;
        private $language;
        private $summary;
        private $type;
        private $genres;
        private $status;
        private $schedule;
        private $runtime;
        public function __construct($title, $star, $image, $id){
            $this->title = $title;
            $this->star = $star;
            $this->image = $image;
            $this->id = $id;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getId(){
            return $this->id;
        }
        public function getStar(){
            return $this->star;
        }
        public function getImage(){
            return $this->image;
        }
        public function getSummary(){
            return $this->summary;
        }
        public function getLanguage(){
            return $this->language;
        }
        public function getType(){
            return $this->type;
        }
        public function getGenres(){
            return $this->genres;
        }
        public function getStatus(){
            return $this->status;
        }
        public function getSchedule(){
            return $this->schedule;
        }
        public function getRuntime(){
            return $this->runtime;
        }
        public function getPremiered(){
            return $this->premiered;
        }
        public function getNetwork(){
            return $this->network;
        }
        public function getWebChannel(){
            return $this->webChannel;
        }
        public function getEnded(){
            return $this->ended;
        }
        public function getAverageRuntime(){
            return $this->averageRuntime;
        }
        public function getOfficialSite(){
            return $this->officialSite;
        }
        public function setType($type){
            $this->type = $type;
        }
        public function setGenres($genres){
            $this->genres = $genres;
        }
        public function setStatus($status){
            $this->status = $status;
        }
        public function setSchedule($schedule){
            $this->schedule = $schedule;
        }
        public function setSummary($summary){
            $this->summary = $summary;
        }
        public function setLanguage($language){
            $this->language = $language;
        }
        public function setRuntime($runtime){
            $this->runtime = $runtime;
        }
        public function setPremiered($premiered){
            $this->premiered = $premiered;
        }
        public function setNetwork($network){
            $this->network = $network;
        }
        public function setWebChannel($webChannel){
            $this->webChannel = $webChannel;
        }
        public function setEnded($ended){
            $this->ended = $ended;
        }
        public function setAverageRuntime($averageRuntime){
            $this->averageRuntime = $averageRuntime;
        }
        public function setOfficialSite($officialSite){
            $this->officialSite = $officialSite;
        }
    }