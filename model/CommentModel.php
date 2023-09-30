<?php
class Comment {
    private $id;
    private $postId;
    private $content;
    private $timeUpload;

    public function __construct($id, $postId, $content, $timeUpload) {
        $this->id = $id;
        $this->postId = $postId;
        $this->content = $content;
        $this->timeUpload = $timeUpload;
    }

    public function getId() {
        return $this->id;
    }

    public function getPostId() {
        return $this->postId;
    }

    public function getContent() {
        return $this->content;
    }

    public function getTimeUpload() {
        return $this->timeUpload;
    }
}
?>