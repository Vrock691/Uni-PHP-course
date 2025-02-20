<?php

class FormData
{
    private $post_data;
    private $file_data;

    function __construct($_postdata, $_file)
    {
        $this->post_data = $_postdata;
        $this->file_data = $_file;
    }

    public function returnPost() {
        return $this->post_data;
    }

    public function returnFile() {
        return $this->file_data;
    }

    public function uploadFile() {
        $source = $this->file_data["tmp_name"];
        $destination = __DIR__."/upload/".$this->file_data["name"];
        move_uploaded_file($source, $destination);
        $path = "./upload/".$this->file_data["name"];
        return $path;
    }
}
