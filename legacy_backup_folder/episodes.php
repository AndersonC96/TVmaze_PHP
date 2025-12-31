<?php
    class Episodes{
        private $name;
        private $airdate;
        private $airtime;
        private $runtime;
        private $image;
        private $summary;
        public function __construct($name, $airdate, $airtime, $runtime, $image, $summary){
            $this->name = $name;
            $this->airdate = $airdate;
            $this->airtime = $airtime;
            $this->runtime = $runtime;
            $this->image = $image;
            $this->summary = $summary;
        }
        public function getName(){
            return $this->name;
        }
        public function getAirdate(){
            return $this->airdate;
        }
        public function getAirtime(){
            return $this->airtime;
        }
        public function getRuntime(){
            return $this->runtime;
        }
        public function getImage(){
            return $this->image;
        }
        public function getSummary(){
            return $this->summary;
        }
    }