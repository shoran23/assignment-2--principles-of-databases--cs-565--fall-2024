<?php

class OperatingSystem {
    public $versionName;
    public $releaseName;
    public $darwin;
    public $url;
    public $comment;

    function __construct($versionName, $releaseName, $darwin, $url, $comment) {
        $this->versionName = $versionName;
        $this->releaseName = $releaseName;
        $this->darwin = $darwin;
        $this->url = $url;
        $this->comment = $comment;
    }

    function getVersionName(): string {
        return $this->versionName;
    }

    function getReleaseName(): string {
        return $this->releaseName;
    }
}
