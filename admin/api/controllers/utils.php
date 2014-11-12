<?php

class Utils{

    private function returnJSON($array){
        return json_encode($array);
    }

    public function returnErrorMessage($message){
        return $this->returnJSON(array(
            "error" => true,
            "message" => $message
        ));
    }

    public function returnValidMessage($message){
        return $this->returnJSON(array(
            "error" => false,
            "message" => $message
        ));
    }
}