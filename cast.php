<?php
    class Cast{
        private $name;
        private $alias;
        private $image;
        private $country;
        public function __construct($name, $alias, $image){
            $this->name = $name;
            $this->alias = $alias;
            //$this->country = $country;
            $this->image = $image;
        }
        public function getName(){
            return $this->name;
        }
        public function getAlias(){
            return $this->alias;
        }
        public function getCountry(){
            return $this->country;
        }
        public function getImage(){// retorna a url da imagem
            return $this->image;
        }
    }