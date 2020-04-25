<?php
    class Read_ConfigFile {
        private $configFileObject;
        private $mainSection;
        private $dataSection;
        
        function __construct($configFileName='Lotto_PHP_DB_Queries.php', $mainSectionName='db_lottery', $dataSectionName='Options'){
            $this->setConfigFileObject($configFileName);
            $this->setMainSection($mainSectionName);
            $this->setDataSection($dataSectionName);
        }
        
        private function setConfigFileObject($configFileName) {            
            $this->configFileObject =   include($configFileName);
        }

        private function setMainSection($mainSectionName) {   
            $holder             =   $this->configFileObject;
            $this->mainSection  =   $holder[$mainSectionName];
        }

        private function setDataSection($dataSectionName) {   
            $holder             =   $this->mainSection;
            $this->dataSection  =   $holder[$dataSectionName];
        }

        public function getConfigFileObject() {            
            return $this->configFileObject;
        }

        public function getMainSection() {            
            return $this->mainSection;
        }
        
        public function getDataSection() {            
            return $this->dataSection;
        }
    }
?>
