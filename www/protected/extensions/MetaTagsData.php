<?php

class MetaTagsData
{

    protected $_data;

    public function __construct($data)
    {
        $this->_data = $data;
        try {
            $this->_test();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    protected function _test()
    { 
        if (isset($this->_data['name'])) {

            $name = $this->_data['name'];

            if (isset($this->_data['url'])) {
                if (empty($this->_data['url'])) {
                    $this->_data['url'] = $name;
                }
                
                $translite1 = new Translite();
                $this->_data['url'] = $translite1->rusencode($this->_data['url']);

            }

            if (isset($this->_data['header']) && empty($this->_data['header'])) {
                $this->_data['header'] = $name;
            }

            if (isset($this->_data['title']) && empty($this->_data['title'])) {
                $this->_data['title'] = $name;
            }

            if (isset($this->_data['keywords']) && empty($this->_data['keywords'])) {
                $this->_data['keywords'] = $name;
            }

            if (isset($this->_data['description']) && empty($this->_data['description'])) { 
                $this->_data['description'] = $name;
               
            }
            
            if (isset($this->_data['date']) && empty($this->_data['date'])) { 
                $this->_data['date'] = date('Y-m-d');               
            }
          
            if (isset($this->_data['preview']) && empty($this->_data['preview'])) { 
                   if (isset($this->_data['body']) && !empty($this->_data['body'])) {
                    if( ($pos = strpos($this->_data['body'], '</p>'))) {
                        $preview = substr($this->_data['body'], 0, strpos($this->_data['body'], '</p>')+4);
                        $this->_data['preview'] = $preview;
                    }
                    
                }  
            }
        }
    }

    public function getData()
    {
        return $this->_data;
    }

}
