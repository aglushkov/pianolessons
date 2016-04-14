<?php

class Navigation
{
    private $navig = array(
                    'links'=>array(
                        'index'=>array("name"=>"Home"),
                        'lessons'=>array(
                            "name"=>"Lessons",
                            "id"=>"lessonsLink",
                            "list"=>array(
                                "id"=>"lessonList",
                                "links"=>array(
                                    'piano-lessons-for-adults'=>array("name"=>"Piano lessons for Adults"),
                                    'piano-lessons-for-children'=>array("name"=>"Piano lessons for Children"),
                                    'vocal-coaching-and-accompaniment'=>array("name"=>"Vocal Coaching and Accompaniment"),
                                    'theory-lessons'=>array("name"=>"Theory Lessons"),
                                    'junior-leaving-certificates-music'=>array("name"=>"Junior/Leaving Certificates Music"),
                                    'diplomas'=>array("name"=>"Diplomas"),
                                    'mini-maestros'=>array("name"=>"Mini Maestros")
                                )
                            )
                        ),
                        'biography'=>array("name"=>"Biography"),
                        'news-and-events'=>array("name"=>"News and Events"),
                        'contact'=>array("name"=>"Contact"),
                        'testimonials'=>array("name"=>"Reviews")
                    )
                );

        public function printNavigation($page, $navig = null)
        {
            if(empty($navig)) $navig = $this->navig;

            $idstr='';
            if (isset($navig["id"]))
                $idstr = " id='{$navig["id"]}'";
            ?><ul<?= $idstr?>><?

            foreach ($navig["links"] as $link=>$params)
            {
                $name = $params["name"];
                $subnavig = null;



                if ($page==$link)
                     $str = '<span class="active">'.$name.'</span>';
                else
                     $str = '<a href="/'.$link.'">'.$name.'</a>';

                $idstr='';
                if (isset($params["id"]))
                    $idstr = " id='{$params["id"]}'";

                ?><li<?= $idstr?>><?
                    echo $str;

                    if (isset($params["list"]) && is_array($params["list"]))
                    {
                        $subnavig = $params["list"];
                        $this->printNavigation($page,$subnavig);
                    }
                ?></li><?
            }

            ?></ul><?
        }
}
?>
