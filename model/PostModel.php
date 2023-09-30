<?php
class Post {
    private $id;
    private $content;
    private $emailId;
    private $timeUpload;
    private $imageUrl;
    private $videoUrl;

    public function __construct($id, $content, $emailId, $timeUpload, $imageUrl, $videoUrl) {
        $this->id = $id;
        $this->content = $content;
        $this->emailId = $emailId;
        $this->timeUpload = $timeUpload;
        $this->imageUrl = $imageUrl;
        $this->videoUrl = $videoUrl;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getContent() {
        return $this->content;
    }

    public function getEmailId() {
        return $this->emailId;
    }

    public function getTimeUpload() {
        return $this->timeUpload;
    }

    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function getVideoUrl() {
        return $this->videoUrl;
    }
}
?>