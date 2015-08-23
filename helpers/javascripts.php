<?php
class Javascripts
{
    private $scripts = array();
    private $defaultType = "script";

    public function addStartScript($src,$type=null)
    {
        $type = $this->getType($type);
        array_unshift($this->scripts,array("src"=>$src,"type"=>$type));
    }

    public function add($src,$type=null)
    {
        $type = $this->getType($type);
        array_push($this->scripts,array("src"=>$src,"type"=>$type));
    }


    public function echoScript($script)
    {
        if($script["type"]=="code")
        {
            echo '<script type="text/javascript">'.file_get_contents($_SERVER["DOCUMENT_ROOT"].$script['src']).'</script>';
        }
        else// if type=='script'
        {
            echo '<script type="text/javascript" src="'.$script['src'].'"></script>';
        }
    }

    private function getType($type)
    {
        return $type ? $type : $this->defaultType;
    }

    public function echoAll()
    {
        foreach ($this->scripts as $script)
        {
            $this->echoScript($script);
        }
    }
}
?>
